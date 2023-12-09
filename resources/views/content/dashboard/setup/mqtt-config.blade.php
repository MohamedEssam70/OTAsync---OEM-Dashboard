@extends('layouts/contentNavbarLayout',['navbarBreadcrumbPrev' => 'Setup & Configurations /', 'navbarBreadcrumbActive' => 'MQTT Configuration'])

@section('title', 'MQTT configuration')

@section('content')
@include('content.dashboard.setup.tabs', ['activeTab' => 1])
<div class="row">
  @include('content/dashboard/sub-under-maintenance')
</div>
@endsection
