<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PendaftaranMagang;
use App\Models\BiodataPeserta;
use App\Models\Sertifikat;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

class SertifikatController extends Controller
{
    public function sertifikat()
    {
        $userId = Auth::id();

        $pendaftaran = PendaftaranMagang::where('user_id', $userId)->first();
        $biodata = BiodataPeserta::where('user_id', $userId)->first();
        $sertifikat = Sertifikat::where('user_id', $userId)->first();

        if (!$pendaftaran || !$pendaftaran->tanggal_selesai) {
            return redirect()->back()->with('error', 'Data magang belum lengkap.');
        }

        return view('pendaftar.sertifikat', [
            'nama' => $biodata->nama ?? 'N/A',
            'instansi' => $biodata->instansi ?? 'N/A',
            'tanggal_mulai' => $pendaftaran->tanggal_mulai,
            'tanggal_selesai' => $pendaftaran->tanggal_selesai,
            'file_sertifikat' => $sertifikat->file_path ?? null,
            'nomor_sertifikat'     => $sertifikat->nomor_sertifikat ?? null,
            'deskripsi'            => $sertifikat->deskripsi ?? null,
            'jabatan_penandatangan'=> $sertifikat->jabatan_penandatangan ?? null,
            'nama_penandatangan'   => $sertifikat->nama_penandatangan ?? null,
        ]);
    }

    public function preview()
    {
        $userId = Auth::id();
        $pendaftaran = PendaftaranMagang::where('user_id', $userId)->first();
        $biodata = BiodataPeserta::where('user_id', $userId)->first();

        if (!$pendaftaran || now()->lt($pendaftaran->tanggal_selesai)) {
            return redirect()->back()->with('error', 'Sertifikat belum tersedia.');
        }

        Carbon::setLocale('id');

        $sertifikat = Sertifikat::firstOrCreate(
            ['user_id' => $userId],
            [
                'nomor_sertifikat' => $this->generateNomorSertifikat(),
                'deskripsi' => 'telah menyelesaikan Magang Praktik Kerja di Badan Pusat Statistik Kabupaten Kediri',
                'jabatan_penandatangan' => 'Kepala Badan Pusat Statistik Kabupaten Kediri',
                'nama_penandatangan' => 'BAMBANG INDARTO, S.Si., M.Si.',
            ]
        );

        $data = [
            'nama' => $biodata->nama,
            'instansi' => $biodata->instansi,
            'tanggal_mulai' => Carbon::parse($pendaftaran->tanggal_mulai)->translatedFormat('d F Y'),
            'tanggal_selesai' => Carbon::parse($pendaftaran->tanggal_selesai)->translatedFormat('d F Y'),
            'nomor_sertifikat' => $sertifikat->nomor_sertifikat,
            'deskripsi' => $sertifikat->deskripsi,
            'jabatan_penandatangan' => $sertifikat->jabatan_penandatangan,
            'nama_penandatangan' => $sertifikat->nama_penandatangan,
        ];

        $pdf = PDF::loadView('pendaftar.sertifikat-pdf', $data)->setPaper('A4', 'landscape');
        return $pdf->stream('preview-sertifikat.pdf');
    }

    public function upload(Request $request, $id)
    {
        $request->validate([
            'file_sertifikat' => 'required|mimes:pdf|max:2048'
        ]);

        $user = User::findOrFail($id);
        $path = $request->file('file_sertifikat')->store('sertifikat', 'public');

        $user->sertifikat()->updateOrCreate([], [
            'nomor_sertifikat' => $this->generateNomorSertifikat(),
            'file_path' => $path
        ]);

        return back()->with('success', 'Sertifikat berhasil diunggah!');
    }

    public function download()
    {
        $userId = Auth::id();
        $pendaftaran = PendaftaranMagang::where('user_id', $userId)->first();
        $biodata = BiodataPeserta::where('user_id', $userId)->first();

        if (!$pendaftaran || now()->lt($pendaftaran->tanggal_selesai)) {
            return redirect()->back()->with('error', 'Sertifikat belum tersedia.');
        }

        $sertifikat = Sertifikat::firstOrCreate(
            ['user_id' => $userId],
            [
                'nomor_sertifikat' => $this->generateNomorSertifikat(),
                'deskripsi' => 'telah menyelesaikan Magang Praktik Kerja di Badan Pusat Statistik Kabupaten Kediri',
                'jabatan_penandatangan' => 'Kepala Badan Pusat Statistik Kabupaten Kediri',
                'nama_penandatangan' => 'BAMBANG INDARTO, S.Si., M.Si.',
            ]
        );

        $data = [
            'nama' => $biodata->nama,
            'instansi' => $biodata->instansi,
            'tanggal_mulai' => Carbon::parse($pendaftaran->tanggal_mulai)->translatedFormat('d F Y'),
            'tanggal_selesai' => Carbon::parse($pendaftaran->tanggal_selesai)->translatedFormat('d F Y'),
            'nomor_sertifikat' => $sertifikat->nomor_sertifikat,
            'deskripsi' => $sertifikat->deskripsi,
            'jabatan_penandatangan' => $sertifikat->jabatan_penandatangan,
            'nama_penandatangan' => $sertifikat->nama_penandatangan,
        ];

        $pdf = PDF::loadView('pendaftar.sertifikat-pdf', $data)->setPaper('A4', 'landscape');
        return $pdf->download('sertifikat_' . Str::slug($data['nama']) . '.pdf');
    }

    private function generateNomorSertifikat()
    {
        $bulan = now()->format('m');
        $last = Sertifikat::orderBy('id', 'desc')->first();

        $nextNo = $last ? intval(substr($last->nomor_sertifikat, 0, 3)) + 1 : 1;
        $noUrut = str_pad($nextNo, 3, '0', STR_PAD_LEFT);

        return "{$noUrut}/3506/HM.340/{$bulan}/" . now()->year;
    }

    public function previewAuto($userId)
    {
         Carbon::setLocale('id');

        $pendaftaran = PendaftaranMagang::where('user_id', $userId)->first();
        $biodata = BiodataPeserta::where('user_id', $userId)->first();

        if (!$pendaftaran) {
            return back()->with('error', 'Data peserta belum lengkap.');
        }

        $sertifikat = Sertifikat::firstOrCreate(
            ['user_id' => $userId],
            [
                'nomor_sertifikat' => $this->generateNomorSertifikat(),
                'deskripsi' => 'telah menyelesaikan Magang Praktik Kerja di Badan Pusat Statistik Kabupaten Kediri',
                'jabatan_penandatangan' => 'Kepala Badan Pusat Statistik Kabupaten Kediri',
                'nama_penandatangan' => 'BAMBANG INDARTO, S.Si., M.Si.',
            ]
        );

        $data = [
            'nama' => $biodata->nama,
            'instansi' => $biodata->instansi,
            'tanggal_mulai' => Carbon::parse($pendaftaran->tanggal_mulai)->translatedFormat('d F Y'),
            'tanggal_selesai' => Carbon::parse($pendaftaran->tanggal_selesai)->translatedFormat('d F Y'),
            'nomor_sertifikat' => $sertifikat->nomor_sertifikat,
            'deskripsi' => $sertifikat->deskripsi ?? 'telah menyelesaikan Magang Praktik Kerja di Badan Pusat Statistik Kabupaten Kediri',
            'jabatan_penandatangan' => $sertifikat->jabatan_penandatangan ?? 'Kepala Badan Pusat Statistik Kabupaten Kediri',
            'nama_penandatangan' => $sertifikat->nama_penandatangan ?? 'BAMBANG INDARTO, S.Si., M.Si.',
        ];


        $pdf = PDF::loadView('pendaftar.sertifikat-pdf', $data)->setPaper('A4', 'landscape');
        return $pdf->stream('preview-sertifikat.pdf');
    }

    public function downloadAuto($userId)
    {
         Carbon::setLocale('id');

        $pendaftaran = PendaftaranMagang::where('user_id', $userId)->first();
        $biodata = BiodataPeserta::where('user_id', $userId)->first();

        $sertifikat = Sertifikat::firstOrCreate(
            ['user_id' => $userId],
            [
                'nomor_sertifikat' => $this->generateNomorSertifikat(),
                'deskripsi' => 'telah menyelesaikan Magang Praktik Kerja di Badan Pusat Statistik Kabupaten Kediri',
                'jabatan_penandatangan' => 'Kepala Badan Pusat Statistik Kabupaten Kediri',
                'nama_penandatangan' => 'BAMBANG INDARTO, S.Si., M.Si.',
            ]
        );

        $data = [
            'nama' => $biodata->nama,
            'instansi' => $biodata->instansi,
            'tanggal_mulai' => Carbon::parse($pendaftaran->tanggal_mulai)->translatedFormat('d F Y'),
            'tanggal_selesai' => Carbon::parse($pendaftaran->tanggal_selesai)->translatedFormat('d F Y'),
            'nomor_sertifikat' => $sertifikat->nomor_sertifikat ?? '123/PKL/BPS-KDR/2024',
            'deskripsi' => $sertifikat->deskripsi ?? 'telah menyelesaikan Magang Praktik Kerja di Badan Pusat Statistik Kabupaten Kediri',
            'jabatan_penandatangan' => $sertifikat->jabatan_penandatangan ?? 'Kepala Badan Pusat Statistik Kabupaten Kediri',
            'nama_penandatangan' => $sertifikat->nama_penandatangan ?? 'BAMBANG INDARTO, S.Si., M.Si.',
        ];


        $pdf = PDF::loadView('pendaftar.sertifikat-pdf', $data)->setPaper('A4', 'landscape');
        return $pdf->download('sertifikat_' . Str::slug($data['nama']) . '.pdf');
    }
}
