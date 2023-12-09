@extends('layouts/contentNavbarLayout',['navbarBreadcrumbPrev' => 'Setup & Configurations /', 'navbarBreadcrumbActive' => 'Server Connection'])

@section('title', 'Server connection')

@section('content')
@include('content.dashboard.setup.tabs', ['activeTab' => 3])
<div class="row">
  @include('content/dashboard/sub-under-maintenance')
</div>
@endsection
