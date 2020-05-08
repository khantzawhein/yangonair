@extends('layouts.layout')
@section('title', 'Charts')
@section('head')
<link rel="stylesheet" href="{{ asset('css/charts.styles.css') }}">
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <ul class="nav nav-tabs nav-fill nav-pills" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="overallchart-tab" data-toggle="tab" href="#overallchart" role="tab" aria-controls="overallchart" aria-selected="true">{{ __('charts.overall') }}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="sensorchart-tab" data-toggle="tab" href="#sensorchart" role="tab" aria-controls="sensorchart" aria-selected="false">{{ __('charts.byeachsensors') }}</a>
            </li>
            
        </ul>
          <div class="tab-content loading-data" id="myTabContent">
            <div class="tab-pane fade show active" id="overallchart" role="tabpanel" aria-labelledby="overallchart-tab">
                <div class="row justify-content-center">
                    <div class="col-md-11 mt-3">
                        {!! $overallChart->container() !!}
                    </div>
                    <div class="col-md-12">
                        {!! $sensorsLineChart->container() !!}
                    </div>
                </div>
                
            </div>
            <div class="tab-pane fade" id="sensorchart" role="tabpanel" aria-labelledby="profile-tab">
                <div class="row justify-content-center">
                    <div class="col-md-10 mt-1">
                        <ul class="nav nav-tabs nav-pills nav-fill sub-nav" id="myTab" role="tablist">
                            <li class="nav-item">
                              <a class="nav-link active" id="realtimesensor-tab" data-toggle="tab" href="#realtimesensor" role="tab" aria-controls="realtimesensor" aria-selected="true">{{ __('charts.RealtimeAQI') }}</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="bycategory-tab" data-toggle="tab" href="#bycategory" role="tab" aria-controls="bycategory" aria-selected="false">{{ __('charts.ByCategory') }}</a>
                            </li>
                          </ul>
                          <div class="tab-content loading-data" id="myTabContent">
                            <div class="tab-pane fade show active" id="realtimesensor" role="tabpanel" aria-labelledby="realtimesensor-tab">
                                <div class="row justify-content-center">
                                    <div class="col-md-11 mt-3">
                                        {!! $sensorsBarChart->container() !!}
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="bycategory" role="tabpanel" aria-labelledby="bycategory-tab">
                                <div class="row justify-content-center">
                                    <div class="col-md-11 mt-3">
                                        {!! $categoryPieChart->container() !!}
                                    </div>
                                </div>
                            </div>
                          </div>
                    </div>
                </div>
            </div>
         </div>
    </div>
</div>
<p class="updatedText">Updated {{ $updated_at }}.</p>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"></script>
{!! $overallChart->script() !!}
{!! $sensorsBarChart->script() !!}
{!! $categoryPieChart->script() !!}
{!! $sensorsLineChart->script() !!}
<script>
$(window).on('load', function() {
    setTimeout(() => {
        $('.loading-data').removeClass('loading-data');
    }, 1000);
    
});
    
</script>
@endsection