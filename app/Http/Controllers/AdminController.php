<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\PendaftaranMagang;
use App\Models\Artikel;
use App\Models\Sertifikat;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Jumlah berdasarkan status
        $belumDikonfirmasi = PendaftaranMagang::where('status', 'menunggu')->count();
        $diterima = PendaftaranMagang::where('status', 'diterima')->count();
        $ditolak = PendaftaranMagang::where('status', 'ditolak')->count();

        $totalPeserta = PendaftaranMagang::count();

        $statistikPerBulan = PendaftaranMagang::selectRaw("
    YEAR(tanggal_mulai)  as tahun,
    MONTH(tanggal_mulai) as bulan,
    SUM(CASE WHEN status = 'diterima' THEN 1 ELSE 0 END) as diterima,
    SUM(CASE WHEN status = 'ditolak'  THEN 1 ELSE 0 END) as ditolak
")
            ->groupBy('tahun', 'bulan')
            ->orderBy('tahun')
            ->orderBy('bulan')
            ->get();


        // 🔹 Tambahan logika siswa vs mahasiswa
        $jumlahSiswa = \DB::table('biodata_peserta')
            ->where(function ($q) {
                $q->where('instansi', 'like', '%SMA%')
                    ->orWhere('instansi', 'like', '%SMK%')
                    ->orWhere('instansi', 'like', '%MA%');
            })
            ->count();

        $jumlahMahasiswa = \DB::table('biodata_peserta')
            ->where(function ($q) {
                $q->where('instansi', 'like', '%Universitas%')
                    ->orWhere('instansi', 'like', '%Institut%')
                    ->orWhere('instansi', 'like', '%Politeknik%')
                    ->orWhere('instansi', 'like', '%Sekolah Tinggi%');
            })
            ->count();

        return view('admin.dashboard', compact(
            'belumDikonfirmasi',
            'diterima',
            'ditolak',
            'totalPeserta',
            'statistikPerBulan',
            'jumlahSiswa',
            'jumlahMahasiswa'
        ));
    }

    public function showPendaftaran($id)
    {
        $pendaftaran = PendaftaranMagang::with(['user.biodata', 'suratBalasans'])->findOrFail($id);
        return view('admin.pendaftaran_detail', compact('pendaftaran'));
    }


    public function konfirmasi(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diterima,ditolak',
        ]);

        $pendaftaran = PendaftaranMagang::findOrFail($id);

        if ($pendaftaran->status !== 'menunggu') {
            return back()->with('error', 'Status sudah diset menjadi "' . $pendaftaran->status . '" dan dikunci. Tidak dapat diubah lagi.');
        }

        if ($pendaftaran->status === $request->status) {
            return back()->with('success', 'Status tidak berubah.');
        }

        $pendaftaran->status = $request->status;
        $pendaftaran->save();

        $message = $request->status === 'diterima'
            ? 'Pendaftaran berhasil diterima.'
            : 'Pendaftaran telah ditolak.';

        return back()->with('success', $message);
    }

    public function pendaftaran(Request $request)
    {
        $query = PendaftaranMagang::with(['user', 'biodata'])
            ->orderBy('created_at', 'asc'); // Tanggal terlama

        // Tambahkan pencarian jika ada
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('user', function ($q2) use ($search) {
                    $q2->where('nama', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                })
                    ->orWhereHas('biodata', function ($q2) use ($search) {
                        $q2->where('instansi', 'like', "%{$search}%");
                    });
            });
        }

        $pendaftarans = $query->paginate(10)->withQueryString();

        return view('admin.pendaftaran', compact('pendaftarans'));
    }


    public function peserta(Request $request)
    {
        $query = PendaftaranMagang::with(['user', 'biodata'])
            ->where('status', 'diterima'); // Hanya yang diterima

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('user', function ($q2) use ($search) {
                    $q2->where('nama', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                })
                    ->orWhereHas('biodata', function ($q2) use ($search) {
                        $q2->where('instansi', 'like', "%{$search}%");
                    });
            });
        }

        $pendaftarans = $query->orderBy('created_at', 'asc')
            ->paginate(10)
            ->withQueryString();

        $totalDiterima = PendaftaranMagang::where('status', 'diterima')->count();

        return view('admin.peserta', compact('pendaftarans', 'totalDiterima'));
    }


    public function showPeserta($id)
    {
        $pendaftaran = PendaftaranMagang::findOrFail($id);

        // Ambil data user yang terkait
        $user = User::findOrFail($pendaftaran->user_id);

        // Ambil sertifikat user (kalau ada)
        $sertifikat = Sertifikat::where('user_id', $user->id)->first();

        return view('admin.upload_sertifikat', compact('user', 'sertifikat'));
    }



    public function artikel()
    {
        $artikels = Artikel::latest()->get();
        return view('admin.artikel', compact('artikels'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'gambar' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('artikel', 'public');
        }

        Artikel::create($validated);

        return redirect()->back()->with('success', 'Artikel berhasil diunggah.');
    }

    public function edit($id)
    {
        $artikel = Artikel::findOrFail($id);
        return view('admin.edit-artikel', compact('artikel')); // pastikan nama view sesuai
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $artikel = Artikel::findOrFail($id);
        $artikel->judul = $request->judul;
        $artikel->konten = $request->konten;

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('artikels', 'public');
            $artikel->gambar = $path;
        }

        $artikel->save();

        return redirect()->route('admin.artikel')->with('success', 'Artikel berhasil diperbarui!');
    }


    public function destroy($id)
    {
        $artikel = Artikel::findOrFail($id);
        if ($artikel->gambar) {
            Storage::disk('public')->delete($artikel->gambar);
        }
        $artikel->delete();
        return redirect()->back()->with('success', 'Artikel berhasil dihapus.');
    }

    private function generateNomorSertifikat()
    {
        $bulan = now()->format('m');
        $last = Sertifikat::orderBy('id', 'desc')->first();

        $nextNo = $last ? intval(substr($last->nomor_sertifikat, 0, 3)) + 1 : 1;
        $noUrut = str_pad($nextNo, 3, '0', STR_PAD_LEFT);

        return "{$noUrut}/3506/HM.340/{$bulan}/" . now()->year;
    }
    public function updateSertifikat(Request $request, $userId)
    {
        $sertifikat = Sertifikat::firstOrCreate(
            ['user_id' => $userId],
            ['nomor_sertifikat' => $this->generateNomorSertifikat()] // generate kalau baru
        );

        // ambil field selain nomor_sertifikat
        $data = $request->only([
            'deskripsi',
            'jabatan_penandatangan',
            'nama_penandatangan',
        ]);

        // kalau admin isi nomor_sertifikat manual → pakai
        if ($request->filled('nomor_sertifikat')) {
            $data['nomor_sertifikat'] = $request->nomor_sertifikat;
        }

        $sertifikat->update($data);

        return back()->with('success', 'Data sertifikat berhasil diperbarui.');
    }




}
