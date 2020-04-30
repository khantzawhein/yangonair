@extends('layouts.layout')
@section('title', 'Data')
@section('head')
<link rel="stylesheet" href="{{ asset('css/lists.styles.css') }}">
@endsection
@section('content')
<div class="row justify-content-md-center">
    <div class="col-sm-11">
        <ul class="nav nav-tabs nav-fill nav-pills mt-3" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="aqi-tab" data-toggle="tab" href="#aqi" role="tab" aria-controls="aqi" aria-selected="true">AQI</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="raw-tab" data-toggle="tab" href="#raw" role="tab" aria-controls="raw" aria-selected="false">Raw PM2.5</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="aqi" role="tabpanel" aria-labelledby="AQI-tab">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Sensor Name</th>
                        <th>Township</th>
                        <th>AQI Index</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sensorDB as $row)
                    <tr>
                        <td>{{ $row->sensor_name }}</td>
                        <td>{{ $row->township }}</td>
                        <td>{{ $sensorAQI[$loop->index] }}</td>
                        <td style="background-color: {{ $colorcode[$loop->index] }}">{{ $category[$loop->index]['description'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            <div class="tab-pane fade" id="raw" role="tabpanel" aria-labelledby="raw-tab">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Sensor Name</th>
                            <th>Township</th>
                            <th>Raw PM2.5 value</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sensorDB as $row)
                        <tr>
                            <td>{{ $row->sensor_name }}</td>
                            <td>{{ $row->township }}</td>
                            <td>{{ $rawPM[$loop->index] }}</td>
                            <td style="background-color: {{ $colorcode[$loop->index] }}">{{ $category[$loop->index]['description'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <p class="updatedText">Updated {{ $updated_at }}.</p>
        </div>
    </div>
</div>
@endsection