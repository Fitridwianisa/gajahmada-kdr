@extends('layouts.app')

@section('content')
  <div class="container mt-5">
    <div class="row g-4">
    <!-- Dokumen -->
    <div class="col-md-6 text-center">
      <div class="card border-0 shadow-sm">
      <div class="card-header bg-primary text-white">
        <strong>Surat Pengantar</strong>
      </div>
      <div class="card-body p-0">
        <embed src="{{ asset('storage/' . $pendaftaran->proposal) }}" type="application/pdf" width="100%"
        height="500px" />
      </div>
      <div class="card-body p-0">
        <embed src="{{ asset('storage/' . $pendaftaran->surat_pengantar) }}" type="application/pdf" width="100%"
        height="500px" />
      </div>
      </div>
    </div>

    <!-- Detail Pelamar -->
    <div class="col-md-6">
      @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif
      @if(session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

      <div class="card border-0 shadow-sm">
      <div class="card-header bg-light">
        <strong>Detail Pelamar</strong>
        <span class="badge 
        @if($pendaftaran->status === 'diterima') bg-success 
      @elseif($pendaftaran->status === 'ditolak') bg-danger 
    @else bg-warning text-dark @endif float-end">
        {{ ucfirst($pendaftaran->status) }}
        </span>
      </div>
      <div class="card-body">
        <table class="table table-borderless align-middle mb-0">
        <tr>
          <th style="width: 38%">Nama</th>
          <td>{{ $pendaftaran->user->nama }}</td>
        </tr>
        <tr>
          <th>Instansi</th>
          <td>{{ $pendaftaran->user->biodata->instansi ?? '-' }}</td>
        </tr>
        <tr>
          <th>Jurusan</th>
          <td>{{ $pendaftaran->user->biodata->jurusan ?? '-' }}</td>
        </tr>
        <tr>
          <th>No. Whatsapp</th>
          <td>{{ $pendaftaran->user->biodata->no_wa ?? '-' }}</td>
        </tr>

        {{-- Form konfirmasi (dikunci jika sudah diterima/ditolak) --}}
        <tr>
          <th>Action</th>
          <td>
          <form action="{{ route('admin.pendaftaran.konfirmasi', $pendaftaran->id) }}" method="POST"
            onsubmit="return confirmKonfirmasi(event, this)">
            @csrf
            @method('PUT')
            <select name="status" class="form-select" id="statusSelect" @if($pendaftaran->status !== 'menunggu')
disabled @endif required>
            <option value="">Konfirmasi penerimaan</option>
            <option value="diterima" {{ $pendaftaran->status === 'diterima' ? 'selected' : '' }}>Terima</option>
            <option value="ditolak" {{ $pendaftaran->status === 'ditolak' ? 'selected' : '' }}>Tolak</option>
            </select>

            @if($pendaftaran->status === 'menunggu')
        <button type="submit" class="btn btn-primary mt-2">Kirim</button>
        @else
        <small class="text-muted d-block mt-2">
        Status sudah <strong>{{ $pendaftaran->status }}</strong> dan dikunci.
        </small>
        @endif
          </form>
          </td>
        </tr>

        {{-- Upload surat sesuai status --}}
        @if(in_array($pendaftaran->status, ['diterima', 'ditolak']))
        @php
        $tipe = $pendaftaran->status === 'diterima' ? 'terima' : 'tolak';
        $label = $pendaftaran->status === 'diterima' ? 'Surat Balasan (Diterima)' : 'Surat Penolakan';
      $sb = $pendaftaran->suratBalasans->first(); @endphp
        <tr>
        <th>{{ $label }}</th>
        <td>
        @if(!empty($sb?->file))
        <div class="mb-1">
        <a href="{{ asset('storage/' . $sb->file) }}" target="_blank">Lihat file</a>
        </div>
      @else
        <small class="text-muted d-block mb-2">Belum ada file.</small>
      @endif

        <form action="{{ route('admin.suratbalasan.store') }}" method="POST" enctype="multipart/form-data"
          onsubmit="return confirmUpload(event, this)">
          @csrf
          <input type="hidden" name="user_id" value="{{ $pendaftaran->user_id }}">
          <input type="hidden" name="tipe" value="{{ $tipe }}"> {{-- 'terima' atau 'tolak' --}}
          <input type="file" name="file" class="form-control mt-2 mb-2" accept=".pdf,.doc,.docx,.png,.jpg,.jpeg"
          required>
          <button class="btn btn-primary btn-sm me-2">Unggah</button>
        </form>
        </td>
        </tr>
      @endif
        </table>
      </div>
      </div>
    </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    function confirmKonfirmasi(e, form) {
    e.preventDefault();
    const status = form.querySelector('select[name="status"]').value;
    if (!status) {
      Swal.fire({ icon: 'warning', title: 'Pilih status dulu!', text: 'Silakan pilih menerima atau menolak.' });
      return false;
    }
    const actionText = status === 'diterima' ? 'menerima' : 'menolak';
    Swal.fire({
      title: `Yakin ingin ${actionText}?`,
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Ya, lanjutkan',
      cancelButtonText: 'Batal',
      reverseButtons: true,
      customClass: { confirmButton: 'btn btn-success me-2', cancelButton: 'btn btn-secondary me-2' },
      buttonsStyling: false
    }).then((r) => { if (r.isConfirmed) form.submit(); });
    return false;
    }

    function confirmUpload(e, form) {
    e.preventDefault();
    Swal.fire({
      title: 'Yakin ingin mengunggah file ini?',
      text: 'Jika sudah ada, akan diganti dengan yang baru.',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Ya, unggah',
      cancelButtonText: 'Batal',
      reverseButtons: true,
      customClass: { confirmButton: 'btn btn-success me-2', cancelButton: 'btn btn-secondary me-2' },
      buttonsStyling: false
    }).then((r) => { if (r.isConfirmed) form.submit(); });
    return false;
    }

    @if(session('success'))
    Swal.fire({ icon: 'success', title: 'Berhasil', text: @json(session('success')), timer: 3000, showConfirmButton: false });
    @endif
    @if(session('error'))
    Swal.fire({ icon: 'error', title: 'Gagal', text: @json(session('error')) });
    @endif
  </script>
@endpush