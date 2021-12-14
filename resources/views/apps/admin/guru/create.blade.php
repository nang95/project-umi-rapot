@extends('layouts.app')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('admin./') }}"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.guru') }}">Guru</a></li>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-8 order-xl-1">
        <div class="card">
          <div class="card-header">
            <div class="row align-items-center">
              <div class="col-8">
                <h3 class="mb-0">Tambah Guru</h3>
              </div>
            </div>
          </div>
          <div class="card-body">
            <form method="POST" action="{{ route('admin.guru.store') }}">
                @csrf @method('POST')
                <h6 class="heading-small text-muted mb-4">Guru</h6>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                        <label class="form-control-label" for="nip">NIP</label>
                        <input type="text" id="nip" name="nip" class="form-control" value="{{ old('nip') }}">
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
                      <label class="form-control-label" for="jabatan_id">Jabatan</label>
                      <select name="jabatan_id" id="jabatan_id" class="form-control">
                        <option value="">-Silahkan Pilih-</option>
                        @foreach ($jabatan as $item)
                          <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
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
                      <a href="{{ route('admin.guru') }}">
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