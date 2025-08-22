@extends('layouts.app')

@section('title', 'Upload Sertifikat')

@section('content')
<div class="container mt-4">
    <h4 class="fw-bold mb-4">Upload Sertifikat</h4>

    {{-- Form Upload Sertifikat PDF --}}
    <form action="{{ route('admin.upload_sertifikat', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="file_sertifikat" class="form-label">Pilih File Sertifikat (PDF)</label>
            <input 
                type="file" 
                name="file_sertifikat" 
                id="file_sertifikat" 
                class="form-control" 
                accept="application/pdf" 
                required
            >
        </div>

        <button type="submit" class="btn btn-primary">Unggah Sertifikat</button>
    </form>

    <hr>
    <h4 class="fw-bold mb-4">Unduh Sertifikat</h4>

    <a href="{{ route('admin.sertifikat.preview.auto', $user->id) }}" target="_blank" class="btn btn-outline-primary me-2">
        Preview Sertifikat Auto
    </a>

    {{-- Tombol Download Sertifikat Auto --}}
    <a href="{{ route('admin.sertifikat.download.auto', $user->id) }}" class="btn btn-dark">
        Download Sertifikat Auto
    </a>

    <hr>
    <h4 class="fw-bold mb-4">Edit Sertifikat</h4>

    {{-- Form Edit Sertifikat --}}
    <form action="{{ route('admin.sertifikat.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nomor_sertifikat" class="form-label">Nomor Sertifikat</label>
            <input 
                type="text" 
                name="nomor_sertifikat" 
                id="nomor_sertifikat" 
                class="form-control" 
                value="{{ old('nomor_sertifikat', $sertifikat->nomor_sertifikat ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea 
                name="deskripsi" 
                id="deskripsi" 
                class="form-control" 
                rows="3">{{ $deskripsi ?? 'telah menyelesaikan Magang Praktik Kerja di Badan Pusat Statistik Kabupaten Kediri' }}</textarea>
        </div>

        <div class="mb-3">
            <label for="jabatan_penandatangan" class="form-label">Jabatan Penandatangan</label>
            <input 
                type="text" 
                name="jabatan_penandatangan" 
                id="jabatan_penandatangan" 
                class="form-control" 
                value="{{ $jabatan_penandatangan ?? 'Kepala Badan Pusat Statistik Kabupaten Kediri' }}"
            >
        </div>

        <div class="mb-3">
            <label for="nama_penandatangan" class="form-label">Nama Penandatangan</label>
            <input 
                type="text" 
                name="nama_penandatangan" 
                id="nama_penandatangan" 
                class="form-control" 
                value="{{ $nama_penandatangan ?? 'BAMBANG INDARTO, S.Si., M.Si.' }}"
            >
        </div>

        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
    </form>


    {{-- Area Preview Sertifikat --}}
    <div id="sertifikat-preview" class="text-center d-none mt-3">
        <div class="border rounded shadow-sm p-3 bg-white">
            <img 
                src="{{ asset('public/tamplate/tamplate_sertifikat.pdf') }}" 
                class="img-fluid mb-3" 
                alt="Sertifikat Template" 
                style="max-width: 800px;"
            >
        </div>
    </div>
</div>
@endsection
