@extends('layouts.app')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('admin./') }}"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.guru') }}">Rombel</a></li>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-8 order-xl-1">
        <div class="card">
          <div class="card-header">
            <div class="row align-items-center">
              <div class="col-8">
                <h3 class="mb-0">Edit Rombel</h3>
              </div>
            </div>
          </div>
          <div class="card-body">
            <form method="POST" action="{{ route('admin.rombel.update') }}">
                @csrf @method('PUT')
                <h6 class="heading-small text-muted mb-4">Rombel</h6>
                <input type="hidden" name="id" value="{{ $rombel->id }}">
                <div class="row">
                  <div class="col-lg-12">
                      <div class="form-group">
                      <label class="form-control-label" for="kelas_id">Kelas</label>
                      <select name="kelas_id" id="kelas_id" class="form-control">
                        <option value="">-Silahkan Pilih-</option>
                        @foreach ($kelas as $item)
                          <option value="{{ $item->id }}"
                            @if ($item->id == $rombel->kelas_id)
                                selected
                            @endif>{{ $item->nama }}</option>
                        @endforeach
                      </select>
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                      <div class="form-group">
                      <label class="form-control-label" for="guru_id">Wali Kelas</label>
                      <select name="guru_id" id="guru_id" class="form-control">
                        <option value="">-Silahkan Pilih-</option>
                        @foreach ($guru as $item)
                          <option value="{{ $item->id }}"
                            @if ($item->id == $rombel->guru_id)
                                selected
                            @endif>{{ $item->nama }}</option>
                        @endforeach
                      </select>
                      </div>
                  </div>
                </div>
                <div class="row">  
                    <div class="col-lg-6">
                      <a href="{{ route('admin.rombel') }}">
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