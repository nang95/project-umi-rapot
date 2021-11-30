<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Siswa, SiswaRombel, Sekolah, Absensi, Guru, Kelas};
use Session;

class AbsensiController extends Controller
{
    public function index(Request $request){
        $q_kelas = $request->q_kelas;
        $q_nama = $request->q_nama;
    
        $guru = Guru::where('user_id', auth()->user()->id)->first();

        $kelas = Kelas::whereIn('id', function($query) use($guru){
            $query->select('kelas_id')->from('rombels')->where('guru_id', $guru->id);
        })->get();

        $siswa_rombel = SiswaRombel::whereHas('rombel', function($query) use($guru, $q_kelas){
            $query->where('guru_id', $guru->id)->where('kelas_id', $q_kelas);
        })->get();

        foreach ($siswa_rombel as $key => $item) {
            $absensi = Absensi::where('tanggal', date('Y-m-d'))->where('siswa_id', $item->siswa_id)->first();
            $sekolah = Sekolah::first();

            if ($absensi == null) {
                Absensi::create([
                    'semester' => $sekolah->semester,
                    'tahun_ajaran' => $sekolah->tahun_ajaran,
                    'tanggal' => date('Y-m-d'),
                    'status' => null,
                    'siswa_id' => $item->siswa_id
                ]);
            }
        }
        
        $absensi = [];
        $skipped = [];

        if (!empty($q_kelas)) {
            $absensi = Absensi::whereIn('siswa_id', function($siswa_rombel) use($guru, $q_kelas){
                $siswa_rombel->select('siswa_id')->from('siswa_rombels')->whereIn('rombel_id', function($rombel) use($guru, $q_kelas){
                    $rombel->select('id')->from('rombels')->where('guru_id', $guru->id)->where('kelas_id', $q_kelas);
                });
            })->where('tanggal', date('Y-m-d'));

            if (!empty($q_nama)) {
                $absensi->whereHas('siswa', function($query) use($q_nama){
                    $query->where('nama', 'LIKE', '%'.$q_nama.'%');
                });
            }

            $absensi = $absensi->paginate();
            $skipped = ($absensi->perPage() * $absensi->currentPage()) - $absensi->perPage();
        }

        return view('apps.guru.absensi.index')->with('absensi', $absensi)
                                              ->with('kelas', $kelas)
                                              ->with('skipped', $skipped)
                                              ->with('q_nama', $q_nama)
                                              ->with('q_kelas', $q_kelas);
    }

    public function saveAll(Request $request){
        $hadir = explode(';', $request->hadir);
        foreach ($hadir as $key) {
            if(!empty($key)){
                $siswa = Siswa::findOrFail($key);
                $absensi = Absensi::where('siswa_id', $siswa->id)->where('tanggal', date('Y-m-d'))->first();
                $absensi->update([
                    'siswa_id' => $siswa->id,
                    'tanggal' => date('Y-m-d'),
                    'status' => 'H',
                ]);
            }
        }

        $sakit = explode(';', $request->sakit);
        foreach ($sakit as $key) {
            if(!empty($key)){
                $siswa = Siswa::findOrFail($key);
                $absensi = Absensi::where('siswa_id', $siswa->id)->where('tanggal', date('Y-m-d'))->first();
                $absensi->update([
                    'siswa_id' => $siswa->id,
                    'tanggal' => date('Y-m-d'),
                    'status' => 'S',
                ]);
            }
        }

        $izin = explode(';', $request->izin);
        foreach ($izin as $key) {
            if(!empty($key)){
                $siswa = Siswa::findOrFail($key);
                $absensi = Absensi::where('siswa_id', $siswa->id)->where('tanggal', date('Y-m-d'))->first();
                $absensi->update([
                    'siswa_id' => $siswa->id,
                    'tanggal' => date('Y-m-d'),
                    'status' => 'I',
                ]);
            }
        }

        $alpha = explode(';', $request->alpha);
        foreach ($alpha as $key) {
            if(!empty($key)){
                $siswa = Siswa::findOrFail($key);
                $absensi = Absensi::where('siswa_id', $siswa->id)->where('tanggal', date('Y-m-d'))->first();
                $absensi->update([
                    'siswa_id' => $siswa->id,
                    'tanggal' => date('Y-m-d'),
                    'status' => 'I',
                ]);
            }
        }

        Session::flash('flash_message', 'Data telah disimpan');
        return redirect()->back();
    }
}
