<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PendaftaranMagang;
use App\Models\BiodataPeserta;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PendaftarController extends Controller
{
    public function dashboard()
    {
        $userId = Auth::id();

        $semua = PendaftaranMagang::where('user_id', $userId)->get();
        foreach ($semua as $data) {
            if (
                $data->tanggal_selesai &&
                $data->status !== 'selesai' &&
                $data->status !== 'menunggu' &&
                $data->status !== 'draft'
            ) {
                $tanggalSelesaiPlus1 = Carbon::parse($data->tanggal_selesai)->addDay();
                if (now()->greaterThanOrEqualTo($tanggalSelesaiPlus1)) {
                    $data->update(['status' => 'selesai']);
                }
            }
        }

        $pendaftaran = PendaftaranMagang::with('biodata')
            ->where('user_id', $userId)
            ->where('status', '!=', 'draft')
            ->orderByDesc('id')
            ->get();

        $draft = session('draft_pendaftaran', []);

        return view('pendaftar.dashboard', compact('pendaftaran', 'draft'));
    }

    public function profile()
    {
        return view('pendaftar.profile');
    }

    public function formPendaftaran()
    {
        $userId = Auth::id();
        $biodata = BiodataPeserta::where('user_id', $userId)->first();

        // Ambil draft dari session
        $draft = session('draft_pendaftaran', []);

        return view('pendaftar.form_pendaftaran', compact('biodata', 'draft'));
    }

    public function create()
    {
        return view('pendaftaran.create');
    }

    public function storeBiodata(Request $request)
    {
        $userId = Auth::id();

        // Validasi
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'instansi' => ['required', 'string', 'max:255'],
            'jurusan' => ['nullable', 'string', 'max:255'],
            'nim_nis' => [
                'required',
                'string',
                'max:50',
                Rule::unique('biodata_peserta', 'nim_nis')->ignore($userId, 'user_id'),
            ],
            'no_wa' => ['nullable', 'string', 'max:20', 'regex:/^\+?[0-9]{9,15}$/'],
            'status' => ['nullable', 'string', 'max:50'], // sesuaikan jika punya enum tertentu
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ], [
            'nim_nis.unique' => 'NIM/NIS sudah digunakan oleh akun lain.',
            'no_wa.regex' => 'Format nomor WA tidak valid (gunakan angka, boleh diawali +).',
        ]);

        if (!empty($validated['no_wa'])) {
            $validated['no_wa'] = preg_replace('/[^0-9\+]/', '', $validated['no_wa']);
        }

        $biodata = BiodataPeserta::firstOrNew(['user_id' => $userId]);

        if ($request->hasFile('foto')) {
            if (!empty($biodata->foto) && Storage::disk('public')->exists($biodata->foto)) {
                Storage::disk('public')->delete($biodata->foto);
            }
            $validated['foto'] = $request->file('foto')->store('foto_peserta', 'public');
        }

        $biodata->fill($validated + ['user_id' => $userId])->save();

        return back()->with('success', 'Biodata berhasil disimpan.');
    }


    public function storePendaftaran(Request $request)
    {
        $user = Auth::user();
        $userId = $user->id;
        $action = $request->input('submit_type', 'save');

        // ====== SIMPAN DRAFT (tetap seperti semula) ======
        if ($action === 'save') {
            $request->validate([
                'tanggal_mulai' => 'nullable|date',
                'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
                'jenis_magang' => 'nullable|in:mandiri,wajib',
            ]);

            $draft = [
                'jenis_magang' => $request->input('jenis_magang'),
                'tanggal_mulai' => $request->input('tanggal_mulai'),
                'tanggal_selesai' => $request->input('tanggal_selesai'),
                'siap_ditempatkan' => $request->boolean('siap_ditempatkan'),
            ];

            session(['draft_pendaftaran' => $draft]);
            return back()->with('success', 'Draft disimpan sementara. Tidak termasuk file!!');
        }

        // ====== VALIDASI SAAT SUBMIT ======
        $rules = [
            'proposal' => 'required|file|mimes:pdf|max:2048',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'jenis_magang' => 'required|in:mandiri,wajib',
        ];

        // Jika wajib → surat pengantar wajib
        if ($request->jenis_magang === 'wajib') {
            $rules['surat_pengantar'] = 'required|file|mimes:pdf|max:2048';
        } else {
            $rules['surat_pengantar'] = 'nullable|file|mimes:pdf|max:2048';
        }

        $request->validate($rules);

        // ====== CEK NIM / NIS ======
        $nim = optional($user->biodata)->nim_nis;
        if (!$nim) {
            return back()
                ->withErrors(['nim_nis' => 'Lengkapi NIM/NIS pada biodata terlebih dahulu sebelum mengajukan.'])
                ->withInput();
        }

        // ====== CEK SUDAH PERNAH MENGAJUKAN ======
        $sudahPernahMengajukan = PendaftaranMagang::whereHas('user.biodata', function ($q) use ($nim) {
            $q->where('nim_nis', $nim);
        })->exists();

        if ($sudahPernahMengajukan) {
            return back()
                ->withErrors(['nim_nis' => "NIM/NIS {$nim} sudah pernah mengajukan. Pengajuan baru tidak diperbolehkan."])
                ->withInput();
        }

        // ====== SIMPAN FILE (hanya jika ada) ======
        $suratPath = $request->hasFile('surat_pengantar')
            ? $request->file('surat_pengantar')->store('surat_pengantar', 'public')
            : null;

        $proposalPath = $request->file('proposal')->store('proposal', 'public');

        // ====== SIMPAN KE DATABASE ======
        PendaftaranMagang::create([
            'user_id' => $userId,
            'surat_pengantar' => $suratPath,
            'proposal' => $proposalPath,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'jenis_magang' => $request->jenis_magang,
            'status' => 'menunggu',
        ]);

        // hapus draft setelah submit
        session()->forget('draft_pendaftaran');

        return redirect()->route('pendaftar.dashboard')
            ->with('success', 'Pengajuan berhasil dikirim!');
    }

}