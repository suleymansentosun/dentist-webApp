<!doctype html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="/css/main.css" rel="stylesheet" type="text/css">
    <link href="/css/bookings.css" rel="stylesheet" type="text/css">
    <link href="/css/modalStyle.css" rel="stylesheet" type="text/css">
    <link href="/css/bookingCreate.css" rel="stylesheet" type="text/css">
    <link href="/css/doctorCreate.css" rel="stylesheet" type="text/css">
    <link href="/css/jquery.datetimepicker.min.css" rel="stylesheet">
    <link href="/css/calendar.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@200;300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Andika+New+Basic:wght@400;700&family=Raleway:wght@100;400;500;600&display=swap" rel="stylesheet">

  </head>

  <body>
    <header>
      <nav class="navbar navbar-expand-md navbar-light" id="navbar">
        <div class="navbar-top">
          <ul class="contact-information">
             <li id="location_list_item">
               <a href="#">
               <img src="{{ asset('\dist\img\location.svg') }}" alt="" style="width:18px; height:auto; margin-right:5px;">
               <span class="contact_info" id="location_btn">Ürgüp/Nevşehir</span>
               </a>
             </li>
             <li>
               <a href="tel:+2163057759" class="call-button">
               <img src="{{ asset('\dist\img\telephone.svg') }}" alt="" style="width:20px; height:auto; margin-right:7px;">
                 <span class="contact_info" id="call_btn">Bizi Arayın! (216 305-7759)</span>
               </a>
             </li>
          </ul>
        </div>
        <div class="navbar-bottom">
          <a class="navbar-brand" href="{{ url('/') }}">
              <img src="{{ asset('\dist\img\logo.svg') }}" alt="DentCappadocia" style="width:85px; height:auto; margin-left:20px;">
              <span class="logo_text">Dent Cappadocia</span>
          </a>
          <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ml-auto" id="main_menu_center">
              <!-- Authentication Links -->
              <li class="nav-item">
                  <a class="nav-link" href="#">{{ __('Hakkımızda') }}</a>
              </li>
              <li class="nav-item">
                  <div class="dropdown">
                    <a class="nav-link dropdown-toggle" role="button" id="dropdownMenuLink" 
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">{{ __('Tedaviler') }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                      <a class="dropdown-item" href="#">Diş Ağrısı</a>
                      <a class="dropdown-item" href="#">Diş Estetiği</a>
                      <a class="dropdown-item" href="#">Diş Bakımı</a>
                      <a class="dropdown-item" href="#">Eksik Diş</a>
                    </div>
                  </div>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="#">{{ __('Blog Yazılarımız') }}</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="#">{{ __('Sizden Gelenler') }}</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="#">{{ __('Randevu Ayarla') }}</a>
              </li>
          </div>
              @if (Route::has('login'))
                @guest
                    <div class="account-menu-items">
                      <ul class="account-menu-list">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Giriş') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Kayıt') }}</a>
                            </li>
                        @endif                    
                      </ul>
                    </div>
                @else
                    <div class="account-menu-items">
                      <ul class="account-menu-list">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Hesaptan Çık') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                        @if (Auth::user()->hasRole('Admin'))
                          <li class="nav-item">
                            <a class="nav-link" href="{{ action('Admin\ShowDashboard') }}">Kontrol Paneli</a>
                          </li>
                        @elseif (Auth::user()->hasRole('Doctor'))
                          <li class="nav-item">
                              <a class="nav-link" href="{{ action('Doctor\DoctorDashboardController@showDashboard') }}">Kontrol Paneli</a>
                          </li>
                        @elseif (Auth::user()->hasRole('Employee'))
                          <li class="nav-item">
                              <a class="nav-link" href="{{ action('Employee\EmployeeDashboardController@showDashboard') }}">Kontrol Paneli</a>
                          </li>
                        @elseif (Auth::user()->hasRole('Patient'))
                          <li class="nav-item">
                              <a class="nav-link" href="{{ action('Patient\PatientDashboardController@showDashboard') }}">Kontrol Paneli</a>
                          </li>
                      </ul>
                    </div>
                    @else                      
                    @endif
                @endguest
              @endif
            </ul>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          </div>
      </div>
      </nav>
    </header>

    <main role="main">
        @yield('bg_image')
        <div class="container">
            <div class="row">
                <!-- Buttons -->
                @yield('buttons')
            </div>
        </div>
        <div class="container mt-5">
            <div class="row">
                <!-- Content -->
                @yield('content')
            </div>
        </div>
        <div class="container">
          <div class="row">
            <div class="col text-center">
              @section('create_booking_btn')
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#firstStageBooking" 
                id="create_booking_btn">Randevu Ayarla</button>
              @show
            </div>
          </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="firstStageBooking" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-xl" id="x" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                  <img style="width:200px; height:auto;" src="{{ asset('./dist/img/secratary.svg') }}"></img>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body container" id="firstStageBookingBody">
                  <div class="row" id="modal_instructor">
                      <div class="col"><strong>Randevu nedeninizi belirterek ilgili doktorları ve müsait oldukları saatleri inceleyin, uygun bir saat seçerek randevu oluşturun.</strong></div>
                  </div>
                  <div class="row" id="container_selectBookingReason">
                      <select class="custom-select mt-2" id="select_bookingReasons_form">

                      </select>
                  </div>    
                  <div class="row">
                      <div class="col-md-12 col-lg-6" id="relatedDoctorInfos">
                          <ul class="list-group" id="doctorList">
                            
                          </ul>                       
                      </div>
                      <div class="mt-2 col-lg-12 col-xl-6" id="datePicker">

                      </div>
                  </div>      
              </div>
          </div>
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="container">
      <ul id="social_media_icon_container">
        <li>
          <a href="">
          <img src="{{ asset('/dist/img/facebook.svg') }}" class="social-media-icon" alt="">
          </a>
        </li>
        <li>
          <a href="">
          <img src="{{ asset('/dist/img/twitter.svg') }}" class="social-media-icon" alt="">
          </a>
        </li>
        <li>
          <a href="">
          <img src="{{ asset('/dist/img/instagram.svg') }}" class="social-media-icon" alt="">
          </a>
        </li>
      </ul>
      <p class="float-right"><a href="#">Başa Dön</a></p>
      <p>&copy; Copyright © 2020 Dent Cappadocia Ağız ve Diş Sağlığı Polikliniği. Tüm Hakları Saklıdır. &middot; <a href="#">Gizlilik</a> &middot; <a href="#">Şartlar</a></p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/5f7aedad57.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="https://getbootstrap.com/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/script>')</script><script src="https://getbootstrap.com/docs/4.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
    <script src="/js/jquery.datetimepicker.full.min.js"></script>
    <script>
      $('#picker').datetimepicker({
        timepicker: true,
        datepicker: true,
        format: 'Y-m-d H:i:s',
        lang: 'tr'
      });

      $('#toggle').on('click', function() {
        $('#picker').datetimepicker('toggle');
      });
    </script>
    <!-- Scripts -->
    <script>
        var urlSvg = '{{ asset('./dist/img/dentistAndPatientInBooking.svg') }}';
        var urlStorageFile = '{{ asset('storage/') . '/' }}';
    </script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="/js/app.js"></script>
    <script src="/js/calendar.js"></script>
    @section('scripts')
      <script src="/js/firstStageOfBooking.js"></script>
    @show    
  </body>
</html>