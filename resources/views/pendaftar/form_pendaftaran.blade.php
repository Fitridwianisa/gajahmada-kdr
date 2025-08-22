@extends('layouts.app')

@section('title', 'Formulir Pendaftaran')

@section('content')
<div class="container my-4 my-md-5">

    {{-- Page Header --}}
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-2 mb-4">
        <div>
            <h3 class="fw-bold mb-1">Formulir Pendaftaran</h3>
            <div class="text-muted">Lengkapi biodata & dokumen. Anda bisa <span class="fw-semibold text-primary">simpan draft</span> atau <span class="fw-semibold text-success">kirim pengajuan</span>.</div>
        </div>
    </div>

    {{-- Alerts --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-x-circle me-1"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <div class="fw-semibold mb-1"><i class="bi bi-exclamation-triangle me-1"></i> Terjadi kesalahan:</div>
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

    {{-- Draft notice --}}
    @if(!empty($draft))
        <div class="alert alert-info d-flex align-items-start gap-2 py-2 shadow-sm">
            <i class="bi bi-info-circle fs-5"></i>
            <div>
                <div class="fw-semibold">Draft tersimpan</div>
                <small class="text-muted">Isian teks diprefill dari draft. <strong>File tidak tersimpan saat draft</strong>—unggah ulang saat ingin mengirim.</small>
            </div>
        </div>
    @endif

    <div class="row g-4">
        {{-- Biodata --}}
        <div class="col-12 col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="mb-0 fw-semibold">Biodata</h5>
                        <span class="badge rounded-pill text-bg-light">
                            <i class="bi bi-person-badge me-1"></i> Wajib diisi
                        </span>
                    </div>
                    <div class="text-muted small mt-1"><small>*Data akan digunakan untuk kebutuhan sertifikat magang</small></div>
                </div>
                <div class="card-body">
                    <form action="{{ route('pendaftaran.store.biodata') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap<span class="text-danger">*</span></label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="Nama lengkap"
                                   required value="{{ old('nama', $biodata->nama ?? '') }}">
                            @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="siswa" {{ old('status', $biodata->status ?? '') == 'siswa' ? 'selected' : '' }}>Siswa</option>
                                <option value="mahasiswa" {{ old('status', $biodata->status ?? '') == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                            </select>
                            @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Instansi / Sekolah <span class="text-danger">*</span></label>
                            <div class="text-muted small mt-1"><small>*Tuliskan nama instansi lengkap (Universitas / Sekolah)</small></div>
                            <input type="text" name="instansi" class="form-control @error('instansi') is-invalid @enderror" placeholder="Cth: Politeknik Negeri Malang"
                                   required value="{{ old('instansi', $biodata->instansi ?? '') }}">
                            @error('instansi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jurusan <span class="text-danger">*</span></label>
                            <input type="text" name="jurusan" class="form-control @error('jurusan') is-invalid @enderror" placeholder="Contoh: D3 Manajemen Informatika"
                                   required value="{{ old('jurusan', $biodata->jurusan ?? '') }}">
                            @error('jurusan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nomor Induk Mahasiswa / Nomor Induk Siswa<span class="text-danger">*</span></label>
                            <input type="text" name="nim_nis" class="form-control @error('nim_nis') is-invalid @enderror" placeholder="NIM / NIS"
                                   required value="{{ old('nim_nis', $biodata->nim_nis ?? '') }}">
                            @error('nim_nis') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">No. WhatsApp <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">+62</span>
                                <input type="text" name="no_wa" class="form-control @error('no_wa') is-invalid @enderror" placeholder="812XXXXXXX"
                                       required value="{{ old('no_wa', $biodata->no_wa ?? '') }}">
                                @error('no_wa') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            </div>
                            <small class="text-muted">Gunakan nomor aktif untuk keperluan verifikasi/undangan.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Foto 3:4 (PNG/JPG) <span class="text-danger">*</span></label>
                            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" accept="image/png, image/jpeg" onchange="previewFoto(event)">
                            @error('foto') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            <img id="preview"
                                 src="{{ $biodata && $biodata->foto ? asset('storage/'.$biodata->foto) : '' }}"
                                 class="img-thumbnail mt-2"
                                 style="max-height:150px; {{ $biodata && $biodata->foto ? '' : 'display:none;' }}">
                            <small class="text-muted d-block mt-1">Ukuran maks. 2MB. Latar polos lebih disarankan.</small>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-1"></i> Simpan Biodata
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Dokumen & Penempatan --}}
        <div class="col-12 col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="mb-0 fw-semibold">Dokumen</h5>
                        <span class="badge rounded-pill text-bg-light">
                            <i class="bi bi-file-earmark-text me-1"></i> PDF maks. 2MB
                        </span>
                    </div>
                    <div class="text-muted small mt-1">File tidak disimpan saat <em>draft</em>. Unggah saat mengirim.</div>
                </div>
                <div class="card-body">
                    <form id="formPendaftaran" action="{{ route('pendaftaran.store.pendaftaran') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf
                        <input type="hidden" name="submit_type" id="submit_type" value="save">

                        {{-- Jenis Magang dipindah ke atas --}}
                        <div class="mb-3">
                            @php $draftJenis = $draft['jenis_magang'] ?? null; @endphp
                            <label class="form-label">Jenis Magang <span class="text-danger">*</span></label>
                            <select id="jenis_magang" name="jenis_magang" class="form-select @error('jenis_magang') is-invalid @enderror" required>
                                <option value="">-- Pilih Jenis Magang --</option>
                                <option value="mandiri" {{ old('jenis_magang', $draftJenis) == 'mandiri' ? 'selected' : '' }}>Mandiri</option>
                                <option value="wajib"   {{ old('jenis_magang', $draftJenis) == 'wajib'   ? 'selected' : '' }}>Wajib</option>
                            </select>
                            @error('jenis_magang') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label id="label_surat" class="form-label">Surat Pengantar <span class="text-danger surat-required">*</span></label>
                            <input type="file" name="surat_pengantar" class="form-control @error('surat_pengantar') is-invalid @enderror" accept="application/pdf">
                            @error('surat_pengantar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            <small class="text-muted d-block mt-1">Format: PDF. Nama file jelas & resmi.</small>
                        </div>

                        <div class="mb-3">
                            <label id="label_proposal" class="form-label">Proposal <span class="text-danger">*</span></label>
                            <input type="file" name="proposal" class="form-control @error('proposal') is-invalid @enderror" accept="application/pdf">
                            @error('proposal') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            <small class="text-muted d-block mt-1">Format: PDF. Sertakan ringkasan kegiatan.</small>
                        </div>

                        {{-- tanggal --}}
                        <div class="row g-3">
                            <div class="col-12 col-md-6">
                                <label class="form-label">Tanggal Mulai <span class="text-danger">*</span></label>
                                <input type="date" name="tanggal_mulai" class="form-control @error('tanggal_mulai') is-invalid @enderror" required
                                    value="{{ old('tanggal_mulai', $draft['tanggal_mulai'] ?? '') }}">
                                @error('tanggal_mulai') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label">Tanggal Selesai <span class="text-danger">*</span></label>
                                <input type="date" name="tanggal_selesai" class="form-control @error('tanggal_selesai') is-invalid @enderror" required
                                    value="{{ old('tanggal_selesai', $draft['tanggal_selesai'] ?? '') }}">
                                @error('tanggal_selesai') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="d-flex flex-wrap gap-2 justify-content-end pt-2">
                            <button type="button" class="btn btn-outline-secondary" id="btnSaveDraft">
                                <i class="bi bi-cloud-arrow-down me-1"></i> Simpan sebagai Draft
                            </button>
                            <button type="button" class="btn btn-primary" id="btnSubmit">
                                <i class="bi bi-send-check me-1"></i> Kirim Pengajuan
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer bg-white">
                    <small class="text-muted"><i class="bi bi-shield-check me-1"></i> Data Anda aman. Pastikan dokumen sesuai ketentuan.</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function previewFoto(e){
        const file = e.target.files?.[0];
        const img  = document.getElementById('preview');
        if(!file){ img.style.display='none'; img.src=''; return; }
        const reader = new FileReader();
        reader.onload = ()=>{ img.src = reader.result; img.style.display='block'; };
        reader.readAsDataURL(file);
    }

    const form = document.getElementById('formPendaftaran');
    const submitType = document.getElementById('submit_type');

    document.getElementById('btnSaveDraft').addEventListener('click', ()=>{
        submitType.value = 'save';
        form.submit();
    });

    document.getElementById('btnSubmit').addEventListener('click', ()=>{
        submitType.value = 'submit';
        form.submit();
    });

    document.addEventListener("DOMContentLoaded", () => {
        const jenisMagang = document.getElementById("jenis_magang");
        const labelSurat = document.getElementById("label_surat");
        const suratStar = labelSurat.querySelector(".surat-required");

        function updateSuratLabel() {
            if (jenisMagang.value === "mandiri") {
                // Mandiri → surat tidak wajib
                suratStar.style.display = "none";
            } else {
                // Wajib → surat wajib
                suratStar.style.display = "inline";
            }
        }

        // Jalankan saat halaman load
        updateSuratLabel();

        // Jalankan setiap kali dropdown berubah
        jenisMagang.addEventListener("change", updateSuratLabel);
    });

</script>
@endpush