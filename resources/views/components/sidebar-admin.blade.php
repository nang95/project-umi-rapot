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
              <a class="nav-link active" href="{{ route('admin./') }}">
                <i class="fas fa-desktop text-primary"></i>
                <span class="nav-link-text">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.sekolah') }}">
                <i class="fas fa-hotel text-orange"></i>
                <span class="nav-link-text">Sekolah</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.jabatan') }}">
                <i class="fas fa-layer-group text-success"></i>
                <span class="nav-link-text">Jabatan</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.guru') }}">
                <i class="fas fa-user text-primary"></i>
                <span class="nav-link-text">Guru</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.siswa') }}">
                <i class="fas fa-users text-yellow"></i>
                <span class="nav-link-text">Siswa</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.tingkat') }}">
                <i class="fas fa-level-up-alt text-default"></i>
                <span class="nav-link-text">Tingkat</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.kelas') }}">
                <i class="fas fa-chalkboard text-cyan"></i>
                <span class="nav-link-text">Kelas</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.mata_pelajaran') }}">
                <i class="ni ni-bullet-list-67 text-default"></i>
                <span class="nav-link-text">Mata Pelajaran</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.rombel') }}">
                <i class="ni ni-key-25 text-info"></i>
                <span class="nav-link-text">Rombel</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>