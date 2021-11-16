@extends('layouts.app')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('guru./') }}"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item"><a href="{{ route('guru.rapor') }}">Rapot</a></li>
@endsection

@section('content')
@if(Session::has('flash_message'))
<script type="text/javascript">
    Swal.fire("Berhasil!","{{ Session('flash_message') }}", "success");
</script>
@endif

<div class="row">
    <div class="col-xl-12">
        <div class="card">
          <div class="card-header">
            <div class="row align-items-center">
              <div class="col-12">
                <h3 class="mb-0">Rapot</h3>
              </div>
            </div>
          </div>
          <div class="card-body">
            <form method="GET" action="{{ route('guru.rapor') }}">
                <h6 class="heading-small text-muted mb-4">Rapot</h6>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="q_kelas">Kelas</label>
                            <select name="q_kelas" id="q_kelas" class="form-control" required>
                                <option value="">-Silahkan Pilih-</option>
                                @foreach ($kelas as $item)
                                <option value="{{ $item->id }}"
                                    @if ($item->id == $q_kelas)
                                        selected
                                    @endif>{{ $item->nama }} - {{ $item->tingkat->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="q_tahun_ajaran">Tahun Ajaran</label>
                            <select name="q_tahun_ajaran" id="q_tahun_ajaran" class="form-control" required>
                                <option value="">-Silahkan Pilih-</option>
                                @foreach ($tahun_ajaran as $item)
                                <option value="{{ $item->id }}"
                                    @if ($item->id == $q_tahun_ajaran)
                                        selected
                                    @endif>{{ $item->tahun_ajaran }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">  
                    <div class="col-lg-6">
                      <button type="submit" class="btn btn-sm btn-success">Cari</button>
                    </div>
                </div>
            </form>
          </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">Rapot</h3>
                    </div>
                    <div class="col text-right">
                        <button class="btn btn-sm btn-success">Simpan</button>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <!-- Projects table -->
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">NISN</th>
                        <th scope="col">Siswa</th>
                        <th scope="col">Cetak</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($q_kelas != "" && $q_tahun_ajaran != "")
                            @if (count($rapor) === 0)
                            <tr>
                                <td colspan="8" style="text-align:center">
                                    @if ($q_kelas == "" || $q_tahun_ajaran == "")
                                        <span>Data Kosong</span>
                                    @else
                                        <span>Kriteria yang anda cari tidak sesuai</span>
                                    @endif
                                </td>
                            </tr>
                            @endif

                            @foreach ($rapor as $data_rapor)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data_rapor->siswa->nisn }}</td>
                                <td>{{ $data_rapor->siswa->nama }}</td>
                                <td>
                                    <a href="{{ route('guru.rapor.sikap', $data_rapor->siswa_id) }}">
                                        <button class="btn btn-primary btn-sm">Cetak Sikap</button>
                                    </a>
                                    <a href="{{ route('guru.rapor.cetak-nilai', $data_rapor->siswa_id) }}">
                                        <button class="btn btn-info btn-sm">Cetak Nilai</button>
                                    </a>
                                    <a href="{{ route('guru.rapor.catatan', $data_rapor->siswa_id) }}">
                                        <button class="btn btn-default btn-sm">Cetak Catatan</button>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>  
 
@endsection

@section('footer-scripts')
<script type="text/javascript">
  function deleteThis(e){
      e.preventDefault();
      Swal.fire({
      title: "<div style='font-size:20px'>Apakah anda yakin?</div>",
      html: "<div style='font-size:15px'>Data akan dihapus secara permanen!</div>",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya',
      cancelButtonText: 'Batal'
      })
      .then((res) => {
          if (res.isConfirmed) {
              e.target.submit();
              swal("Data telah dihapus!", {
              icon: "success",
              });
          }
      });

      return false;
  }
</script>
@endsection