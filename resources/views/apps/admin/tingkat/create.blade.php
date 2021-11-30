@extends('layouts.app')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('admin./') }}"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.tingkat') }}">Tingkat</a></li>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-8 order-xl-1">
        <div class="card">
          <div class="card-header">
            <div class="row align-items-center">
              <div class="col-8">
                <h3 class="mb-0">Tambah Tingkat</h3>
              </div>
            </div>
          </div>
          <div class="card-body">
            <form method="POST" action="{{ route('admin.tingkat.store') }}">
                @csrf @method('POST')
                <h6 class="heading-small text-muted mb-4">Tingkat</h6>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                        <label class="form-control-label" for="name">Nama</label>
                        <input type="text" id="name" name="nama" class="form-control" value="{{ old('name') }}">
                        </div>
                    </div>
                </div>
                <div class="row">  
                    <div class="col-lg-6">
                      <a href="{{ route('admin.tingkat') }}">
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