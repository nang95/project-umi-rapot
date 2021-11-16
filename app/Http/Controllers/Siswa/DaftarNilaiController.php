<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{DaftarNilai, Siswa};

class DaftarNilaiController extends Controller
{
    public function index(Request $request){
        $q_tahun_ajaran = $request->q_tahun_ajaran;
        $q_semester = $request->q_semester;
        $q_jenis_ujian = $request->q_jenis_ujian;
        $q_periode = $request->q_periode;

        $tahun_ajaran = DaftarNilai::groupBy('tahun_ajaran')->get();
        
        $siswa = Siswa::where('user_id', auth()->user()->id)->first();
        $daftar_nilai = [];

        if (!empty($q_jenis_ujian) && !empty($q_tahun_ajaran)) {
            $daftar_nilai = DaftarNilai::where('siswa_id', $siswa->id)
                                       ->where('tahun_ajaran', $q_tahun_ajaran)
                                       ->where('semester', $q_semester)
                                       ->where('jenis_ujian', $q_jenis_ujian)
                                       ->get();
        }
        

    return view('apps.siswa.daftar-nilai.index')->with('daftar_nilai', $daftar_nilai)
                                                ->with('q_jenis_ujian', $q_jenis_ujian)
                                                ->with('q_periode', $q_periode)
                                                ->with('q_tahun_ajaran', $q_tahun_ajaran)
                                                ->with('tahun_ajaran', $tahun_ajaran)
                                                ->with('q_semester', $q_semester);
    }
}
