@extends('layouts/contentNavbarLayout',['navbarBreadcrumbPrev' => 'Account /', 'navbarBreadcrumbActive' => 'Activity Log'])

@section('title', 'Activity Log')

@section('content')
@include('content.dashboard.account.tabs', ['activeTab' => 2])
<div class="row">
  @include('misc.sub-under-maintenance')
</div>
@endsection
