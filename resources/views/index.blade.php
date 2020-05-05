@extends('layouts.layout')
@section('title', 'Home')
@section('head')
<link rel="stylesheet" href="css/index.styles.css">
<link rel="stylesheet" href={{ asset("css/index.responsive.css") }}>
@endsection
@section('content')
<div class="row noti-alert-row">
    <div class="alert noti-alert alert-info alert-dismissible fade show " role="alert">
        <div>@lang('index.get_noti_alert')</div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>

<div class="row aqi-main">
    <div class="col-sm-12 mb-3 justify-content-sm-center"><h1>{{ __('index.current_ygn_air_quality') }} </h1></div>
    <div class="col-sm-12 justify-content-sm-center aqi-overall">
        <div class="box" style="background-color: {{ $colorCode }};  {{ $colorCode == ('#ffff00' ?? '#00e400' ?? '#ff7e00') ? 'color: black' : 'color: white'}}">
            <h2>{{ $overall }} AQI</h2>
            <h3>{{ $category['description'] }}</h3>
            <p class="updatedText">{{ __('global.updated_time', ['time'=>$updated_at]) }}</p>
        </div>
    </div>
    <div class="col-4 m-auto">
        <div class="aqi-max">
            <p class="aqi-small-title">{{ __('index.today_max') }}</p>
            <div class="box-small" style="background-color: {{ $maxColor }};  {{ $maxColor == ('#ffff00' ?? '#00e400' ?? '#ff7e00') ? 'color: black' : ''}}">
                <h2>{{ $maxAQI }} AQI</h2>
            </div>
        </div>
    </div>
    <div class="col-4 m-auto">
        <div class="aqi-avg">
            <p class="aqi-small-title">{{ __('index.today_avg') }}</p>
            <div class="box-small" style="background-color: {{ $avgColor }};  {{ $avgColor == ('#ffff00' ?? '#00e400' ?? '#ff7e00') ? 'color: black' : ''}}">
                <h2>{{ $avgAQI }} AQI</h2>
            </div>
        </div>
    </div>
    <div class="col-4 mr-auto">
        <div class="aqi-min">
            <p class="aqi-small-title">{{ __('index.today_min') }}</p>
            <div class="box-small" style="background-color: {{ $minColor }};  {{ $minColor == ('#ffff00' ?? '#00e400' ?? '#ff7e00') ? 'color: black' : ''}}">
                <h2>{{ $minAQI }} AQI</h2>
            </div>
        </div>
    </div>
</div>
<div class="row aqi-advise secondary-background">
    <div class="col-sm-12 mb-4">
    <h2 class="lang bold" style="text-align: center;">{{ __('index.what_next_title') }}</h2></div>

    

        @if($category['level'] == 0)
        <div class="col-sm-6 border-two-col good">
            <h4 class="lang subbold">@lang('index.who_need_to_be_concerned')</h4>
            <p>@lang('index.concern_good')</p>
        </div>
        <div class="col-sm-6 good">
            <h4 class="lang subbold">@lang('index.whatshouldido')</h4>
            <p>@lang('index.advise_good')</p>
        </div>
        @endif
        @if($category['level'] == 1)
        <div class="col-sm-6 border-two-col moderate">
            <h4 class="lang subbold">@lang('index.who_need_to_be_concerned')</h4>
            <p>@lang('index.concern_moderate')</p>
        </div>
        <div class="col-sm-6 moderate">
            <h4 class="lang subbold">@lang('index.whatshouldido')</h4>
            <p>@lang('index.advise_moderate')</p>
        </div>
        @endif
        @if($category['level'] == 2)
        <div class="col-sm-6 border-two-col unhealthsensitive">
            <h4 class="lang subbold">@lang('index.who_need_to_be_concerned')</h4>
            <p>@lang('index.concern_unhealthy_sensitive')</p>
        </div>
        <div class="col-sm-6 unhealthsensitive">
            <h4 class="lang subbold">@lang('index.whatshouldido')</h4>
            <p>@lang('index.advise_unhealthy_sensitive')</p>
        </div>
        @endif
        @if($category['level'] == 3)
        <div class="col-sm-6 border-two-col unhealthy">
            <h4 class="lang subbold">@lang('index.who_need_to_be_concerned')</h4>
            <p>@lang('index.concern_unhealthy')</p>
        </div>
        <div class="col-sm-6 unhealthy">
            <h4 class="lang subbold">@lang('index.whatshouldido')</h4>
            <p>@lang('index.advise_unhealthy')</p>
        </div>
        @endif
        @if($category['level'] == 4)
        <div class="col-sm-6 border-two-col very_unhealty">
            <h4 class="lang subbold">@lang('index.who_need_to_be_concerned')</h4>
            <p>@lang('index.concern_very_unhealty')</p>
        </div>
        <div class="col-sm-6 very_unhealty">
            <h4 class="lang subbold">@lang('index.whatshouldido')</h4>
            <p>@lang('index.advise_very_unhealty')</p>
        </div>
        @endif
        @if($category['level'] == 5)
        <div class="col-sm-6 border-two-col hazardous">
            <h4 class="lang subbold">@lang('index.who_need_to_be_concerned')</h4>
            <p>@lang('index.concern_hazardous')</p>
        </div>
        <div class="col-sm-6 hazardous">
            <h4 class="lang subbold">@lang('index.whatshouldido')</h4>
            <p>@lang('index.advise_hazardous')</p>
        </div>
        @endif
    
</div>
<div class="row border-top how-aqi-work secondary-background">
    <div class="col-sm-12 lang pt-3">
        <h4 class="subbold text-center">
            {{ __('index.how_ygnaqi_works_title') }}
        </h4>
        <p>
            @lang('index.how_ygnaqi_works_description')
        </p>
        <p class="text-center">@lang('index.aqi_readmore')</p>
    </div>
</div>
<div class="row">
    <div class="col footer">
      <p class="footer-text">YangonAQI is a project from students of DUCS and CS50x from Harvard.
        YangonAQI&copy; 2020
      </p>
    </div>
  </div>

@endsection