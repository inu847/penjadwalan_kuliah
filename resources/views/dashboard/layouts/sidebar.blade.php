<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center my-5" href="index.html">
        <img src="/img/logoFTI.png" class="logo-fti" alt="">
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="/">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dosen.index') }}">
            <i class="fas fa-users"></i>
            <span>Dosen</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('matkul.index') }}">
            <i class="fas fa-clipboard-list"></i>
            <span>Mata Kuliah</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('ruang.index') }}">
            <i class="fas fa-home"></i>
            <span>Ruang</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('kelas.index') }}">
            <i class="fas fa-building"></i>
            <span>Kelas</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('pengampu.index') }}">
            <i class="fas fa-chalkboard-teacher"></i>
            <span>Pengampu</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('jam.index') }}">
            <i class="fas fa-clock"></i>
            <span>Jam</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('hari.index') }}">
            <i class="fas fa-calendar-day"></i>
            <span>Hari</span></a>
    </li>

    {{-- <li class="nav-item">
        <a class="nav-link" href="{{ route('waktu_khusus.index') }}">
            <i class="fas fa-calendar-week"></i>
            <span>Waktu Khusus</span></a>
    </li> --}}

    <li class="nav-item">
        <a class="nav-link" href="{{ route('penjadwalan.index') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Penjadwalan</span></a>
    </li>

    <li class="nav-item">
        <a href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();" class="nav-link">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </li>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
      @csrf
    </form>
</ul>
