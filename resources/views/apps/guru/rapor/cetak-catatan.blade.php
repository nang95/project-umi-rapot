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
        <div style="margin-top: 10px; margin-bottom: 10px">C. Catatan Wali Kelas</div>
        <div style="padding: 5px; width: 100%; min-height: 80px; border: 2px solid black">{{ $catatan }}</div>
    </main>
</body>
</html>