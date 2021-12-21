<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <header>
        <table style="width: 100%; border-bottom: 2px solid black">
            <tr>
                <td width="20%">Nama Peserta Didik</td>
                <td width="40%">: {{ $siswa_rombel->siswa->nama }}</td>
                <td width="15%">Semester </td>
                <td width="20%">: {{ $sekolah->semester }}</td>
            </tr>
            <tr>
                <td width="20%">NISN</td>
                <td width="40%">: {{ $siswa_rombel->siswa->nisn }}</td>
                <td width="15%">Tahun Ajaran </td>
                <td width="20%">: {{ $sekolah->tahun_ajaran }}</td>
            </tr>
            <tr>
                <td width="20%">Kelas</td>
                <td width="40%" colspan="2">: {{ $siswa_rombel->rombel->kelas->nama }}</td>
            </tr>
        </table>
    </header>

    <main>
        <div style="margin-top: 20px">B. Nilai</div>
        
        <table style="width: 100%;margin-top: 10px; margin-bottom: 10px" border="2" cellspacing="0" cellpadding="10">
            <tr>
                <td>Mata Pelajaran</td>
                <td>Nilai</td>
                <td>Predikat</td>
            </tr>
            @php
                $nr = 0;   
            @endphp
            @foreach ($rapor as $item)
            @php
                $nr += $item->getTotalNilai($item->siswa_id, $item->guruMataPelajaran->mata_pelajaran_id);
            @endphp
            <tr>
                <td>{{ $item->guruMataPelajaran->mataPelajaran->nama }}</td>
                <td>{{ $item->getTotalNilai($item->siswa_id, $item->guruMataPelajaran->mata_pelajaran_id) }}</td>
                <td>{{ $item->getPredikat($item->getTotalNilai($item->siswa_id, $item->guruMataPelajaran->mata_pelajaran_id)) }}</td>
            </tr>
            @endforeach
            <tr>
                <td>Nilai Rata-Rata</td>
                <td colspan="2">{{ round($nr / $rapor->count()) }}</td>
            </tr>
        </table>

        <table style="width: 100%;margin-top: 10px; margin-bottom: 10px" border="1" cellspacing="0" cellpadding="10">
            <tr>
                <td rowspan="4">Kehadiran</td>
                <td width="20%">Hadir</td>
                <td width="40%">{{ $jmlh_hadir }}</td>
            </tr>
            <tr>    
                <td width="20%">Sakit</td>
                <td width="40%">{{ $jmlh_sakit }}</td>
            </tr>
            <tr>
                <td width="20%">Izin</td>
                <td width="40%">{{ $jmlh_izin }}</td>
            </tr>
            <tr>
                <td width="20%">Alpha</td>
                <td width="40%">{{ $jmlh_alpha }}</td>
            </tr>
        </table>

        <table width="100%">
            <tr>
                <td>
                    <div>Mengetahui:
                        <div>Orang Tua Wali</div>
                    </div>
                    <div style="height: 50px"></div>
                    <div style="font-weight: bold">(..........................)</div>
                </td>
                <td>
                    <div>Kepala Sekolah</div>
                    <div style="height: 70px"></div>
                    <div style="font-weight: bold">(N.H Falentina, S.Pdi)</div>
                </td>
                <td>
                    <div>Wali Kelas</div>
                    <div style="height: 70px"></div>
                    <div style="font-weight: bold">({{ $siswa_rombel->rombel->guru->nama }})</div>
                </td>
            </tr>
        </table>
    </main>
</body>
</html>