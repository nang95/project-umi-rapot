@extends('layouts.app')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('admin./') }}"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.sekolah') }}">Sekolah</a></li>
@endsection

@section('content')
{{-- Alert --}}
@if(Session::has('flash_message'))
  <script type="text/javascript">
      Swal.fire("Berhasil!","{{ Session('flash_message') }}", "success");
  </script>
@endif

<div class="row">
    <div class="col-xl-8 order-xl-1">
        <div class="card">
          <div class="card-header">
            <div class="row align-items-center">
              <div class="col-8">
                <h3 class="mb-0">Sekolah </h3>
              </div>
            </div>
          </div>
          <div class="card-body">
            <form method="POST" action="{{ route('admin.sekolah.update') }}">
                @csrf @method('PUT')
                <h6 class="heading-small text-muted mb-4">Edit Sekolah</h6>
                <div class="row">
                    <input type="hidden" name="id" value="{{ $sekolah->id }}">
                    <div class="col-lg-6">
                        <div class="form-group">
                        <label class="form-control-label" for="tahun_ajaran">Tahun Ajaran</label>
                        <input type="text" id="tahun_ajaran" name="tahun_ajaran" class="form-control" placeholder="2020/2021" value="{{ $sekolah->tahun_ajaran }}">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                        <label class="form-control-label" for="semester">Semester</label>
                        <input type="text" id="semester" name="semester" class="form-control" value="{{ $sekolah->semester }}">
                        </div>
                    </div>
                </div>
                <div class="row">  
                    <div class="col-lg-12 text-right">
                        <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                    </div>
                </div>
            </form>
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