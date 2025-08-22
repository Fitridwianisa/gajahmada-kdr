<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sertifikat</title>
    <style>
        @page { size: A4 landscape; margin: 0; }
        
        body {
            width: 100%;
            height: 100%;
            background-image: url("{{ public_path('tamplate/tamplate_sertifikat.png') }}");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            position: relative;
            font-family: sans-serif; /* <- semua pakai ini */
        }

        .content {
            position: relative;
            width: 100%;
            top: 210px;
            text-align: center;
        }

        .nomor {
            font-size: 21px;
            margin-bottom: 75px;
            margin-top: 40px;
        }

        .nama {
            font-size: 50px;
            font-weight: bold;
            margin-top: 80px;
        }

        .institusi {
            margin-top: 10px;
            margin-bottom: 10px;
            font-size: 24px;
        }

        .deskripsi {
            font-size: 23px;
            margin-top: 30px;
            line-height: 1.4;
            color: #0a2a43;
        }

        .tanggal {
            font-size: 22px;
            margin-top: 10px;
        }

        .ttd {
            margin-top: 20px;
            font-size: 22px;
            color: #0a2a43;
        }
    </style>
</head>
<body>
    <div class="content">
        <div class="nomor">{{ $nomor_sertifikat }}</div>
        <div class="nama">{{ strtoupper($nama) }}</div>
        <div class="institusi">{{ $instansi }}</div>
        
        <div class="deskripsi">
            {!! str_replace(
                ['Magang Praktik Kerja', 'Badan Pusat Statistik Kabupaten Kediri'],
                ['<b>Magang Praktik Kerja</b>', '<b>Badan Pusat Statistik Kabupaten Kediri'],
                $deskripsi
            ) !!}
        </div>
        <div class="tanggal">dari {{ $tanggal_mulai }} - {{ $tanggal_selesai }}</div>

        <div class="ttd">
            {!! str_replace(
                ['Kepala Badan Pusat Statistik', ' Kabupaten Kediri'],
                ['Kepala Badan Pusat Statistik <br>', 'Kabupaten Kediri<br><br><br><br><br>'],
                $jabatan_penandatangan
            ) !!}
            <strong>{{ $nama_penandatangan }}</strong>
        </div>
    </div>
</body>
</html>
