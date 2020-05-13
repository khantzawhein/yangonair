@extends('admin.layouts.layout')
@section('title', 'Add new template')
@section('header', 'Facebook settings')
@section('breadcrumb')
<li class="breadcrumb-item">YangonAQI Admin</li>
<li class="breadcrumb-item active"><a href="{{ route('admin') }}">Dashboard</a></li>
<li class="breadcrumb-item active"><a href="{{ route('fb-settings.index') }}">Facebook Settings</a></li>
<li class="breadcrumb-item active">Add new template</li>
@endsection
@section('content')
<div class="card card-primary">
    <div class="card-header">
        Add new template
    </div>
    <form action="{{ route('fb-settings.store') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name">Template name: </label>
                <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror">
                @error('name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="templateEN">Template in English</label>
                <textarea name="templateEN" id="templateEN" cols="30" rows="10" class="form-control @error('templateEN') is-invalid @enderror" placeholder="Enter text in English">{{ old('templateEN') }}</textarea>
                @error('templateEN')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="templateMM">Template in Burmese</label>
                <textarea name="templateMM" id="templateMM" cols="30" rows="10" class="form-control @error('templateMM') is-invalid @enderror" placeholder="Enter text in Burmese">{{ old('templateMM') }}</textarea>
                @error('templateMM')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select class="form-control @error('category') is-invalid @enderror" name="category" id="category">
                    <option {{ old('category') ? '' : 'selected' }} disabled>Select:</option>
                    <option {{ old('category')=='Good' ? 'selected' : '' }} value="Good">Good</option>
                    <option {{ old('category')=='Moderate' ? 'selected' : '' }} value="Moderate">Moderate</option>
                    <option {{ old('category')=='UnhealthyForSensitiveGroups' ? 'selected' : '' }} value="UnhealthyForSensitiveGroups">Unhealthy For Sensitive Groups</option>
                    <option {{ old('category')=='Unhealthy' ? 'selected' : '' }} value="Unhealthy">Unhealthy</option>
                    <option {{ old('category')=='VeryUnhealthy' ? 'selected' : '' }} value="VeryUnhealthy">Very Unhealthy</option>
                    <option {{ old('category')=='Hazardous' ? 'selected' : '' }} value="Hazardous">Hazardous</option>
                </select>
                @error('category')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </form>
</div>

@endsection