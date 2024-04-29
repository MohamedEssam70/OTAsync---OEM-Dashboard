@extends('layouts/contentNavbarLayout',['navbarBreadcrumb' => true, 'navbarBreadcrumbPrev' => 'DTCs Database', 'navbarBreadcrumbActive' => '', 'breadcrumbLink'=> ''])
@section('title', 'DTCs Database')

@section('vendor-style')
@endsection

@section('page-style')
@endsection

@section('content')

<div class="card">
    <div class="card-body mb-4 py-4 px-4">
        @livewire("dtcs-table", ["theme" => "bootstrap-5"])
    </div>
</div>        

<!-- Add new DTC offcanvas -->
@include('content.diagnostic.dtcs.add-offcanvas')

@endsection


@section('vendor-script')
@endsection

@section('page-script')
@if ($errors->has('code') || $errors->has('type') || $errors->has('system') || $errors->has('manufactor'))
<script>
    new bootstrap.Offcanvas($('#offcanvas_addDTC')).show();
</script>
@endif

@endsection