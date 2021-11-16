<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarNilai extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function guruMataPelajaran(){
        return $this->belongsTo(GuruMataPelajaran::class);
    }

    public function siswa(){
        return $this->belongsTo(Siswa::class);
    }

    public function getPredikat($nilai){
        if ($nilai >= 91) {
            return "A";
        }elseif($nilai >= 83){
            return "B";
        }elseif($nilai >= 75){
            return "C";
        }elseif($nilai <= 75){
            return "D";
        }
    }

    public function getTotalNilai($siswa_id, $mata_pelajaran_id){
        $sekolah = Sekolah::first();
        $daftar_nilai = DaftarNilai::where('siswa_id', $siswa_id)
                                   ->where('tahun_ajaran', $sekolah->tahun_ajaran)
                                   ->whereHas('guruMataPelajaran', function($query) use($mata_pelajaran_id){
                                       $query->where('mata_pelajaran_id', $mata_pelajaran_id);
                                   });

        $jumlah_penilaian = $daftar_nilai->count();
        $nilai = $daftar_nilai->sum('nilai');

        return ($nilai / $jumlah_penilaian);
    }
}
