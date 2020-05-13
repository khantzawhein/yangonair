@extends('admin.layouts.layout')
@section('title', 'Fb Settings')
@section('header', 'Facebook settings')
@section('breadcrumb')
<li class="breadcrumb-item">YangonAQI Admin</li>
<li class="breadcrumb-item active"><a href="{{ route('admin') }}">Dashboard</a></li>
<li class="breadcrumb-item active"><a href="{{ route('fb-settings.index') }}">Facebook Settings</a></li>
<li class="breadcrumb-item active">Show</li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary">
                    <div class="card-header">
                        {{ $template->name }}
                    </div>
                    <div class="card-body">
                        <div class="templateEN">
                            <h4>Template in English: </h4>
                            {{ $template->template_en }}
                        </div>
                        <div class="templateMM mt-3">
                            <h4>Template in Burmese: </h4>
                            {{ $template->template_my_MM }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection