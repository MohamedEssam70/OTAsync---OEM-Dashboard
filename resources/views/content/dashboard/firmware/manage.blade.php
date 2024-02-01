@extends('layouts/contentNavbarLayout',['navbarBreadcrumbPrev' => 'Firmware Updates / ', 'navbarBreadcrumbActive' => 'Upload Firmware'])

@section('title', 'Upload firmware')

@section('content')
<div class="row">
  @include('content/dashboard/sub-under-maintenance')
</div>
@endsection
