<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
     <title>LOGIN | DINAS PERKIM KOTA TANGERANG</title>

     <!-- General CSS Files -->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
     <!-- Template CSS -->
     <link rel="shortcut icon" type="image/png" href="{{ asset('stisla/img/logo.png') }}">
     <link rel="stylesheet" href="{{ asset('stisla/vendor/select2/dist/css/select2.css')}}">
     <link rel="stylesheet" href="{{ asset('stisla/css/style.css')}}">
     <link rel="stylesheet" href="{{ asset('stisla/css/components.css')}}">
     <link rel="stylesheet" href="{{ asset('stisla/vendor/sweetalert2/sweetalert2.css')}}">
</head>

<body>
     <div id="app">
          <section class="section">
               <div class="d-flex flex-wrap align-items-stretch">
                    <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
                         <div class="p-4 m-3">
                              <img src="{{ asset('stisla/img/logo.png') }}" alt="logo" width="80" class="shadow-light rounded-circle mb-5 mt-2">
                              <h4 class="text-dark font-weight-normal">
                                   <span class="font-weight-bold">
                                   Pendataan Bangunan Gedung
                                   </span>
                              </h4>
                              <p class="text-muted">
                                DINAS PERKIM KOTA TANGERANG
                              </p>
                              <form method="POST" action="{{ route('login') }}">
                                @csrf
                                   <div class="form-group">
                                        <label for="email">Email</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                   </div>

                                   <div class="form-group">
                                        <div class="d-block">
                                             <label for="password" class="control-label">Password</label>
                                        </div>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                   </div>

                                   <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                             <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                                             <input class="custom-control-input" type="checkbox" name="remember" tabindex="3" id="remember-me" {{ old('remember') ? 'checked' : '' }}>
                                             <label class="custom-control-label" for="remember-me">Ingatkan saya</label>
                                        </div>
                                   </div>

                                   <div class="form-group text-right">
                                        <button type="submit" class="btn btn-warning btn-lg btn-icon icon-right" tabindex="4">
                                             Login
                                        </button>
                                   </div>
                              </form>
                         </div>
                    </div>
                    <div class="col-lg-8 col-12 order-lg-2 order-1 min-vh-100 background-walk-y position-relative overlay-gradient-bottom" data-background="{{ asset('stisla/img/unsplash/login-bg.png') }}">
                         <div class="absolute-bottom-left index-2">
                              <div class="text-light p-5 pb-2">
                                   <div class="mb-5 pb-3">
                                        <h1 class="mb-2 display-4 font-weight-bold">Pusat Pemerintahan Kota Tangerang</h1>
                                        <h5 class="font-weight-normal text-muted-transparent">Sukaasih, Kec. Tangerang, Kota Tangerang</h5>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </section>
     </div>
     
     <!-- General JS Scripts -->
     <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
     <script src="{{ asset('stisla/js/stisla.js') }}"></script>

     <!-- JS Libraies -->

     <!-- Template JS File -->
     <script src="{{ asset('stisla/vendor/sweetalert2/sweetalert2.min.js') }}"></script>
     <script src="{{ asset('stisla/vendor/select2/dist/js/select2.js') }}"></script>
     <script src="{{ asset('stisla/js/scripts.js') }}"></script>
     <script src="{{ asset('stisla/js/custom.js') }}"></script>

     <!-- Page Specific JS File -->
</body>

</html>