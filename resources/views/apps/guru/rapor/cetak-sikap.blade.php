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
                <td>Nama Sekolah</td>
                <td>: SMK Az-Zahra</td>
                <td style="width: 60%;"></td>
                <td>Kelas</td>
                <td>: {{ $siswa_rombel->rombel->kelas->nama }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>: Batubara</td>
                <td></td>
                <td>Semester</td>
                <td>: {{ $sekolah->semester }}</td>
            </tr>
            <tr>
                <td>Nama Peserta Didik</td>
                <td>: {{ $siswa_rombel->siswa->nama }}</td>
                <td></td>
                <td>Tahun Ajaran</td>
                <td>: {{ $sekolah->tahun_ajaran }}</td>
            </tr>
            <tr>
                <td>NISN</td>
                <td>: {{ $siswa_rombel->siswa->nisn }}</td>
                <td colspan="3"></td>
            </tr>
        </table>
    </header>

    <main>
        <div style="margin-top: 20px">A. Sikap</div>
        <div style="margin-top: 10px; margin-bottom: 10px">1. Sikap Spiritual</div>
        <table style="width: 100%" border="1" cellspacing="0" cellpadding="10">
            <tr>
                <td>Predikat</td>
                <td>Deskripsi</td>
            </tr>
            <tr>
                <td>{{ $data['predikat_spiritual'] }}</td>
                <td>{{ $data['deskripsi_spiritual'] }}</td>
            </tr>
        </table>
        <div style="margin-top: 10px; margin-bottom: 10px">2. Sikap Sosial</div>
        <table style="width: 100%" border="1" cellspacing="0" cellpadding="10">
            <tr>
                <td>Predikat</td>
                <td>Deskripsi</td>
            </tr>
            <tr>
                <td>{{ $data['predikat_sosial'] }}</td>
                <td>{{ $data['deskripsi_sosial'] }}</td>
            </tr>
        </table>
    </main>
</body>
</html>