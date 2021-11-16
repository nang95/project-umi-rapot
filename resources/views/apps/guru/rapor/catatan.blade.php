@extends('layouts.app')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('guru./') }}"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item"><a href="{{ route('guru.rapor') }}">Cetak Catatan</a></li>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-8 order-xl-1">
        <div class="card">
          <div class="card-header">
            <div class="row align-items-center">
              <div class="col-8">
                <h3 class="mb-0">Cetak Catatan</h3>
              </div>
            </div>
          </div>
          <div class="card-body">
            <form method="POST" action="{{ route('guru.rapor.cetak-catatan') }}">
                @csrf @method('POST')
                <h6 class="heading-small text-muted mb-4">Cetak Catatan</h6>
                <input type="hidden" name="siswa_id" value="{{ $siswa->id }}">
                <div class="row">
                  <div class="col-lg-12">
                      <div class="form-group">
                      <label class="form-control-label" for="catatan_wali_kelas">Catatan Wali Kelas</label>
                      <input type="text" id="catatan_wali_kelas" name="catatan_wali_kelas" class="form-control" value="{{ old('catatan_wali_kelas') }}">
                      </div>
                  </div>
                </div>
                <div class="row">  
                    <div class="col-lg-6">
                      <a href="{{ route('guru.rapor') }}">
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