<form class="form-inline mr-auto">
     <ul class="navbar-nav mr-3">
          <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
     </ul>
</form>
<ul class="navbar-nav navbar-right">
     <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
               <img alt="image" src="{{ asset('stisla/img/avatar/avatar-1.png') }} " class="rounded-circle mr-1">
               <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->name }} </div>
          </a>
          <div class="dropdown-menu dropdown-menu-right">
               <div class="dropdown-title">
                    Terakhir Login Pada  {{ App\Helpers\DateHelper::tglIndTime(Auth::user()->last_login_at ) }}
               </div>
               <a  href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal" class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i> Keluar
               </a>
          </div>
     </li>
</ul>