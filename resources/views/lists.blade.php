@extends('layouts.layout')
@section('title', 'Lists')
@section('content')
<div class="row justify-content-md-center">
    <div class="col-sm-9">
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
        <p class="updatedText">Updated {{ $updated_at }}.</p>
    </div>
</div>
@endsection