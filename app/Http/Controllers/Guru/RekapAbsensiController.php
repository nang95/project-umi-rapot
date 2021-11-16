<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Guru, Absensi, Kelas};

class RekapAbsensiController extends Controller
{
    public function index(Request $request){
        $q_kelas = $request->q_kelas;
        $q_nama = $request->q_nama;
        
        $kelas = Kelas::get();
        $guru = Guru::where('user_id', auth()->user()->id)->first();

        $rekap_absensi = Absensi::whereIn('siswa_id', function($siswa_rombel) use($guru){
            $siswa_rombel->select('siswa_id')->from('siswa_rombels')->whereIn('rombel_id', function($rombel) use($guru){
                $rombel->select('id')->from('rombels')->where('guru_id', $guru->id);
            });
        })->groupBy('siswa_id');

        $rekap_absensi = $rekap_absensi->paginate();
        $skipped = ($rekap_absensi->perPage() * $rekap_absensi->currentPage()) - $rekap_absensi->perPage();

        return view('apps.guru.rekap-absensi.index')->with('kelas', $kelas)
                                                    ->with('skipped', $skipped)
                                                    ->with('q_nama', $q_nama)
                                                    ->with('q_kelas', $q_kelas)
                                                    ->with('rekap_absensi', $rekap_absensi);
    }
}
