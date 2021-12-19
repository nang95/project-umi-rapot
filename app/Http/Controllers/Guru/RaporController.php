<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{MataPelajaran, 
                Kelas, 
                Absensi, 
                Siswa, 
                Guru, 
                GuruMataPelajaran, 
                SiswaRombel, 
                Sekolah, 
                DaftarNilai};
use PDF;

class RaporController extends Controller
{
    public function index(Request $request){
        $q_kelas = $request->q_kelas;
        $q_tahun_ajaran = $request->q_tahun_ajaran;

        $sekolah = Sekolah::first();
        $guru = Guru::where('user_id', auth()->user()->id)->first();
        
        $kelas = Kelas::whereIn('id', function($query) use($guru){
            $query->select('kelas_id')->from('rombels')->where('guru_id', $guru->id);
        })->get();

        $tahun_ajaran = DaftarNilai::groupBy('tahun_ajaran')->get();

        $rapor = [];
        $skipped = [];
        if (!empty($q_kelas) && !empty($q_tahun_ajaran)) {
            $rapor = DaftarNilai::where('tahun_ajaran', $sekolah->tahun_ajaran)
                                ->whereIn('siswa_id', function($siswa_rombel) use($q_kelas){
                                    $siswa_rombel->select('siswa_id')->from('siswa_rombels')->whereIn('rombel_id', function($rombel) use($q_kelas){
                                        $rombel->select('id')->from('rombels')->where('kelas_id', $q_kelas);
                                    });
                                })
                                ->groupBy('siswa_id');
            
            $rapor = $rapor->paginate();
            $skipped = ($rapor->perPage() * $rapor->currentPage()) - $rapor->perPage();
        }

        return view('apps.guru.rapor.index')->with('rapor', $rapor)
                                            ->with('skipped', $skipped)
                                            ->with('tahun_ajaran', $tahun_ajaran)
                                            ->with('kelas', $kelas)
                                            ->with('q_kelas', $q_kelas)
                                            ->with('q_tahun_ajaran', $q_tahun_ajaran);
    }

    public function sikap(Siswa $siswa){
        return view('apps.guru.rapor.sikap')->with('siswa', $siswa);
    }

    public function cetakSikap(Request $request){    
        $siswa_rombel = SiswaRombel::where('siswa_id', $request->siswa_id)->first();
        $sekolah = Sekolah::first();

        $data = $request->all();

        // return view('apps.guru.rapor.cetak-sikap')->with('siswa_rombel', $siswa_rombel)
        //                                           ->with('sekolah', $sekolah)
        //                                           ->with('data', $data);

        $pdf = PDF::loadview('apps.guru.rapor.cetak-sikap',[
            'data' => $data,
            'siswa_rombel' => $siswa_rombel,
            'sekolah' => $sekolah,
        ]);

	    return $pdf->download('lembar-1.pdf');
    }

    public function cetakNilai(Siswa $siswa){
        $siswa_rombel = SiswaRombel::where('siswa_id', $siswa->id)->first();
        $sekolah = Sekolah::first();
        $rapor = DaftarNilai::where('tahun_ajaran', $sekolah->tahun_ajaran)
                            ->where('semester', $sekolah->semester)
                            ->groupBy('guru_mata_pelajaran_id')
                            ->get();
        
        $jmlh_hadir = Absensi::where('siswa_id', $siswa->id)->where('status','H')->count();
        $jmlh_sakit = Absensi::where('siswa_id', $siswa->id)->where('status','S')->count();
        $jmlh_izin = Absensi::where('siswa_id', $siswa->id)->where('status','I')->count();
        $jmlh_alpha = Absensi::where('siswa_id', $siswa->id)->where('status','A')->count();

        
        // return view('apps.guru.rapor.cetak-nilai')->with('rapor', $rapor)
        //                                           ->with('siswa_rombel', $siswa_rombel)
        //                                           ->with('sekolah', $sekolah);

        $pdf = PDF::loadview('apps.guru.rapor.cetak-nilai',[
            'rapor' => $rapor,
            'siswa_rombel' => $siswa_rombel,
            'sekolah' => $sekolah,
            'jmlh_hadir' => $jmlh_hadir,
            'jmlh_sakit' => $jmlh_sakit,
            'jmlh_izin' => $jmlh_izin,
            'jmlh_alpha' => $jmlh_alpha,
        ]);

	    return $pdf->download('lembar-2.pdf');
    }

    public function catatan(Siswa $siswa){
        return view('apps.guru.rapor.catatan')->with('siswa', $siswa);
    }

    public function cetakCatatan(Request $request){    
        $siswa_rombel = SiswaRombel::where('siswa_id', $request->siswa_id)->first();
        $sekolah = Sekolah::first();

        $hadir = Absensi::where('status', 'H')
                            ->where('siswa_id', $request->siswa_id)
                            ->where('semester', $sekolah->semester)
                            ->where('tahun_ajaran', $sekolah->tahun_ajaran)
                            ->count();

        $izin = Absensi::where('status', 'I')
                            ->where('siswa_id', $request->siswa_id)
                            ->where('semester', $sekolah->semester)
                            ->where('tahun_ajaran', $sekolah->tahun_ajaran)
                            ->count();

        $sakit = Absensi::where('status', 'S')
                            ->where('siswa_id', $request->siswa_id)
                            ->where('semester', $sekolah->semester)
                            ->where('tahun_ajaran', $sekolah->tahun_ajaran)
                            ->count();

        $alfa = Absensi::where('status', 'A')
                            ->where('siswa_id', $request->siswa_id)
                            ->where('semester', $sekolah->semester)
                            ->where('tahun_ajaran', $sekolah->tahun_ajaran)
                            ->count();

        $data = $request->all();

        // return view('apps.guru.rapor.cetak-catatan')->with('siswa_rombel', $siswa_rombel)
        //                                           ->with('sekolah', $sekolah)
        //                                           ->with('hadir', $hadir)
        //                                           ->with('izin', $izin)
        //                                           ->with('alfa', $alfa)
        //                                           ->with('sakit', $sakit)
        //                                           ->with('data', $data);
        
        $pdf = PDF::loadview('apps.guru.rapor.cetak-catatan',[
            'siswa_rombel' => $siswa_rombel,
            'sekolah' => $sekolah,
            'hadir' => $hadir,
            'sakit' => $sakit,
            'izin' => $izin,
            'alfa' => $alfa,
            'data' => $data,
        ]);
                                        
        return $pdf->download('lembar-3.pdf');
    }
}
