<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Siswa, DaftarNilai};

class DashboardController extends Controller
{
    public function index(){
        $siswa = Siswa::where('user_id', auth()->user()->id)->first();
        $daftar_nilai = DaftarNilai::groupBy('jenis_ujian')->where('siswa_id', $siswa->id)->get();

        return view('apps.siswa.dashboard')->with('daftar_nilai', $daftar_nilai);
    }
}
