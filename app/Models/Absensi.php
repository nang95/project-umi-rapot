<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function siswa(){
        return $this->belongsTo(Siswa::class);
    }

    public function getTotalHadir($siswa_id){
        $jumlah_hadir = $this->where('siswa_id', $siswa_id)->where('status', 'H')->count();
        return round(($jumlah_hadir / 30) * 100);
    }

    public function getTotalSakit($siswa_id){
        $jumlah_sakit = $this->where('siswa_id', $siswa_id)->where('status', 'S')->count();
        return round(($jumlah_sakit / 30) * 100);
    }

    public function getTotalIzin($siswa_id){
        $jumlah_izin = $this->where('siswa_id', $siswa_id)->where('status', 'I')->count();
        return round(($jumlah_izin / 30) * 100);
    }

    public function getTotalAlfa($siswa_id){
        $jumlah_alfa = $this->where('siswa_id', $siswa_id)->where('status', 'A')->count();
        return round(($jumlah_alfa / 30) * 100);
    }
}
