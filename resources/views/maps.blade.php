@extends('layouts.layout')
@section('title', 'Maps')
@section('head')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
   integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
   crossorigin=""></script>

@endsection

@section('content')


<div class="row justify-content-md-center">
    <div class="col">
        <div id="mapid"></div>
    </div>
</div>
<script src="{{ asset('js/maps.js') }}"></script>
<script>
@foreach ($sensorDB as $row)
    var CustomIcon{{ $loop->index }} = new myIcon({iconUrl: 'images/icons/{{ $colorname[$loop->index] }}.png', number : {{ $AQIData[$loop->index] }}});
    L.marker([{{ $row->lat }}, {{ $row->long }}], {icon: CustomIcon{{ $loop->index }}}).addTo(map).bindPopup("Sensor: {{ $row->sensor_name }}");
    @endforeach

</script>

<script>

</script>


@endsection