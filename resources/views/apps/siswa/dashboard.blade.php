@extends('layouts.app')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item"><a href="#">Dashboards</a></li>
@endsection

@section('content')
<div class="row">
  <div class="col-xl-8">
    <div class="card">
      <div class="card-header border-0">
        <div class="row align-items-center">
          <div class="col">
            <h3 class="mb-0">Daftar Nilai</h3>
          </div>
          <div class="col text-right">
            
          </div>
        </div>
      </div>
      <div class="table-responsive">
        <!-- Projects table -->
        <table class="table align-items-center table-flush">
          <thead class="thead-light">
            <tr>
              <th scope="col">Mata Pelajaran</th>
              <th scope="col">Kategori</th>
              <th scope="col">Nilai</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($daftar_nilai as $item)
            <tr>
              <th scope="row">{{ $item->guruMataPelajaran->mataPelajaran->nama }}</th>
              <td>{{ $item->jenis_ujian }}</td>
              <td>{{ $item->nilai }}</td>                
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>  
@endsection