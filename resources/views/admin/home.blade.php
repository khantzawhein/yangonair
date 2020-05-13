@extends('admin.layouts.layout')

@section('header', 'Dashboard')
@section('breadcrumb')
<li class="breadcrumb-item">YangonAQI Admin</li>
<li class="breadcrumb-item active"><a href="{{ route('admin') }}">Dashboard</a></li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
      <div class="col-lg-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Facebook-Settings</h5>

            <p class="card-text">
              Change Facebook Auto Post Texts
            </p>

            <a href="{{ route('fb-settings.index') }}" class="card-link">Go</a>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <h5 class="m-0">Site Controls</h5>
          </div>
          <div class="card-body">
            <h5 class="card-title">Update AQI data</h5>
            <p class="card-text">
              Fetch data immediately
            </p>
            <form id="refresh" action="/admin/refresh" method="POST">
              @csrf
              <button type="submit" class="btn btn-info">Fetch</button>
            </form>
          </div>
        </div>
      </div>
      <!-- /.col-md-6 -->
      <div class="col-lg-6">
        <div class="card">
          <div class="card-header">
            <h5 class="m-0">Control</h5>
          </div>
          <div class="card-body">
            <h6 class="card-title"><b>Send notification</b></h6>
            <p class="card-text">Send AQI alerts to subscribed users immediately.</p>
            <form id="push" action="/push/now" method="POST">
            @csrf
            </form>
            <button onclick="confirmPush()" class="btn btn-warning">Send Notification</button>
          </div>
          
          <div class="card-body">
            <h6 class="card-title"><b>Post Update on Facebook</b></h6>
            <p class="card-text">Post an update on Facebook immediately.</p>
            <form id="fbupdate" action="/admin/fb-update" method="POST">
            @csrf
            </form>
            <button onclick="confirmPost()" class="btn btn-warning">Post Now</button>
          </div>
        </div> <!-- card -->

      </div>
      <!-- /.col-md-6 -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
@endsection