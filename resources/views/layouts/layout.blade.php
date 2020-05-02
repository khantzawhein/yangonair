<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('js/enable-push.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href={{ asset("css/styles.css") }}>
    <link rel="stylesheet" href={{ asset("css/responsive.css") }}>
    <link rel="icon" href="images/favicon.png" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    @yield('head')
    <title>@yield('title') - YangonAQI - Air Quality Of Yangon</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/"><img class="logo" src="images/logo.png" alt="logo"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse nav-font" id="navbarSupportedContent">
          <ul class="navbar-nav m-auto padding-nav">
            <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
              <a class="nav-link" href="/">Home</a>
            </li>
            <li class="nav-item {{ Request::is('data') ? 'active' : '' }}">
                <a class="nav-link" href="/data">Sensor Data</a>
            </li>
            <li class="nav-item {{ Request::is('charts') ? 'active' : '' }}">
              <a class="nav-link" href="/charts">Charts</a>
            </li>
            <li class="nav-item {{ Request::is('maps') ? 'active' : '' }}">
                <a class="nav-link" href="/maps">Maps</a>
            </li>
            <li class="nav-item {{ Request::is('whatisaqi') ? 'active' : '' }}">
                <a class="nav-link" href="/whatisaqi">What is AQI?</a>
            </li>
            <li class="nav-item {{ Request::is('about') ? 'active' : '' }}">
              <a class="nav-link" href="/about">About</a>
            </li>
            
          </ul>
          <ul class="navbar-nav ml-auto padding-nav">
            <li class="nav-item"><button onclick="initSW()" class="btn btn-primary notification">Get Notifcation</button></li>
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