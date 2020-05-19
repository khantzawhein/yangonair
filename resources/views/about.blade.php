@extends('layouts.layout')
@section('title', 'About')
@section('head')
<link rel="stylesheet" href="{{ asset('css/about.styles.css') }}">
@endsection
@section('content')
<div class="row whatis-title-container title-container">
    <div class="col-12">
        <div class="title lang">{{ __('about.about') }}</div>
    </div>
</div>
<div class="row about-container lang pt-4">
    <div class="col-sm-12">
        <div class="row about-text-container justify-content-center">
            <div class="col-sm-8">
                <h4 class="text-center heading">YangonAQI</h4>
                <p class="about-text whitespace">{{ __('about.about_text') }}</p>
                <p class="contact whitespace">@lang('about.contact',['email' => '<a href="mailto:kzh702@gmail.com">kzh702@gmail.com</a>'])</p>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <h4 class=" text-center heading">Meet our team</h4>
    </div>
    <div class="col-sm-12">
        <div class="row justify-content-center team-container">
            <div class="col-sm-4">
                <div class="person-container text-center">
                    <img class="rounded-circle" src="images/waiyan.jpg" width=30% alt="">
                    <h5 class="name">Wai Yan Htun</h5>
                    <p class="description">Third Year, DUCS</p>
                    <p class="role">Data Collector, Design</p>
                </div>   
            </div>
            <div class="col-sm-4">
                <div class="person-container text-center">
                    <img class="rounded-circle" src="images/myatkoko.jpg" width=30% alt="">
                    <h5 class="name">Myat Ko Ko</h5>
                    <p class="description">First Year Honours, DUCS</p>
                    <p class="role">Content-Writer, Design</p>
                </div>   
            </div>
            <div class="col-sm-4">
                <div class="person-container text-center">
                    <img class="rounded-circle" src="images/khantzawhein.jpg" width=30% alt="">
                    <h5 class="name">Khant Zaw Hein</h5>
                    <p class="description">First Year Honours, DUCS</p>
                    <p class="role">Developer</p>
                </div> 
            </div>
            <div class="col-sm-12">
                <div class="row pt-4 justify-content-center">
                    <div class="col-sm-4">
                        <div class="person-container text-center">
                            <img class="rounded-circle" src="images/nandalinnhtike.jpg" width=30% alt="">
                            <h5 class="name">Nanda Linn Htike</h5>
                            <p class="description">Third Year, DUCS</p>
                            <p class="role">Adviser, Design</p>
                        </div> 
                    </div>
                    <div class="col-sm-4">
                        <div class="person-container text-center">
                            <img class="rounded-circle" src="images/naynyeinchan.jpg" width=30% alt="">
                            <h5 class="name">Nay Nyein Chan</h5>
                            <p class="description">Third Year, DUCS</p>
                            <p class="role">Data Collector, Design</p>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection