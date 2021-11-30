@extends('layouts.app')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('admin./') }}"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.mata_pelajaran') }}">Mata Pelajaran</a></li>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-8 order-xl-1">
        <div class="card">
          <div class="card-header">
            <div class="row align-items-center">
              <div class="col-8">
                <h3 class="mb-0">Edit Mata Pelajaran</h3>
              </div>
            </div>
          </div>
          <div class="card-body">
            <form method="POST" action="{{ route('admin.mata_pelajaran.guru_mapel.update') }}">
                @csrf @method('PUT')
                <h6 class="heading-small text-muted mb-4">Mata Pelajaran</h6>
                <input type="hidden" name="id" value="{{ $guru_mata_pelajaran->id }}">
                <input type="hidden" name="mata_pelajaran_id" value="{{ $mata_pelajaran->id }}">
                <div class="row">
                  <div class="col-lg-12">
                      <div class="form-group">
                      <label class="form-control-label" for="kelas_id">Kelas</label>
                      <select name="kelas_id" id="kelas_id" class="form-control">
                        <option value="">-Silahkan Pilih-</option>
                        @foreach ($kelas as $item)
                          <option value="{{ $item->id }}"
                            @if ($guru_mata_pelajaran->guru_id == $item->id)
                                selected
                            @endif>{{ $item->nama }} - {{ $item->tingkat->nama }}</option>
                        @endforeach
                      </select>
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                      <div class="form-group">
                      <label class="form-control-label" for="guru_id">Guru Mapel</label>
                      <select name="guru_id" id="guru_id" class="form-control">
                        <option value="">-Silahkan Pilih-</option>
                        @foreach ($guru as $item)
                          <option value="{{ $item->id }}"
                            @if ($guru_mata_pelajaran->kelas_id == $item->id)
                                selected
                            @endif>{{ $item->nip }} - {{ $item->nama }}</option>
                        @endforeach
                      </select>
                      </div>
                  </div>
                </div>
                <div class="row">  
                    <div class="col-lg-6">
                      <a href="{{ route('admin.mata_pelajaran') }}">
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