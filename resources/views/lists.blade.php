@extends('layouts.layout')
@section('title', 'Data')
@section('head')
<link rel="stylesheet" href="{{ asset('css/lists.styles.css') }}">
<link rel="stylesheet" href="css/perfect-scrollbar.css">
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
@endsection
@section('content')
<div class="row justify-content-md-center">
    <div class="col-sm-11">
        <div class="table-container mt-4">
            <div class="table100 ver1 m-b-110">
                <div class="table100-head">
                    <table>
                        <thead>
                            <tr class="row100 head">
                                <th class="cell100 column1">Sensor Name</th>
                                <th class="cell100 column2">Township</th>
                                <th class="cell100 column3">AQI Index</th>
                                <th class="cell100 column4">Raw PM2.5</th>
                                <th class="cell100 column5">Description</th>
                            </tr>
                        </thead>
                    </table>
                </div>

                <div class="table100-body js-pscroll">
                    <table>
                        <tbody>
                            @foreach ($sensorDB as $row)
                            <tr class="row100 body">
                                <td class="cell100 column1">{{ $row->sensor_name }}</td>
                                <td class="cell100 column2">{{ $row->township }}</td>
                                <td class="cell100 column3">{{ $sensorAQI[$loop->index] }}</td>
                                <td class="cell100 column4">{{ $rawPM[$loop->index]}}</td>
                                <td class="cell100 column5" style="background-color: {{ $colorcode[$loop->index] }};{{ $colorcode[$loop->index] == ('#ffff00' ?? '#00e400' ?? '#ff7e00') ? 'color: black' : 'color:white'}}">{{ $category[$loop->index]['description'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <p class="updatedText">Updated {{ $updated_at }}.</p>
    </div>
</div>
<script src="js/perfect-scrollbar.min.js"></script>
	<script>
		$('.js-pscroll').each(function(){
			var ps = new PerfectScrollbar(this,
            {
                minScrollbarLength: 5
            });

			$(window).on('resize', function(){
				ps.update();
			})
		});
    </script>
@endsection