@extends('layouts.app')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('admin./') }}"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.siswa') }}">Siswa</a></li>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-8 order-xl-1">
        <div class="card">
          <div class="card-header">
            <div class="row align-items-center">
              <div class="col-8">
                <h3 class="mb-0">Tambah Siswa</h3>
              </div>
            </div>
          </div>
          <div class="card-body">
            <form method="POST" action="{{ route('admin.siswa.store') }}">
                @csrf @method('POST')
                <h6 class="heading-small text-muted mb-4">Siswa</h6>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                        <label class="form-control-label" for="nisn">NISN</label>
                        <input type="text" id="nisn" name="nisn" class="form-control" value="{{ old('nisn') }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                      <div class="form-group">
                      <label class="form-control-label" for="nama">Nama</label>
                      <input type="text" id="nama" name="nama" class="form-control" value="{{ old('nama') }}">
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                      <div class="form-group">
                      <label class="form-control-label" for="nama">Alamat</label>
                      <input type="text" id="alamat" name="alamat" class="form-control" value="{{ old('alamat') }}">
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                      <div class="form-group">
                      <label class="form-control-label" for="no_hp">No Hp</label>
                      <input type="text" id="no_hp" name="no_hp" class="form-control" value="{{ old('no_hp') }}">
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                      <div class="form-group">
                      <label class="form-control-label" for="agama">Agama</label>
                      <select name="agama" id="agama" class="form-control">
                        <option value="">-Silahkan Pilih-</option>
                        <option value="Islam">Islam</option>
                        <option value="Kristen Khatolik">Kristen Khatolik</option>
                        <option value="Kristen Protestan">Kristen Protestan</option>
                        <option value="Budha">Budha</option>
                        <option value="Hindhu">Hindhu</option>
                        <option value="Lainnya">Lainnya</option>
                      </select>
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                      <div class="form-group">
                      <label class="form-control-label" for="email">Email</label>
                      <input type="text" id="email" name="email" class="form-control" value="{{ old('email') }}">
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                      <div class="form-group">
                      <label class="form-control-label" for="password">Password</label>
                      <input type="password" id="password" name="password" class="form-control" value="{{ old('password') }}">
                      </div>
                  </div>
                </div>
                <div class="row">  
                    <div class="col-lg-6">
                      <a href="{{ route('admin.siswa') }}">
                        <button type="button" class="btn btn-sm btn-danger">Batal</button>
                      </a>
                    </div>
                    <div class="col-lg-6 text-right">
                      <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                    </div>
                </div>
            </form>
          </div>
        </div>
      </div>
</div>    
@endsection