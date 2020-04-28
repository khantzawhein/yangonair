@extends('layouts.layout')
@section('title', 'Home')
@section('head')
<link href="https://fonts.googleapis.com/css2?family=Padauk&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/index.styles.css">
<link rel="stylesheet" href="css/index.responsive.css">
@endsection
@section('content')
<div class="row justify-content-md-center aqi-main">
    <div class="col-sm-12 ">
        <h1>Realtime Yangon air quality: </h1>
        <div class="box" style="background-color: {{ $colorcode }};  {{ $colorcode == ('#ffff00' ?? '#00e400' ?? '#ff7e00') ? 'color: black' : ''}}">
            <h2>{{ $overall }} AQI</h2>
            <h3>{{ $category['description'] }}</h3>
            <h3 class="burmese">{{ $category['description_mm'] }}</h3>
            <p class="updatedText">Updated {{ $updated_at }}.</p>
        </div>
    </div>
</div>
@endsection