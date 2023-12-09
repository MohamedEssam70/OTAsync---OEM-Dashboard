@extends('layouts/contentNavbarLayout',['navbarBreadcrumbPrev' => 'Firmware Updates / ', 'navbarBreadcrumbActive' => 'Firmware Versions'])

@section('title', 'Firmware versions')

@section('content')
<div class="row">
  @include('content/dashboard/sub-under-maintenance')
</div>
@endsection
