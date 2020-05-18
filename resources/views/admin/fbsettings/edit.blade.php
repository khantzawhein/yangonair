@extends('admin.layouts.layout')
@section('title', 'Add new template')
@section('header', 'Facebook settings')
@section('breadcrumb')
<li class="breadcrumb-item">YangonAQI Admin</li>
<li class="breadcrumb-item active"><a href="{{ route('admin') }}">Dashboard</a></li>
<li class="breadcrumb-item active"><a href="{{ route('fb-settings.index') }}">Facebook Settings</a></li>
<li class="breadcrumb-item active">Edit template</li>
@endsection
@section('content')
<div class="card card-primary">
    <div class="card-header">
        Add new template
    </div>
    <form action="{{ route('fb-settings.update', $template->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label for="name">Template name: </label>
                <input id="name" name="name" type="text" value="{{ $template->name }}" class="form-control @error('name') is-invalid @enderror">
                @error('name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="template_en">Template in English</label>
                <textarea name="template_en" id="template_en" cols="30" rows="10" class="form-control @error('template_en') is-invalid @enderror" placeholder="Enter text in English">{{ $template->template_en }}</textarea>
                @error('template_en')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="template_my_MM">Template in Burmese</label>
                <textarea name="template_my_MM" id="template_my_MM" cols="30" rows="10" class="form-control @error('template_my_MM') is-invalid @enderror" placeholder="Enter text in Burmese">{{ $template->template_my_MM }}</textarea>
                @error('template_my_MM')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select class="form-control @error('category') is-invalid @enderror" name="category" id="category">
                    <option {{ $template->category ? '' : 'selected' }} disabled>Select:</option>
                    <option {{ $template->category=='Good' ? 'selected' : '' }} value="Good">Good</option>
                    <option {{ $template->category=='Moderate' ? 'selected' : '' }} value="Moderate">Moderate</option>
                    <option {{ $template->category=='UnhealthyForSensitiveGroups' ? 'selected' : '' }} value="UnhealthyForSensitiveGroups">Unhealthy For Sensitive Groups</option>
                    <option {{ $template->category=='Unhealthy' ? 'selected' : '' }} value="Unhealthy">Unhealty</option>
                    <option {{ $template->category=='VeryUnhealthy' ? 'selected' : '' }} value="VeryUnhealthy">Very Unhealthy</option>
                    <option {{ $template->category=='Hazardous' ? 'selected' : '' }} value="Hazardous">Hazardous</option>
                </select>
                @error('category')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>

@endsection