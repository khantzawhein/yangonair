@extends('layouts.layout')
@section('title', 'Maps')
@section('head')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
<link rel="stylesheet" href="{{ asset('css/maps.styles.css') }}">
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
   integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
   crossorigin=""></script>
<style>
</style>
@endsection

@section('content')


<div class="row justify-content-md-center">
    <div class="col">
        <div id="mapid"></div>
    </div>
</div>
<script src="{{ asset('js/maps.js') }}"></script>
@foreach ($sensorDB as $row)
<div class="row" style="display: none">
    <div id="map-popup{{ $loop->index }}" class="col">
        <div class="map-popup" style="background-color: {{ $colorcode[$loop->index] }};  {{ $colorcode[$loop->index] == ('#ffff00' ?? '#00e400' ?? '#ff7e00') ? 'color: black' : 'color: white'}}">
            <div class="sensor_name">
                 Sensor: {{ $row->sensor_name }}
            </div>
            <div class="aqi-value">
                <div class="row">
                    <div class="col-4">
                        <p class="aqi-small-title">{{ __('global.now') }}</p>
                    </div>
                    <div class="col-8">
                        <div class="box-small" style="background-color: {{ $colorcode[$loop->index] }};  {{ $colorcode[$loop->index] == ('#ffff00' ?? '#00e400' ?? '#ff7e00') ? 'color: black' : ''}}">
                            <h2>{{ $AQIData[$loop->index] }}
                                AQI</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="category text-center">
                {{ $category[$loop->index]['description'] }}
            </div>
            <div class="small row">
                <div class="col-4">
                    <div class="aqi-max">
                        <p class="aqi-small-title">{{ __('index.today_max') }}</p>
                        <div class="box-small" style="background-color: {{ $maxColor[$loop->index] }};  {{ $maxColor[$loop->index] == ('#ffff00' ?? '#00e400' ?? '#ff7e00') ? 'color: black' : ''}}">
                            <h2>{{ $maxAQI[$loop->index] }}
                                AQI</h2>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="aqi-avg">
                        <p class="aqi-small-title">{{ __('index.today_avg') }}</p>
                        <div class="box-small" style="background-color: {{ $avgColor[$loop->index] }};  {{ $avgColor[$loop->index] == ('#ffff00' ?? '#00e400' ?? '#ff7e00') ? 'color: black' : ''}}">
                            <h2>{{ $avgAQI[$loop->index] }}
                                AQI</h2>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="aqi-min">
                        <p class="aqi-small-title">{{ __('index.today_min') }}</p>
                        <div class="box-small" style="background-color: {{ $minColor[$loop->index] }};  {{ $minColor[$loop->index] == ('#ffff00' ?? '#00e400' ?? '#ff7e00') ? 'color: black' : ''}}">
                            <h2>{{ $minAQI[$loop->index] }}
                                AQI</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    
    var CustomIcon{{ $loop->index }} = new myIcon({iconUrl: 'images/icons/{{ $colorname[$loop->index] }}.png', number : {{ $AQIData[$loop->index] }}});
    L.marker([{{ $row->lat }}, {{ $row->long }}], {icon: CustomIcon{{ $loop->index }}}).addTo(map).bindPopup(document.getElementById("map-popup{{ $loop->index }}").innerHTML);
</script>
@endforeach

<script>

</script>


@endsection