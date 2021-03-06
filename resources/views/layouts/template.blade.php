<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
     @yield('title')
     <link rel="shortcut icon" type="image/png" href="{{ asset('stisla/img/logo.png') }}">
     @include('includes.css')
     @yield('style')
     <style>
          .select2 {
               width:100% !important;
          }
          .help, .help-text{
               color:#fc544b;
               font-weight: 600;
               font-size: 11px;
               letter-spacing: .5px;
          }
     </style>
</head>

<body>
     <div id="app">
          <div class="main-wrapper">
               <div class="navbar-bg"></div>
               <nav class="navbar navbar-expand-lg main-navbar">
                    @include('includes.navbar')
               </nav>
               <div class="main-sidebar">
                    <aside id="sidebar-wrapper">
                         @include('includes.sidebar')
                    </aside>
               </div>
               <!-- Main Content -->
               <div class="main-content">
                    @yield('content')
               </div>
               @include('includes.footer')
          </div>
     </div>
     <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
          <div class="modal-dialog" role="document">
               <div class="modal-content">
                    <div class="modal-header">
                         <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                         </button>
                    </div>
                    <div class="modal-body">
                         <p>Apakah anda ingin keluar dari aplikasi?</p>
                    </div>
                    <div class="modal-footer">
                         <a href="{{ route('logout') }}" class="btn btn-primary" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Ya</a>
                         <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Batal</button>
                         <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                              @csrf
                         </form>
                    </div>
               </div>
          </div>
     </div>
     @yield('modal')
     @include('includes.javascript')
     
     <!-- JS Libraies -->
     @yield('script')
     <!-- Template JS File -->
</body>

</html>