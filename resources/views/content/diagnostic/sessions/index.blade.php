@extends('layouts/contentNavbarLayout',['navbarBreadcrumb' => true, 'navbarBreadcrumbPrev' => '', 'navbarBreadcrumbActive' => 'Diagnositic Sessions', 'breadcrumbLink'=> ''])
@section('title', 'Diagnositic Sessions')

@section('vendor-style')
@endsection

@section('page-style')
@endsection

@section('content')

<div class="card">
    <div class="card-body mb-4 py-4 px-4">
        @livewire("sessions-table", ["theme" => "bootstrap-5"])
    </div>
</div>
@endsection
