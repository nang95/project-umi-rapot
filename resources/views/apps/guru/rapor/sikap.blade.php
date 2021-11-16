@extends('layouts.app')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('guru./') }}"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item"><a href="{{ route('guru.rapor') }}">Cetak Sikap</a></li>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-8 order-xl-1">
        <div class="card">
          <div class="card-header">
            <div class="row align-items-center">
              <div class="col-8">
                <h3 class="mb-0">Cetak Sikap</h3>
              </div>
            </div>
          </div>
          <div class="card-body">
            <form method="POST" action="{{ route('guru.rapor.cetak-sikap') }}">
                @csrf @method('POST')
                <h6 class="heading-small text-muted mb-4">Cetak Sikap</h6>
                <input type="hidden" name="siswa_id" value="{{ $siswa->id }}">
                <div class="row">
                  <div class="col-lg-12">
                      <div class="form-group">
                      <label class="form-control-label" for="predikat_spiritual">Predikat Spiritual</label>
                      <input type="text" id="predikat_spiritual" name="predikat_spiritual" class="form-control" value="{{ old('predikat_spiritual') }}">
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                      <div class="form-group">
                      <label class="form-control-label" for="deskripsi_spiritual">Deksripsi Spiritual</label>
                      <input type="text" id="deskripsi_spiritual" name="deskripsi_spiritual" class="form-control" value="{{ old('deskripsi_spiritual') }}">
                      </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                        <label class="form-control-label" for="predikat_sosial">Predikat Sosial</label>
                        <input type="text" id="predikat_sosial" name="predikat_sosial" class="form-control" value="{{ old('sikap_sosial') }}">
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                        <label class="form-control-label" for="deskripsi_sosial">Deksripsi Sosial</label>
                        <input type="text" id="deskripsi_sosial" name="deskripsi_sosial" class="form-control" value="{{ old('deskripsi_sosial') }}">
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