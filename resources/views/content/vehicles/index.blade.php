@extends('layouts/contentNavbarLayout',['navbarBreadcrumb' => true, 'navbarBreadcrumbPrev' => 'Vehcile Models', 'navbarBreadcrumbActive' => $model_name, 'breadcrumbLink'=> route("models")])
@section('title', 'Vehicles')

@section('vendor-style')
@endsection

@section('page-style')
@endsection

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body mb-4 p-4">
                @livewire("vehicles-table", ["theme" => "bootstrap-5", "id" => $model_id])
            </div>
        </div>        
    </div>
</div>

<!-- Offcanvas -->
@include('content.vehicles.add-offcanvas')

@endsection


@section('vendor-script')
@endsection

@section('page-script')
@if ($errors->has('pin') || $errors->has('vin'))
<script>
    new bootstrap.Offcanvas($('#offcanvas_addVehicle')).show();
</script>
@endif

@endsection