@extends('layouts.app')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('guru./') }}"><i class="fas fa-home"></i></a></li>
<li class="breadcrumb-item"><a href="{{ route('guru.daftar-nilai') }}">Daftar Nilai</a></li>
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
            <form method="GET" action="{{ route('guru.daftar-nilai') }}">
                <h6 class="heading-small text-muted mb-4">Daftar Nilai</h6>
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
                            <label class="form-control-label" for="q_mapel">Mata Pelajaran</label>
                            <select name="q_mapel" id="q_mapel" class="form-control" required>
                                <option value="">-Silahkan Pilih-</option>
                                @foreach ($mata_pelajaran as $item)
                                <option value="{{ $item->id }}"
                                    @if ($item->id == $q_mapel)
                                    selected
                                    @endif>{{ $item->nama }}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="q_jenis_ujian">Jenis Ujian</label>
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
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="q_periode">Periode</label>
                            <input type="number" id="q_periode" name="q_periode" class="form-control" value="{{ $q_periode }}" required>
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

<form action="{{ route('guru.daftar-nilai.save-all') }}" method="POST">
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
                        <th scope="col">NISN</th>
                        <th scope="col">Siswa</th>
                        <th scope="col">Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($q_mapel) && !empty($q_kelas))
                            @if (count($daftar_nilai) === 0)
                            <tr>
                                <td colspan="8" style="text-align:center">
                                    @if ($q_kelas == "" || $q_mapel == "")
                                        <span>Data Kosong</span>
                                    @else
                                        <span>Kriteria yang anda cari tidak sesuai</span>
                                    @endif
                                </td>
                            </tr>
                            @endif

                            @foreach ($daftar_nilai as $data_daftar_nilai)
                            <input type="hidden" name="ids[]" value="{{ $data_daftar_nilai->id }}">
                            <input type="hidden" name="siswa_ids[]" value="{{ $data_daftar_nilai->siswa_id }}">
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data_daftar_nilai->siswa->nisn }}</td>
                                <td>{{ $data_daftar_nilai->siswa->nama }}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <input type="text" id="nilai" name="nilai[]" class="form-control form-control-sm" value="{{ $data_daftar_nilai->nilai }}">
                                            </div>
                                        </div>
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
</form>
 
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