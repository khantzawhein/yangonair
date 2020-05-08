@extends('layouts.layout')
@section('title', 'What is AQI?')
@section('head')
<link rel="stylesheet" href="{{ asset('css/whatisaqi.styles.css') }}">
<link rel="stylesheet" href="{{ asset('css/whatisaqi.responsive.css') }}">
@endsection
@section('content')
<div class="row whatis-title-container title-container">
    <div class="col-12">
        <div class="title lang">{{ __('whatisaqi.whatisAQIPM2.5') }}</div>
    </div>
</div>
<div class="row whatis-container justify-content-center">
    <div class="col-sm-12">
        <div class="row mt-3">
            <div class="col-sm-6 border-two-col">
                <div class="question-container">
                    <h4 class="question lang">{{ __('whatisaqi.whatisAQI') }}</h4>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="answer-container">
                    <p class="answer lang">{{ __('whatisaqi.whatisAQI_explanation') }}</p>
                </div>
            </div>
        </div>
        <div class="row border-top">
            <div class="col-sm-6 border-two-col">
                <div class="question-container">
                    <h4 class="question lang">{{ __('whatisaqi.howdoesaqiworks') }}</h4>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="answer-container">
                    <p class="answer lang">{{ __('whatisaqi.howdoesaqiworks_explanation') }}</p>
                </div>
            </div>
        </div>
        <div class="row border-top">
            <div class="col-sm-6 border-two-col">
                <div class="question-container">
                    <h4 class="question lang">{{ __('whatisaqi.whatispm2.5') }}</h4>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="answer-container">
                    <p class="answer lang">{{ __('whatisaqi.whatispm2.5_explanation') }}</p>
                </div>
            </div>
        </div>
        <div class="row border-top">
            <div class="col-sm-6 border-two-col">
                <div class="question-container">
                    <h4 class="question lang">{{ __('whatisaqi.aqi_chart') }}</h4>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="answer-container">
                    <img src="images/aqichart_{{ ($lang == 'en') ? 'en' : 'mm' }}.png" alt="AQI Chart" width="100%">
                </div>
            </div>
        </div>
    </div>

</div>
@endsection