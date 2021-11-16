@extends('layouts.app')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('admin./') }}"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.mata_pelajaran') }}">Guru Mata Pelajaran</a></li>
@endsection

@section('content')
@if(Session::has('flash_message'))
<script type="text/javascript">
    Swal.fire("Berhasil!","{{ Session('flash_message') }}", "success");
</script>
@endif

<div class="row">
  <div class="col-xl-8">
    <div class="card">
      <div class="card-header border-0">
        <div class="row align-items-center">
          <div class="col">
            <h3 class="mb-0">Guru Mata Pelajaran</h3>
          </div>
          <div class="col text-right">
            <a href="{{ route('admin.mata_pelajaran.guru_mapel.create', $mata_pelajaran->id) }}" class="btn btn-sm btn-primary">Tambah</a>
          </div>
        </div>
      </div>
      <div class="table-responsive">
        <!-- Projects table -->
        <table class="table align-items-center table-flush">
          <thead class="thead-light">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Guru</th>
              <th scope="col">Kelas</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @if (count($guru_mata_pelajaran) === 0)
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

            @foreach ($guru_mata_pelajaran as $data_guru_mata_pelajaran)
            <tr>
                <td>{{ $loop->iteration + $skipped }}</td>
                <td>{{ $data_guru_mata_pelajaran->guru->nama }}</td>
                <td>{{ $data_guru_mata_pelajaran->kelas->nama }} - {{ $data_guru_mata_pelajaran->kelas->tingkat->nama }}</td>
                <td>
                    <a href="{{ route('admin.mata_pelajaran.guru_mapel.edit', [$data_guru_mata_pelajaran->id, $mata_pelajaran->id]) }}">
                        <button class="btn btn-warning btn-sm">Ubah</button>
                    </a>
                    <form onsubmit="deleteThis(event)" action="{{ route('admin.mata_pelajaran.guru_mapel.delete') }}" method="POST" style="display:inline-block">
                        {{ csrf_field() }} {{ method_field('DELETE') }}
                        <input type="hidden" name="mata_pelajaran_id" value="{{ $mata_pelajaran->id }}">
                        <input type="hidden" name="id" value="{{ $data_guru_mata_pelajaran->id }}">
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
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