<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="javascript:void(0)">
          <img src="{{ asset('img/logo.jpeg') }}" class="navbar-brand-img" alt="...">
          <p>SMK Az-Zahra Sonomartani</p>
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" href="{{ route('guru./') }}">
                <i class="fas fa-desktop text-primary"></i>
                <span class="nav-link-text">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('guru.daftar-nilai') }}">
                <i class="fas fa-square-root-alt text-danger"></i>
                <span class="nav-link-text">Daftar Nilai</span>
              </a>
            </li>
            @php
              $guru = App\Models\Guru::where('user_id', auth()->user()->id)->first();
              $is_wali_kelas = App\Models\Guru::whereIn('id', function($query) use($guru){
                $query->select('guru_id')->from('rombels')->where('guru_id', $guru->id);
              })->first();
            @endphp

            @if ($is_wali_kelas != null)
            <li class="nav-item">
              <a class="nav-link" href="{{ route('guru.absensi') }}">
                <i class="fas fa-clipboard-list text-pink"></i>
                <span class="nav-link-text">Absensi</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('guru.rekap-absensi') }}">
                <i class="fas fa-print text-yellow"></i>
                <span class="nav-link-text">Rekap Absensi</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('guru.rapor') }}">
                <i class="fas fa-file-invoice text-info"></i>
                <span class="nav-link-text">Rapor</span>
              </a>
            </li>
            @endif
          </ul>
        </div>
      </div>
    </div>
  </nav>