<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{MataPelajaran, Kelas, Siswa, Guru, GuruMataPelajaran, Sekolah, DaftarNilai};

class DaftarNilaiController extends Controller
{
    public function index(Request $request){
        $q_mapel = $request->q_mapel;
        $q_kelas = $request->q_kelas;
        $q_jenis_ujian = $request->q_jenis_ujian;
        $q_periode = $request->q_periode;
        
        $guru = Guru::where('user_id', auth()->user()->id)->first();
        $mata_pelajaran = MataPelajaran::whereIn('id', function($query) use($guru){
            $query->select('mata_pelajaran_id')->from('guru_mata_pelajarans')->where('guru_id', $guru->id);
        })->get();

        $guru_mata_pelajaran = GuruMataPelajaran::where('guru_id', $guru->id)->where('mata_pelajaran_id', $q_mapel)->first();

        $kelas = Kelas::whereIn('id', function($query) use($guru){
            $query->select('kelas_id')->from('guru_mata_pelajarans')->where('guru_id', $guru->id);
        })->get();

        $daftar_nilai = [];

        if (!empty($q_mapel) && !empty($q_kelas)) {
            $sekolah = Sekolah::first();
           
            $siswa = Siswa::whereIn('id', function($siswa_rombel) use($q_kelas, $guru){
                $siswa_rombel->select('siswa_id')->from('siswa_rombels')->whereIn('rombel_id', function($rombel) use($q_kelas, $guru){
                    $rombel->select('id')->from('rombels')->where('kelas_id', $q_kelas);
                });
            })->get();

            foreach ($siswa as $key => $item) {
                $daftar_nilai = DaftarNilai::where('siswa_id', $item->id)
                                        ->where('guru_mata_pelajaran_id', $guru_mata_pelajaran->id)
                                        ->where('semester', $sekolah->semester)
                                        ->where('tahun_ajaran', $sekolah->tahun_ajaran)
                                        ->where('jenis_ujian', $q_jenis_ujian)
                                        ->where('periode', $q_periode)
                                        ->first();

                if($daftar_nilai == null){
                    DaftarNilai::create([
                        'siswa_id' => $item->id,
                        'jenis_ujian' => $q_jenis_ujian,
                        'periode' => $q_periode,
                        'semester' => $sekolah->semester,
                        'tahun_ajaran' => $sekolah->tahun_ajaran,
                        'guru_mata_pelajaran_id' => $guru_mata_pelajaran->id,
                        'nilai' => 0,
                    ]);
                }

                $daftar_nilai = DaftarNilai::whereHas('guruMataPelajaran', function($query) use($guru, $q_mapel){
                    $query->where('guru_id', $guru->id)->where('mata_pelajaran_id', $q_mapel);
                })
                ->whereIn('siswa_id', function($siswa_rombel) use($q_kelas, $guru){
                    $siswa_rombel->select('siswa_id')->from('siswa_rombels')->whereIn('rombel_id', function($rombel) use($q_kelas, $guru){
                        $rombel->select('id')->from('rombels')->where('kelas_id', $q_kelas);
                    });
                })
                ->where('jenis_ujian', $q_jenis_ujian)
                ->where('periode', $q_periode)->get();
            }

        }
        

    return view('apps.guru.daftar-nilai.index')->with('daftar_nilai', $daftar_nilai)
                                                ->with('kelas', $kelas)
                                                ->with('mata_pelajaran', $mata_pelajaran)
                                                ->with('q_mapel', $q_mapel)
                                                ->with('q_kelas', $q_kelas)
                                                ->with('q_jenis_ujian', $q_jenis_ujian)
                                                ->with('q_periode', $q_periode);
    }

    public function saveAll(Request $request){
        $daftar_nilai = $request->ids;
        foreach ($daftar_nilai as $key => $item) {
            if(!empty($item)){
                $daftar_nilai = DaftarNilai::findOrFail($item);
                $daftar_nilai->update([
                    'siswa_id' => $request->siswa_ids[$key],
                    'nilai' => $request->nilai[$key],
                ]);
            }
        }

        return redirect()->back();
    }

}
