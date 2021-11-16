@extends('layouts.app')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('admin./') }}"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.mata_pelajaran') }}">Mata Pelajaran</a></li>
@endsection

@section('content')
@if(Session::has('flash_message'))
<script type="text/javascript">
    Swal.fire("Berhasil!","{{ Session('flash_message') }}", "success");
</script>
@endif

<div class="row">
  <div class="col-xl-6">
      <div class="card">
        <div class="card-body">
          <form method="GET" action="{{ route('admin.mata_pelajaran') }}">
                <div class="row">
                  <div class="col-lg-12">
                      <div class="form-group">
                          <label class="form-control-label" for="q_nama">Nama</label>
                          <input type="string" id="q_nama" name="q_nama" class="form-control form-control-sm" value="{{ $q_nama }}">
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
  <div class="col-xl-8">
    <div class="card">
      <div class="card-header border-0">
        <div class="row align-items-center">
          <div class="col">
            <h3 class="mb-0">Mata Pelajaran</h3>
          </div>
          <div class="col text-right">
            <a href="{{ route('admin.mata_pelajaran.create') }}" class="btn btn-sm btn-primary">Tambah</a>
          </div>
        </div>
      </div>
      <div class="table-responsive">
        <!-- Projects table -->
        <table class="table align-items-center table-flush">
          <thead class="thead-light">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nama</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @if (count($mata_pelajaran) === 0)
            <tr>
                <td colspan="8" style="text-align:center">
                    @if ($q_nama == "")
                        <span>Data Kosong</span>
                    @else
                        <span>Kriteria yang anda cari tidak sesuai</span>
                    @endif
                </td>
            </tr>
            @endif

            @foreach ($mata_pelajaran as $data_mata_pelajaran)
            <tr>
                <td>{{ $loop->iteration + $skipped }}</td>
                <td>{{ $data_mata_pelajaran->nama }}</td>
                <td>
                    <a href="{{ route('admin.mata_pelajaran.edit', $data_mata_pelajaran->id) }}">
                        <button class="btn btn-warning btn-sm">Ubah</button>
                    </a>
                    <a href="{{ route('admin.mata_pelajaran.guru_mapel', $data_mata_pelajaran->id) }}">
                      <button class="btn btn-info btn-sm">Guru Mapel</button>
                  </a>
                    <form onsubmit="deleteThis(event)" action="{{ route('admin.mata_pelajaran.delete') }}" method="POST" style="display:inline-block">
                        {{ csrf_field() }} {{ method_field('DELETE') }}
                        <input type="hidden" name="id" value="{{ $data_mata_pelajaran->id }}">
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="card-footer">
        {{ $mata_pelajaran->appends(['q_nama' => $q_nama])->links() }}
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