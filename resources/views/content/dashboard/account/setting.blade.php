@extends('layouts/contentNavbarLayout',['navbarBreadcrumbPrev' => 'Account /', 'navbarBreadcrumbActive' => 'Settings'])

@section('title', 'Settings')

@section('content')
@include('content.dashboard.account.tabs', ['activeTab' => 1])
<div class="row">
  @include('misc.sub-under-maintenance')
</div>
@endsection
