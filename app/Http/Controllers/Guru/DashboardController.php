<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Guru, Siswa, Kelas, Absensi, SiswaRombel};

class DashboardController extends Controller
{
    public function index(){
        
        $kehadiran = [];

        $data_guru = Guru::where('user_id', auth()->user()->id)->first();
        
        $data_siswa = Siswa::whereIn('id', function($query){
            $query->select('siswa_id')->from('absensis')->where('tanggal', date('Y-m-d'))->where('status', 'H');
        })->whereIn('id', function($siswa_rombel) use($data_guru){
            $siswa_rombel->select('siswa_id')->from('siswa_rombels')->whereIn('rombel_id', function($rombel) use($data_guru) {
                $rombel->select('id')->from('rombels')->where('guru_id', $data_guru->id);
            });
        })->get();

        $siswa = Siswa::whereIn('id', function($siswa_rombel) use($data_guru){
            $siswa_rombel->select('siswa_id')->from('siswa_rombels')->whereIn('rombel_id', function($rombel) use($data_guru){
                $rombel->select('id')->from('rombels')->where('guru_id', $data_guru->id);
            });
        })->count();

        $kelas = Kelas::whereIn('id', function($rombel) use($data_guru){
            $rombel->select('id')->from('rombels')->where('guru_id', $data_guru->id);
        })->count();

        foreach ($data_siswa as $key => $item) {
            $siswa_rombel = SiswaRombel::where('siswa_id', $item->id)->first();
            array_push($kehadiran,[
                'nama' => $item->nama,
                'nisn' => $item->nisn,
                'kelas' => $siswa_rombel->rombel->kelas->nama,
            ]);
        }
        
        return view('apps.guru.dashboard')->with('siswa', $siswa)
                                          ->with('kelas', $kelas)
                                          ->with('kehadiran', $kehadiran);
    }
}
