@extends('layouts/contentNavbarLayout',['navbarBreadcrumb' => true, 'navbarBreadcrumbPrev' => '', 'navbarBreadcrumbActive' => 'Vehicle Models', 'breadcrumbLink'=> route("home")])

@section('title', 'Vehicle Models')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <h5 class="card-header"></h5>
            <div class="table-responsive text-nowrap p-3">
              @livewire("models-table", ["theme" => "bootstrap-5"])
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
