@extends('layouts.app')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('admin./') }}"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.rombel') }}">Rombel</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.rombel.siswa-rombel', $rombel->id) }}">Siswa Rombel</a></li>
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
      <div class="card-body">
        <div class="row">
          <div class="col-md-2"><b>Wali Kelas</b></div>
          <div class="col-md-4"><b>: {{ $rombel->guru->nama }}</b></div>
        </div>
        <div class="row">
          <div class="col-md-2"><b>Kelas</b></div>
          <div class="col-md-4"><b>: {{ $rombel->kelas->nama }}</b></div>
        </div>
        <div class="row mt-2">
          <div class="col-md-2">
            <a href="{{ route('admin.rombel') }}">
              <button class="btn btn-info btn-sm">Kembali</button>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-6">
    <div class="card">
      <div class="card-header border-0">
        <div class="row align-items-center">
          <div class="col">
            <h3 class="mb-0">Siswa</h3>
          </div>
          <div class="col text-right">
            <form action="{{ route('admin.rombel.siswa-rombel.save-all') }}" method="POST" style="display: inline-block">
              {{ csrf_field() }} {{ method_field('POST') }}
              <input type="hidden" name="rombel_id" value="{{ $rombel->id }}">
              <input type="hidden" name="siswa_id" id="siswa_id" value="">
              <button class="btn btn-sm btn-success">Masukkan Ke Rombel</button>
            </form>
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
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @if (count($siswa) === 0)
            <tr>
                <td colspan="8" style="text-align:center">
                    @if ($q_nama_siswa == "")
                        <span>Data Kosong</span>
                    @else
                        <span>Kriteria yang anda cari tidak sesuai</span>
                    @endif
                </td>
            </tr>
            @endif

            @foreach ($siswa as $data_siswa)
            <tr>
                <td>
                  <div class="form-check">
                    <input class="form-check-input siswa" type="checkbox" data-siswa="{{ $data_siswa->id }}">
                    <label class="form-check-label" for="flexCheckDefault"></label>
                  </div>  
                </td>
                <td>{{ $data_siswa->nisn }}</td>
                <td>{{ $data_siswa->nama }}</td>
                <td>
                    <form action="{{ route('admin.rombel.siswa-rombel.store') }}" method="POST" style="display:inline-block">
                        {{ csrf_field() }} {{ method_field('POST') }}
                        <input type="hidden" name="rombel_id" value="{{ $rombel->id }}">
                        <input type="hidden" name="siswa_id" value="{{ $data_siswa->id }}">
                        <button class="btn btn-success btn-sm">Masukkan</button>
                    </form>
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="card-footer">
        {{ $siswa->appends(['q_nama_siswa' => $q_nama_siswa])->links() }}
      </div>
    </div>
  </div>
  <div class="col-xl-6">
    <div class="card">
      <div class="card-header border-0">
        <div class="row align-items-center">
          <div class="col">
            <h3 class="mb-0">Siswa Rombel</h3>
          </div>
          <div class="col text-right">
            <form action="{{ route('admin.rombel.siswa-rombel.delete-all') }}" id="approveDeleteForm" method="POST" style="display: inline-block">
              {{ csrf_field() }} {{ method_field('POST') }}
              <input type="hidden" name="rombel_id" value="{{ $rombel->id }}">
              <input type="hidden" name="siswa_id" id="siswa_kelas_id" value="">
              <button class="btn btn-sm btn-danger">Keluarkan Dari Rombel</button>
            </form>
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
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @if (count($siswa_rombel) === 0)
            <tr>
                <td colspan="8" style="text-align:center">
                    @if ($q_nama_siswa_rombel == "")
                        <span>Data Kosong</span>
                    @else
                        <span>Kriteria yang anda cari tidak sesuai</span>
                    @endif
                </td>
            </tr>
            @endif

            @foreach ($siswa_rombel as $data_siswa_rombel)
            <tr>
                <td>
                  <div class="form-check">
                    <input class="form-check-input siswa-kelas" type="checkbox" data-siswakelas="{{ $data_siswa_rombel->siswa_id }}">
                    <label class="form-check-label" for="flexCheckDefault"></label>
                  </div>  
                </td>
                <td>{{ $data_siswa_rombel->siswa->nisn }}</td>
                <td>{{ $data_siswa_rombel->siswa->nama }}</td>
                <td>
                    <form onsubmit="deleteThis(event)" action="{{ route('admin.rombel.siswa-rombel.delete') }}" method="POST" style="display:inline-block">
                      {{ csrf_field() }} {{ method_field('DELETE') }}
                      <input type="hidden" name="id" value="{{ $data_siswa_rombel->id }}">
                      <button class="btn btn-danger btn-sm">Keluarkan</button>
                    </form>
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="card-footer">
        {{ $siswa_rombel->appends(['q_nama_siswa_rombel' => $q_nama_siswa_rombel])->links() }}
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

<script>
  $(document).ready(function(){
      // insert
      $('.siswa').click(function(){
          if($(this).prop("checked") == true){
              const id = $(this).data('siswa')
              let oldValue = $('#siswa_id').val();
              if(oldValue === ""){
                  $('#siswa_id').val(oldValue + id);    
              }else{
                  $('#siswa_id').val(oldValue + ';' + id);
              }
          }

          if($(this).prop("checked") == false){
              let str = $('#siswa_id').val();
              let oldValues = str.split(';')
              let id = $(this).data('siswa');
              
              let filter = oldValues.filter(function(oldValue){
                  return oldValue === id.toString()
              });

              // hapus data                
              let removeData = str.split(filter)

              $('#siswa_id').val(removeData.join(''))
          }
      })
  });

  $(document).ready(function(){
      // insert
      $('.siswa-kelas').click(function(){
          if($(this).prop("checked") == true){
              const id = $(this).data('siswakelas');
              let oldValue = $('#siswa_kelas_id').val();
              if(oldValue === ""){
                  $('#siswa_kelas_id').val(oldValue + id);    
              }else{
                  $('#siswa_kelas_id').val(oldValue + ';' + id);
              }
          }

          if($(this).prop("checked") == false){
              let str = $('#siswa_kelas_id').val();
              let oldValues = str.split(';')
              let id = $(this).data('siswakelas');
              
              let filter = oldValues.filter(function(oldValue){
                  return oldValue === id.toString()
              });

              // hapus data                
              let removeData = str.split(filter)

              $('#siswa_kelas_id').val(removeData.join(''))
          }
      })
  });

</script>
@endsection