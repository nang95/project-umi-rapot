@extends('layouts.app')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item"><a href="#">Dashboards</a></li>
<li class="breadcrumb-item active" aria-current="page">Default</li>
@endsection

@section('content')
  <div class="row">
    <div class="col-xl-8">
      <div class="card">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Absensi Hadir Dini Hari</h3>
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
                <th scope="col">Nama</th>
                <th scope="col">Nisn</th>
                <th scope="col">Kelas</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($kehadiran as $item)
              <tr>
                <th scope="row">{{ $item['nama'] }}</th>
                <td>{{ $item['nisn'] }}</td>
                <td>{{ $item['kelas'] }}</td>                
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-xl-4">
      <div class="row">
        <div class="col-xl-12 col-md-6">
          <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0">Jumlah Siswa</h5>
                  <span class="h2 font-weight-bold mb-0">{{ $siswa }}</span>
                </div>
                <div class="col-auto">
                  <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                    <i class="ni ni-active-40"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-12 col-md-6">
          <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0">Jumlah Guru</h5>
                  <span class="h2 font-weight-bold mb-0">{{ $guru }}</span>
                </div>
                <div class="col-auto">
                  <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                    <i class="ni ni-chart-pie-35"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-12 col-md-6">
          <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0">Jumlah Kelas</h5>
                  <span class="h2 font-weight-bold mb-0">{{ $kelas }}</span>
                </div>
                <div class="col-auto">
                  <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                    <i class="ni ni-money-coins"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>    
@endsection