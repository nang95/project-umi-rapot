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
                <h3 class="mb-0">Edit Siswa</h3>
              </div>
            </div>
          </div>
          <div class="card-body">
            <form method="POST" action="{{ route('admin.siswa.update') }}">
                @csrf @method('PUT')
                <h6 class="heading-small text-muted mb-4">Siswa</h6>
                <input type="hidden" name="id" value="{{ $siswa->id }}">
                <div class="row">
                  <div class="col-lg-12">
                      <div class="form-group">
                      <label class="form-control-label" for="nisn">NISN</label>
                      <input type="text" id="nisn" name="nisn" class="form-control" value="{{ old('name', $siswa->nisn) }}">
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                      <div class="form-group">
                      <label class="form-control-label" for="nama">Nama</label>
                      <input type="text" id="nama" name="nama" class="form-control" value="{{ old('nama', $siswa->nama) }}">
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                      <div class="form-group">
                      <label class="form-control-label" for="nama">Alamat</label>
                      <input type="text" id="alamat" name="alamat" class="form-control" value="{{ old('alamat', $siswa->alamat) }}">
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                      <div class="form-group">
                      <label class="form-control-label" for="no_hp">No Hp</label>
                      <input type="text" id="no_hp" name="no_hp" class="form-control" value="{{ old('no_hp', $siswa->no_hp) }}">
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                      <div class="form-group">
                      <label class="form-control-label" for="agama">Agama</label>
                      <select name="agama" id="agama" class="form-control">
                        <option value="">-Silahkan Pilih-</option>
                        <option value="Islam" 
                        @if ($siswa->agama == "Islam")
                            selected
                        @endif>Islam</option>
                        <option value="Kristen Khatolik"
                        @if ($siswa->agama == "Kristen Khatolik")
                            selected
                        @endif>Kristen Khatolik</option>
                        <option value="Kristen Protestan"
                        @if ($siswa->agama == "Kristen Protestan")
                            selected
                        @endif>Kristen Protestan</option>
                        <option value="Budha"
                        @if ($siswa->agama == "Budha")
                            selected
                        @endif>Budha</option>
                        <option value="Hindhu"
                        @if ($siswa->agama == "Hindhu")
                            selected
                        @endif>Hindhu</option>
                        <option value="Konghucu"
                        @if ($siswa->agama == "Lainnya")
                            selected
                        @endif>Lainnya</option>
                      </select>
                      </div>
                  </div>
                </div>
              
                <div class="row">  
                    <div class="col-lg-6">
                      <a href="{{ route('admin.siswa') }}">
                        <button class="btn btn-sm btn-danger">Batal</button>
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