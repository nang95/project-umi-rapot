<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::middleware('auth')->group(function(){
    Route::get('/', function(){})->middleware('checkUserLevel');
    
    Route::namespace('Admin')->prefix('/admin')->name('admin.')->group(function(){
        Route::get('/', 'DashboardController@index')->name('/');
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    
        // Sekolah
        Route::get('sekolah', 'SekolahController@index')->name('sekolah');
        Route::put('sekolah', 'SekolahController@update')->name('sekolah.update');
    
        // Jabatan
        Route::get('jabatan', 'JabatanController@index')->name('jabatan');
        Route::get('jabatan/create', 'JabatanController@create')->name('jabatan.create');
        Route::get('jabatan/edit/{jabatan}', 'JabatanController@edit')->name('jabatan.edit');
        Route::put('jabatan', 'JabatanController@update')->name('jabatan.update');
        Route::post('jabatan', 'JabatanController@store')->name('jabatan.store');
        Route::delete('jabatan', 'JabatanController@delete')->name('jabatan.delete');
    
        // Guru
        Route::get('guru', 'GuruController@index')->name('guru');
        Route::get('guru/create', 'GuruController@create')->name('guru.create');
        Route::get('guru/edit/{guru}', 'GuruController@edit')->name('guru.edit');
        Route::put('guru', 'GuruController@update')->name('guru.update');
        Route::post('guru', 'GuruController@store')->name('guru.store');
        Route::delete('guru', 'GuruController@delete')->name('guru.delete');
        
        // Siswa
        Route::get('siswa', 'SiswaController@index')->name('siswa');
        Route::get('siswa/create', 'SiswaController@create')->name('siswa.create');
        Route::get('siswa/edit/{siswa}', 'SiswaController@edit')->name('siswa.edit');
        Route::put('siswa', 'SiswaController@update')->name('siswa.update');
        Route::post('siswa', 'SiswaController@store')->name('siswa.store');
        Route::delete('siswa', 'SiswaController@delete')->name('siswa.delete');
    
        // Mata Pelajaran
        Route::get('mata_pelajaran', 'MataPelajaranController@index')->name('mata_pelajaran');
        Route::get('mata_pelajaran/create', 'MataPelajaranController@create')->name('mata_pelajaran.create');
        Route::get('mata_pelajaran/edit/{mata_pelajaran}', 'MataPelajaranController@edit')->name('mata_pelajaran.edit');
        Route::put('mata_pelajaran', 'MataPelajaranController@update')->name('mata_pelajaran.update');
        Route::post('mata_pelajaran', 'MataPelajaranController@store')->name('mata_pelajaran.store');
        Route::delete('mata_pelajaran', 'MataPelajaranController@delete')->name('mata_pelajaran.delete');

        // Guru Mapel
        Route::get('mata_pelajaran/guru_mapel/{mata_pelajaran}', 'GuruMataPelajaranController@index')->name('mata_pelajaran.guru_mapel');
        Route::get('mata_pelajaran/guru_mapel/create/{mata_pelajaran}', 'GuruMataPelajaranController@create')->name('mata_pelajaran.guru_mapel.create');
        Route::get('mata_pelajaran/edit/guru_mapel/{guru_mata_pelajaran}/{mata_pelajaran}', 'GuruMataPelajaranController@edit')->name('mata_pelajaran.guru_mapel.edit');
        Route::put('mata_pelajaran/guru_mapel', 'GuruMataPelajaranController@update')->name('mata_pelajaran.guru_mapel.update');
        Route::post('mata_pelajaran/guru_mapel', 'GuruMataPelajaranController@store')->name('mata_pelajaran.guru_mapel.store');
        Route::delete('mata_pelajaran/guru_mapel', 'GuruMataPelajaranController@delete')->name('mata_pelajaran.guru_mapel.delete');
    
        // Tingkat
        Route::get('tingkat', 'TingkatController@index')->name('tingkat');
        Route::get('tingkat/create', 'TingkatController@create')->name('tingkat.create');
        Route::get('tingkat/edit/{tingkat}', 'TingkatController@edit')->name('tingkat.edit');
        Route::put('tingkat', 'TingkatController@update')->name('tingkat.update');
        Route::post('tingkat', 'TingkatController@store')->name('tingkat.store');
        Route::delete('tingkat', 'TingkatController@delete')->name('tingkat.delete');
    
        // Kelas
        Route::get('kelas', 'KelasController@index')->name('kelas');
        Route::get('kelas/create', 'KelasController@create')->name('kelas.create');
        Route::get('kelas/edit/{kelas}', 'KelasController@edit')->name('kelas.edit');
        Route::put('kelas', 'KelasController@update')->name('kelas.update');
        Route::post('kelas', 'KelasController@store')->name('kelas.store');
        Route::delete('kelas', 'KelasController@delete')->name('kelas.delete');
        
        // Rombel
        Route::get('rombel', 'RombelController@index')->name('rombel');
        Route::get('rombel/create', 'RombelController@create')->name('rombel.create');
        Route::get('rombel/edit/{rombel}', 'RombelController@edit')->name('rombel.edit');
        Route::put('rombel', 'RombelController@update')->name('rombel.update');
        Route::post('rombel', 'RombelController@store')->name('rombel.store');
        Route::delete('rombel', 'RombelController@delete')->name('rombel.delete');
    
        // Siswa Rombel
        Route::get('siswa-rombel/{rombel}', 'SiswaRombelController@index')->name('rombel.siswa-rombel');
        Route::post('siswa-rombel', 'SiswaRombelController@store')->name('rombel.siswa-rombel.store');
        Route::delete('siswa-rombel', 'SiswaRombelController@delete')->name('rombel.siswa-rombel.delete');
        Route::post('siswa-rombel/hapus-semua', 'SiswaRombelController@deleteAll')->name('rombel.siswa-rombel.delete-all');
        Route::post('siswa-rombel/simpan-semua', 'SiswaRombelController@saveAll')->name('rombel.siswa-rombel.save-all');
    
        // Absensi
        Route::get('absensi', 'AbsensiController@index')->name('absensi');
        Route::post('absensi', 'AbsensiController@store')->name('absensi.store');
        Route::post('absensi/simpan-semua', 'AbsensiController@saveAll')->name('absensi.save-all');
    });

    Route::namespace('Guru')->prefix('/guru')->name('guru.')->group(function(){
        Route::get('/', 'DashboardController@index')->name('/');
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

        // Absensi
        Route::get('absensi', 'AbsensiController@index')->name('absensi');
        Route::post('absensi', 'AbsensiController@store')->name('absensi.store');
        Route::post('absensi/simpan-semua', 'AbsensiController@saveAll')->name('absensi.save-all');

        // Rekap Absensi
        Route::get('rekap-absensi', 'RekapAbsensiController@index')->name('rekap-absensi');

        // Daftar Nilai
        Route::get('daftar-nilai', 'DaftarNilaiController@index')->name('daftar-nilai');
        Route::post('daftar-nilai/simpan-semua', 'DaftarNilaiController@saveAll')->name('daftar-nilai.save-all');

        Route::get('rapor', 'RaporController@index')->name('rapor');
        Route::get('rapor/sikap/{siswa}', 'RaporController@sikap')->name('rapor.sikap');
        Route::post('rapor/cetak-sikap', 'RaporController@cetakSikap')->name('rapor.cetak-sikap');
        Route::get('rapor/cetak-nilai/{siswa}', 'RaporController@cetakNilai')->name('rapor.cetak-nilai');
        Route::get('rapor/catatan/{siswa}', 'RaporController@catatan')->name('rapor.catatan');
        Route::post('rapor/cetak-catatan', 'RaporController@cetakCatatan')->name('rapor.cetak-catatan');
    });

    Route::namespace('Siswa')->prefix('/siswa')->name('siswa.')->group(function(){
        Route::get('/', 'DashboardController@index')->name('/');
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

        // Daftar Nilai
        Route::get('daftar-nilai', 'DaftarNilaiController@index')->name('daftar-nilai');
        // Rekap Absensi
        Route::get('rekap-absensi', 'RekapAbsensiController@index')->name('rekap-absensi');
    });
});

