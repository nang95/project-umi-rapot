<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="javascript:void(0)">
          <img src="{{ asset('img/logo.jpeg') }}" class="navbar-brand-img" alt="...">
          <p>SMK Az-Zahra</p>
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" href="{{ route('siswa./') }}">
                <i class="fas fa-desktop text-primary"></i>
                <span class="nav-link-text">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('siswa.daftar-nilai') }}">
                <i class="fas fa-square-root-alt text-danger"></i>
                <span class="nav-link-text">Daftar Nilai</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>