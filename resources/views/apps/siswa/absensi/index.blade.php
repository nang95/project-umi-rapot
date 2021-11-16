@extends('layouts.app')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('guru./') }}"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item"><a href="{{ route('guru.absensi') }}">Absensi</a></li>
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
                <h3 class="mb-0">Absensi</h3>
              </div>
            </div>
          </div>
          <div class="card-body">
            <form method="GET" action="{{ route('guru.absensi') }}">
                <h6 class="heading-small text-muted mb-4">Absens</h6>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                        <label class="form-control-label" for="q_kelas">Kelas</label>
                        <select name="q_kelas" id="q_kelas" class="form-control">
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
                        <label class="form-control-label" for="q_nama">Nama</label>
                        <input type="text" id="q_nama" name="q_nama" class="form-control" value="{{ $q_nama }}">
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
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">Absensi</h3>
                    </div>
                    <div class="col text-right">
                        <form action="{{ route('guru.absensi.save-all') }}" method="POST" style="display: inline-block">
                        {{ csrf_field() }} {{ method_field('POST') }}
                        <input type="hidden" name="hadir" id="hadir-collect" value="">
                        <input type="hidden" name="sakit" id="sakit-collect" value="">
                        <input type="hidden" name="izin" id="izin-collect" value="">
                        <input type="hidden" name="alpha" id="alpha-collect" value="">
                        <button class="btn btn-sm btn-success">Simpan</button>
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
                        <th scope="col">Hadir</th>
                        <th scope="col">Sakit</th>
                        <th scope="col">Izin</th>
                        <th scope="col">Alpha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($q_kelas != null)
                            @if (count($absensi) === 0)
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

                            @foreach ($absensi as $data_absensi)
                            <tr>
                                <td>{{ $loop->iteration + $skipped }}</td>
                                <td>{{ $data_absensi->siswa->nisn }}</td>
                                <td>{{ $data_absensi->siswa->nama }}</td>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input hadir" 
                                            type="checkbox" 
                                            data-absensi="{{ $data_absensi->siswa_id }}"
                                            @if ($data_absensi->status == 'H')
                                                checked
                                            @endif>
                                        <label class="form-check-label" for="flexCheckDefault"></label>
                                    </div>  
                                </td>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input sakit" 
                                            type="checkbox" 
                                            data-absensi="{{ $data_absensi->siswa_id }}"
                                            @if ($data_absensi->status == 'S')
                                                checked
                                            @endif>
                                        <label class="form-check-label" for="flexCheckDefault"></label>
                                    </div>  
                                </td>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input izin" 
                                            type="checkbox" 
                                            data-absensi="{{ $data_absensi->siswa_id }}"
                                            @if ($data_absensi->status == 'I')
                                                checked
                                            @endif>
                                        <label class="form-check-label" for="flexCheckDefault"></label>
                                    </div>  
                                </td>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input alpha" 
                                            type="checkbox" 
                                            data-absensi="{{ $data_absensi->siswa_id }}"
                                            @if ($data_absensi->status == 'A')
                                                checked
                                            @endif>
                                        <label class="form-check-label" for="flexCheckDefault"></label>
                                    </div>  
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

<script>
    $(document).ready(function(){
        // insert
        $('.hadir').click(function(){
            if($(this).prop("checked") == true){
                const id = $(this).data('absensi');
                let oldValue = $('#hadir-collect').val();
                if(oldValue === ""){
                    $('#hadir-collect').val(oldValue + id);    
                }else{
                    $('#hadir-collect').val(oldValue + ';' + id);
                }
            }

            if($(this).prop("checked") == false){
                let str = $('#hadir-collect').val();
                let oldValues = str.split(';')
                let id = $(this).data('absensi');
                
                let filter = oldValues.filter(function(oldValue){
                    return oldValue === id.toString()
                });

                // hapus data                
                let removeData = str.split(filter)

                $('#hadir-collect').val(removeData.join(''))
            }
        })
    });

    $(document).ready(function(){
        // insert
        $('.izin').click(function(){
            if($(this).prop("checked") == true){
                const id = $(this).data('absensi');
                let oldValue = $('#izin-collect').val();
                if(oldValue === ""){
                    $('#izin-collect').val(oldValue + id);    
                }else{
                    $('#izin-collect').val(oldValue + ';' + id);
                }
            }

            if($(this).prop("checked") == false){
                let str = $('#izin-collect').val();
                let oldValues = str.split(';')
                let id = $(this).data('absensi');
                
                let filter = oldValues.filter(function(oldValue){
                    return oldValue === id.toString()
                });

                // hapus data                
                let removeData = str.split(filter)

                $('#izin-collect').val(removeData.join(''))
            }
        })
    });

    $(document).ready(function(){
        // insert
        $('.sakit').click(function(){
            if($(this).prop("checked") == true){
                const id = $(this).data('absensi');
                let oldValue = $('#sakit-collect').val();
                if(oldValue === ""){
                    $('#sakit-collect').val(oldValue + id);    
                }else{
                    $('#sakit-collect').val(oldValue + ';' + id);
                }
            }

            if($(this).prop("checked") == false){
                let str = $('#sakit-collect').val();
                let oldValues = str.split(';')
                let id = $(this).data('absensi');
                
                let filter = oldValues.filter(function(oldValue){
                    return oldValue === id.toString()
                });

                // hapus data                
                let removeData = str.split(filter)

                $('#sakit-collect').val(removeData.join(''))
            }
        })
    });

    $(document).ready(function(){
        // insert
        $('.alpha').click(function(){
            if($(this).prop("checked") == true){
                const id = $(this).data('absensi');
                let oldValue = $('#alpha-collect').val();
                if(oldValue === ""){
                    $('#alpha-collect').val(oldValue + id);    
                }else{
                    $('#alpha-collect').val(oldValue + ';' + id);
                }
            }

            if($(this).prop("checked") == false){
                let str = $('#alpha-collect').val();
                let oldValues = str.split(';')
                let id = $(this).data('absensi');
                
                let filter = oldValues.filter(function(oldValue){
                    return oldValue === id.toString()
                });

                // hapus data                
                let removeData = str.split(filter)

                $('#alpha-collect').val(removeData.join(''))
            }
        })
    });

</script>
@endsection