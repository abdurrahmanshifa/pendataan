<div class="sidebar-brand">
    <a href="{{ url('/') }}">
        <img src="{{ asset('stisla/img/logo.png') }}" alt="logo" height="30" class="shadow-light"> DINAS PERKIM
    </a>
</div>
<div class="sidebar-brand sidebar-brand-sm">
    <a href="{{ url('/') }}">
        <img src="{{ asset('stisla/img/logo.png') }}" alt="logo" height="30" class="shadow-light">
    </a>
</div>
<ul class="sidebar-menu">
    <li class="menu-header">Dashboard</li>
    <li class="nav-item {{ request()->is('dashboard*') ? 'active' : '' }}">
        <a href="{{ route('dashboard') }}" class="nav-link">
            <i class="fas fa-chart-line"></i>
            <span>Dashboard</span>
        </a>
    </li>
    @if(Auth::user()->group == 1)
    <li class="menu-header">Master</li>
    <li class="nav-item {{ request()->is('master*') ? 'active' : '' }}  dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Master Data</span></a>
        <ul class="dropdown-menu">
<<<<<<< HEAD
=======
            {{-- 
>>>>>>> 0d497187dec807cf52f64144c5c6e3b575dd1166
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
<<<<<<< HEAD
=======
            --}}
>>>>>>> 0d497187dec807cf52f64144c5c6e3b575dd1166
            <li class="{{ request()->is('master/klasifikasi*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('klasifikasi') }}">
                    Klasifikasi
                </a>
            </li>
<<<<<<< HEAD
=======
            <li class="{{ request()->is('master/satuan*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('satuan') }}">
                    Satuan
                </a>
            </li>
>>>>>>> 0d497187dec807cf52f64144c5c6e3b575dd1166
            {{-- 
            <li class="{{ request()->is('master/ruangan*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('ruangan') }}">
                    Ruangan
                </a>
            </li>
<<<<<<< HEAD
            --}}
=======
>>>>>>> 0d497187dec807cf52f64144c5c6e3b575dd1166
            <li class="{{ request()->is('master/halaman*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('halaman') }}">
                    Halaman
                </a>
            </li>
<<<<<<< HEAD
=======
            --}}
>>>>>>> 0d497187dec807cf52f64144c5c6e3b575dd1166
        </ul>
    </li>
    <li class="nav-item {{ request()->is('pengguna*') ? 'active' : '' }}">
        <a href="{{ route('pengguna') }}" class="nav-link">
            <i class="fas fa-user-plus"></i>
            <span>Pengguna</span>
        </a>
    </li>
    @endif;
    <li class="menu-header">Transaksi</li>
    <li class="nav-item {{ request()->is('survey*') ? 'active' : '' }}">
        <a href="{{ route('survey') }}" class="nav-link">
            <i class="fas fa-poll-h"></i>
            <span>Survey</span>
        </a>
    </li>
<<<<<<< HEAD
=======
    @if(Auth::user()->group == 1)
        <li class="nav-item {{ request()->is('kerusakan*') ? 'active' : '' }}">
            <a href="{{ route('kerusakan') }}" class="nav-link">
                <i class="fas fa-poll-h"></i>
                <span>Kerusakan</span>
            </a>
        </li>
    @endif;
>>>>>>> 0d497187dec807cf52f64144c5c6e3b575dd1166
</ul>