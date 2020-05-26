<!DOCTYPE html>
<html lang="{{ (session('locale') == 'my_MM') ? 'mm' : 'en' }}">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="The Air Quality Monitoring Website for Yangon" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="YangonAQI, Air Quality Yangon, Yangon Air Pollution, Yangon AQI, Air Quality Yangon, Air Quality, Yangon, Air Pollution">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#03A9F4">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-6LZW1S4CQZ"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'G-6LZW1S4CQZ');
    </script>
    <script src="{{ asset('js/enable-push.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href={{ asset("css/styles.css") }}>
    <link rel="icon" href= {{ asset("images/favicon.png") }} type="image/png">
    <script src="{{ asset('js/nav-sticky.js') }}"></script>
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    @yield('head')
    <title>@yield('title') - YangonAQI - Air Quality Of Yangon</title>
</head>
<body>
    <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/"><img class="logo" src="{{ asset('images/logo.png') }}" alt="logo"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse nav-font" id="navbarSupportedContent">
          <ul class="navbar-nav m-auto padding-nav">
            <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
              <a class="nav-link" href="/">{{ __('layout.home') }}</a>
            </li>
            <li class="nav-item {{ Request::is('data') ? 'active' : '' }}">
                <a class="nav-link" href="/data">{{ __('layout.data') }}</a>
            </li>
            <li class="nav-item {{ Request::is('charts') ? 'active' : '' }}">
              <a class="nav-link" href="/charts">{{ __('layout.charts') }}</a>
            </li>
            <li class="nav-item {{ Request::is('maps') ? 'active' : '' }}">
                <a class="nav-link" href="/maps">{{ __('layout.maps') }}</a>
            </li>
            <li class="nav-item {{ Request::is('whatisaqi') ? 'active' : '' }}">
                <a class="nav-link" href="/whatisaqi">{{ __('layout.aqiFaq') }}</a>
            </li>
            <li class="nav-item {{ Request::is('about') ? 'active' : '' }}">
              <a class="nav-link" href="/about">{{ __('layout.about') }}</a>
            </li>

            <li class="nav-item">
              <form id="lang-switch" action="/lang" method="POST">
                @csrf
                <input type="hidden" name="locale" value="{{ (session('locale') == 'my_MM') ? 'en' : 'my_MM' }}">
              </form>
              <a class="nav-link" href="#" onclick="$('#lang-switch').submit()">{{ (session('locale') == 'my_MM') ? 'English' : 'မြန်မာ' }}</a>
            </li>
          </ul>
          <ul class="navbar-nav ml-auto padding-nav">
              <li class="nav-item">
                  <button onclick="initSW('{{ (session('locale') == 'my_MM') ? 'my_MM' : 'en' }}')" class="btn btn-primary notification">{{ __('layout.get_noti') }}</button>
              </li>
          </ul>
        </div>
      </nav>
    <div class="container-fluid">
      @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
