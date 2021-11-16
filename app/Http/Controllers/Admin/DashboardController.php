<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Guru, Siswa, Kelas, Absensi, SiswaRombel};

class DashboardController extends Controller
{
    public function index(){
        $guru = Guru::count();
        $siswa = Siswa::count();
        $kelas = Kelas::count();

        $kehadiran = [];

        $data_siswa = Siswa::whereIn('id', function($query){
            $query->select('siswa_id')->from('absensis')->where('status', 'H')->where('tanggal', date('Y-m-d'));
        })->get();

        foreach ($data_siswa as $key => $item) {
            $siswa_rombel = SiswaRombel::where('siswa_id', $item->id)->first();
            array_push($kehadiran,[
                'nama' => $item->nama,
                'nisn' => $item->nisn,
                'kelas' => $siswa_rombel->rombel->kelas->nama,
            ]);
        }

        return view('apps.admin.dashboard')->with('guru', $guru)
                                           ->with('siswa', $siswa)
                                           ->with('kelas', $kelas)
                                           ->with('kehadiran', $kehadiran);
    }
}
