@extends('layouts/contentNavbarLayout',['navbarBreadcrumbPrev' => 'Setup & Configurations /', 'navbarBreadcrumbActive' => 'Encription Configuration'])

@section('title', 'Encription configuration')

@section('content')
@include('content.dashboard.setup.tabs', ['activeTab' => 2])
<div class="row">
  @include('misc.sub-under-maintenance')
</div>
@endsection
