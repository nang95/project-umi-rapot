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
                <h3 class="mb-0">Edit Guru</h3>
              </div>
            </div>
          </div>
          <div class="card-body">
            <form method="POST" action="{{ route('admin.guru.update') }}">
                @csrf @method('PUT')
                <h6 class="heading-small text-muted mb-4">Guru</h6>
                <input type="hidden" name="id" value="{{ $guru->id }}">
                <div class="row">
                  <div class="col-lg-12">
                      <div class="form-group">
                      <label class="form-control-label" for="nip">NIP</label>
                      <input type="text" id="nip" name="nip" class="form-control" value="{{ old('name', $guru->nip) }}">
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                      <div class="form-group">
                      <label class="form-control-label" for="nama">Nama</label>
                      <input type="text" id="nama" name="nama" class="form-control" value="{{ old('nama', $guru->nama) }}">
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                      <div class="form-group">
                      <label class="form-control-label" for="nama">Alamat</label>
                      <input type="text" id="alamat" name="alamat" class="form-control" value="{{ old('alamat', $guru->alamat) }}">
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                      <div class="form-group">
                      <label class="form-control-label" for="no_hp">No Hp</label>
                      <input type="text" id="no_hp" name="no_hp" class="form-control" value="{{ old('no_hp', $guru->no_hp) }}">
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
                        @if ($guru->agama == "Islam")
                            selected
                        @endif>Islam</option>
                        <option value="Kristen Khatolik"
                        @if ($guru->agama == "Kristen Khatolik")
                            selected
                        @endif>Kristen Khatolik</option>
                        <option value="Kristen Protestan"
                        @if ($guru->agama == "Kristen Protestan")
                            selected
                        @endif>Kristen Protestan</option>
                        <option value="Budha"
                        @if ($guru->agama == "Budha")
                            selected
                        @endif>Budha</option>
                        <option value="Hindhu"
                        @if ($guru->agama == "Hindhu")
                            selected
                        @endif>Hindhu</option>
                        <option value="Konghucu"
                        @if ($guru->agama == "Lainnya")
                            selected
                        @endif>Lainnya</option>
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
                          <option value="{{ $item->id }}"
                            @if ($guru->jabatan_id == $item->id)
                                selected
                            @endif>{{ $item->name }}</option>
                        @endforeach
                      </select>
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