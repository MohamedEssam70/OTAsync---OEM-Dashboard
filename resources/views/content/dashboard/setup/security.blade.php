@extends('layouts/contentNavbarLayout', ['navbarBreadcrumbPrev' => 'Security /', 'navbarBreadcrumbActive' => 'Security'])

@section('title', 'Security')

@section('vendor-style')
<link rel="stylesheet" href="{{asset("assets/vendor/libs/bootstrap-select/bootstrap-select.min.css")}}">
@endsection

@section('page-style')
<style>
  html:not([dir=rtl]) .api-key-actions {
    right: .5rem;
  }

  .api-key-actions {
      position: absolute !important;
      top: .75rem;
  }
</style>
@endsection

@section('content')
@include('content.dashboard.setup.tabs', ['activeTab' => 0])
<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <h5 class="card-header">Create an API key</h5>
      <div class="row">
        <div class="col-md-5 order-md-0 order-1">
          <div class="card-body">
            <form id="create-api-key" action="{{ route('system.keys.create') }}" method="POST" class="fv-plugins-bootstrap5 fv-plugins-framework">
              @csrf
              <div class="row fv-plugins-icon-container">

                <div class="mb-3 col-12">
                  <label for="apiAccess" class="form-label">Choose the Api key type you want to create</label>
                  <div class="position-relative">
                    <select id="apiAccess" class="select2 form-select" tabindex="-1" aria-hidden="true" name="type" @error('type') is-invalid @enderror>
                      <option value="">Choose Key Type</option>
                      @foreach (\App\Enums\KeysTypes::toArray() as $key => $value )
                          <option value="{{ $key }}" @selected(old('type') == $key)>{{ __('all.' . $key) }}</option>
                      @endforeach
                    </select>
                    @error('type')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>

                <div class="mb-3 col-12">
                  <label for="vehicle_id" class="form-label">Choose the vehicle that can use this api key</label>
                  <div class="position-relative">
                    <select id="vehicle_id" class="select2 form-select" tabindex="-1" aria-hidden="true" name="vehicle_id" @error('vehicle_id') is-invalid @enderror>
                      <option value="">Choose Vehicle</option>
                      @foreach ($vehicles as $key => $value)
                        <option value="{!! $key !!}" @selected(old('vehicle_id') == $key)>{!! $value !!}</option>
                      @endforeach
                    </select>
                    @error('vehicle_id')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>

                <div class="mb-3 col-12">
                  <label for="apiKey" class="form-label">Name the API key</label>
                  <input type="text" class="form-control" name="name" placeholder="Server Key 1" value="{{ old('name') }}" @error('name') is-invalid @enderror>
                  @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>

                <div class="col-12">
                  <button type="submit" class="btn btn-primary me-2 d-grid w-100">Create Key</button>
                </div>
              </div>
            <input type="hidden"></form>
          </div>
        </div>
        <div class="col-md-7 order-md-1 order-0">
          <div class="text-center mt-4 mx-3 mx-md-0">
            <img src="{{ asset('assets/img/illustrations/sitting-girl-with-laptop-light.png') }}" class="img-fluid" alt="Api Key Image" width="350">
          </div>
        </div>
      </div>
    </div>


    <div class="card mb-4">
      <h5 class="card-header">API Key List &amp; Access</h5>
      <div class="card-body">
        <p>An API key is a simple encrypted string that identifies an application without any principal. They are useful for accessing public data anonymously, and are used to associate API requests with your project for quota and billing.</p>
        <div class="row">
          <div class="col-md-12">
            @foreach ($apiKeys as $apiKey)
              <div class="bg-lighter rounded p-3 mb-3 position-relative">
                <div class="d-flex align-items-center flex-wrap mb-3">
                  <h4 class="mb-0 me-3">{!! $apiKey->name !!}</h4>
                  <span class="badge bg-label-primary">{!! __('all.' . $apiKey->type->value) !!}</span>
                </div>
                <div class="d-flex align-items-center mb-2">
                  <span class="me-2"><span class="fw-medium">{!! $apiKey->key !!}</span></span>
                  <span class="text-light cursor-pointer"><i class="bx bx-copy"></i></span>
                </div>
                <span>Created on {!! \Carbon\Carbon::parse($apiKey->created_at)->format('d M Y, H:i') !!}</span>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection


@section('vendor-script')
<script src="{{asset("assets/vendor/libs/bootstrap-select/bootstrap-select.min.js")}}"></script>
@endsection

@section('page-script')
<script>
</script>
@endsection