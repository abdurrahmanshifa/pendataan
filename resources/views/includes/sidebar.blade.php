<div class="sidebar-brand">
    <a href="{{ url('/') }}">DINAS PERKIM</a>
</div>
<div class="sidebar-brand sidebar-brand-sm">
    <a href="{{ url('/') }}"> <span class="fas fa-house-damage"></span> </a>
</div>
<ul class="sidebar-menu">
    <li class="menu-header">Dashboard</li>
    <li class="nav-item {{ request()->is('dashboard*') ? 'active' : '' }}">
        <a href="{{ route('dashboard') }}" class="nav-link">
            <i class="fas fa-chart-line"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="menu-header">Master</li>
    <li class="nav-item {{ request()->is('master*') ? 'active' : '' }}  dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Master Data</span></a>
        <ul class="dropdown-menu">
            <li class="{{ request()->is('master/kecamatan*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('kecamatan') }}">
                    Kecamatan
                </a>
            </li>
            <li class="{{ request()->is('master/kelurahan*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('kelurahan') }}">
                    Kelurahan
                </a>
            </li>
            <li class="{{ request()->is('master/ruangan*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('ruangan') }}">
                    Ruangan
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item {{ request()->is('pengguna*') ? 'active' : '' }}">
        <a href="{{ route('pengguna') }}" class="nav-link">
            <i class="fas fa-user-plus"></i>
            <span>Pengguna</span>
        </a>
    </li>
</ul>