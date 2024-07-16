@extends('layouts/contentNavbarLayout', ['navbarBreadcrumbActive' => 'Management Dashboard'])

@section('title', 'Dashboard')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection

@section('content')
<div class="container-fluid">
  <div class="row justify-content-center mt-5">
    <div class="col-5">
      <span class="text-truncate d-flex align-items-center mb-4">
          <span class="badge rounded-pill bg-label-danger me-1">Demo Release</span>
      </span>
      <h1 class="text-dark"><strong class="bold-text-22"> Empowering Wireless Diagnostic and OTA Updates</strong></h1>
      <p class="align-items-center mb-5 mt-4 me-3 w-75 text-dark">
        Over-the-Air Software Update technology puts you in control, enabling you to update, upgrade, and add exciting new features to your vehicle remotely.
      </p>
      {{-- <a href="javascript:void();" class="btn btn-primary">Demo Release</a> --}}
    </div>
    <div class="col-5">
      <img src="{{asset('assets/img/backgrounds/home_image2.png')}}" alt="home-img" class="img-fluid">
    </div>
  </div>
</div>
@endsection
