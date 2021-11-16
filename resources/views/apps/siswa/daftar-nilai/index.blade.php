@extends('layouts.app')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('siswa./') }}"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item"><a href="{{ route('siswa.daftar-nilai') }}">Daftar Nilai</a></li>
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
                <h3 class="mb-0">Daftar Nilai</h3>
              </div>
            </div>
          </div>
          <div class="card-body">
            <form method="GET" action="{{ route('siswa.daftar-nilai') }}">
                <h6 class="heading-small text-muted mb-4">Daftar Nilai</h6>
                 
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label" for="q_jenis_ujian">Jenis Penilaian</label>
                            <select name="q_jenis_ujian" id="q_jenis_ujian" class="form-control" required>
                                <option value="">-Silahkan Pilih-</option>
                                <option value="Tugas"
                                @if ($q_jenis_ujian == "Tugas")
                                    selected
                                @endif>Tugas</option>
                                <option value="UH"
                                @if ($q_jenis_ujian == "UH")
                                    selected
                                @endif>UH</option>
                                <option value="UTS"
                                @if ($q_jenis_ujian == "UTS")
                                    selected
                                @endif>UTS</option>
                                <option value="UAS"
                                @if ($q_jenis_ujian == "UAS")
                                    selected
                                @endif>UAS</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label" for="q_tahun_ajaran">Tahun Ajaran</label>
                            <select name="q_tahun_ajaran" id="q_tahun_ajaran" class="form-control" required>
                                <option value="">-Silahkan Pilih-</option>
                                @foreach ($tahun_ajaran as $item)
                                <option value="{{ $item->tahun_ajaran }}"
                                    @if ($item->tahun_ajaran == $q_tahun_ajaran)
                                        selected
                                    @endif>{{ $item->tahun_ajaran }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label" for="q_semester">Semester</label>
                            <select name="q_semester" id="q_semester" class="form-control" required>
                                <option value="">-Silahkan Pilih-</option>
                                <option value="Ganjil"
                                    @if ($q_semester == "Ganjil")
                                        selected
                                    @endif>Genap</option>
                                <option value="Genap"
                                    @if ($q_semester == "Genap")
                                        selected
                                    @endif>Genap</option>
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
        @csrf @method('POST')
        <div class="card">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">Daftar Nilai</h3>
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
                    <th scope="col">Mata Pelajaran</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($q_tahun_ajaran) && !empty($q_semester))
                        @if (count($daftar_nilai) === 0)
                        <tr>
                            <td colspan="8" style="text-align:center">
                                @if ($q_semester == "" || $q_tahun_ajaran == "")
                                    <span>Data Kosong</span>
                                @else
                                    <span>Kriteria yang anda cari tidak sesuai</span>
                                @endif
                            </td>
                        </tr>
                        @endif

                        @foreach ($daftar_nilai as $data_daftar_nilai)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data_daftar_nilai->guruMataPelajaran->mataPelajaran->nama }}</td>
                            <td>{{ $data_daftar_nilai->jenis_ujian }} - {{ $data_daftar_nilai->periode }}</td>
                            <td>{{ $data_daftar_nilai->nilai }}</td>
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