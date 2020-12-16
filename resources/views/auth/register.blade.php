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
    <link href="/css/register.css" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@200;300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Andika+New+Basic:wght@400;700&family=Raleway:wght@100;400;500;600&display=swap" rel="stylesheet">

  </head>

  <body>
    <div class="container" id="register_container">
        <div class="row">
            <div id="registerSvg">
                <img src="{{ asset('\dist\img\register.svg') }}" alt="" id="register_svg_img">
            </div>
            <div class="col-sm-12 col-xl-6 mt-3" id="register_input">
                <div class="card">
                    <div class="card-header">
                        <h1>{{ __('Kayıt') }}</h1>
                        <p>{{ __('Kolay randevu ve tedavi takip uygulamamızdan faydalanabilmek için lütfen kaydolun.') }}</p>
                    </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Kullanıcı Adınız') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Adresiniz') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="instrumentalInFind" class="col-md-4 col-form-label text-md-right">{{ __('Kliniğimizi nasıl keşfettiniz?') }}</label>

                                    <div class="col-md-6">
                                        <select id="instrumentalInFind" name="instrumentalInFind" class="form-control @error('instrumentalInFind') is-invalid @enderror" required>
                                            <option selected="true" value="directive" class="disabled" disabled="disabled">Seçilmedi</option>
                                            <option value="web_search">Web Araması</option>
                                            <option value="advice">Tavsiye</option>
                                            <option value="location">Komşu (Yer Yakınlığı)</option>
                                            <option value="social_media">Sosyal Medya</option>
                                        </select>

                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ "Lütfen kliniğimizi nasıl keşfettiğinize dair seçeneklerden birini seçiniz." }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Şifreniz') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Şifrenizi Tekrar Giriniz') }}</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-12 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Kayıt Ol') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </div>    
  </body>
</html>
