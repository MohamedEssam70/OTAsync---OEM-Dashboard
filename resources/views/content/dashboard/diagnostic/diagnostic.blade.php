@extends('layouts/contentNavbarLayout',['navbarBreadcrumbPrev' => '', 'navbarBreadcrumbActive' => 'Diagnostic'])

@section('title', 'Diagnostic')

@section('content')
<div class="row">
  @include('content/dashboard/sub-under-maintenance')
</div>
@endsection
