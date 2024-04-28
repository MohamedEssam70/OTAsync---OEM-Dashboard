@extends('layouts/contentNavbarLayout',['navbarBreadcrumb' => true, 'navbarBreadcrumbPrev' => '', 'navbarBreadcrumbActive' => 'Vehicle Models', 'breadcrumbLink'=> route("home")])
@section('title', 'Vehicle Models')

@section('vendor-style')
@endsection

@section('page-style')
@endsection

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <h5 class="card-header">Vehicle Models</h5>
            <div class="card-body mb-4 p-4">
                @livewire("models-table", ["theme" => "bootstrap-5"])
            </div>
        </div>        
    </div>
</div>

<!-- Offcanvas -->
@include('content.vehicles_model.add-offcanvas')

@endsection


@section('vendor-script')
@endsection

@section('page-script')
@if ($errors->has('name') || $errors->has('serial'))
<script>
    new bootstrap.Offcanvas($('#offcanvas_addVehicleModel')).show();
</script>
@endif

@endsection