@extends('layouts/contentNavbarLayout', ['navbarBreadcrumbPrev' => 'Setup & Configurations /', 'navbarBreadcrumbActive' => 'System Customize'])

@section('title', 'System customize')

@section('page-script')
<script src="{{asset('assets/js/page-system-customize.js')}}"></script>
@endsection


@section('content')
@include('content.dashboard.setup.tabs', ['activeTab' => 0])
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <h5 class="card-header">Target Machine</h5>
      <div class="card-body">
        <h6>What type of machine does your company provide?</h6>
        <form id="formSystemCustomize" method="POST" action="{{route('system.update')}}"  enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-sm-6">
              <select id="macid" class="form-select @error('macid') is-invalid @enderror" name="macid">
                @foreach ($macs as $mac)
                <option value="{{$mac->id}}" @if($mac->id == \App\Models\Config::first()->macid) selected @endif>{{$mac->name}}</option>
                @endforeach
              </select>
              @error('macid')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            <!-- Button trigger modal -->
            <button type="button" class="btn rounded-pill btn-icon btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
              <span class="tf-icons bx bx-plus"></span>
            </button>
          </div>

          {{-- Form Buttons --}}
          <div class="mt-4">
            <button type="submit" class="btn btn-primary me-2">Save changes</button>
            {{-- <button type="reset" class="btn btn-outline-secondary">Discard</button> --}}
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="row mt-5">
  <div class="col-md-12">
    <div class="card">
      <h5 class="card-header">Models</h5>
      <div class="card-body">
        <form id="" method="POST" action=""  enctype="multipart/form-data">  
          @csrf
          <div class="table-responsive ">
            <table class="table table-striped table-borderless border-bottom">
              <thead>
                <tr>
                  <th class="text-nowrap">Model</th>
                  <th class="text-nowrap">Serial</th>
                  <th class="text-nowrap">ECUs</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($models as $model)
                <tr>
                  <td>
                    <div class="form-check">
                      <a href="" data-bs-toggle="offcanvas" data-bs-target="#offcanvasEnd" aria-controls="offcanvasEnd">{{$model -> name}}</a>
                      <input class="form-check-input" type="checkbox" id=""/>
                    </div>
                  </td>
                  <td>
                    <div class="d-flex justify-content-start">
                      {{$model -> serial}}
                    </div>
                  </td>
                  <td>
                    <div class="d-flex justify-content-start">
                      --
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>

          {{-- Form Buttons --}}
          <div class="mt-4">
            <button type="submit" class="btn btn-primary me-2">Add</button>
            <button type="reset" class="btn btn-outline-secondary">Delete</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>



<div class="row mt-5">
  <div class="col-md-12">
    <div class="card">
      <h5 class="card-header">ECUs</h5>
      <div class="card-body">
        <form id="" method="POST" action=""  enctype="multipart/form-data">  
          @csrf
          <div class="table-responsive ">
            <table class="table table-striped table-borderless border-bottom">
              <thead>
                <tr>
                  <th class="text-nowrap">ECU</th>
                  <th class="text-nowrap">Application</th>
                  <th class="text-nowrap">Firmware Version</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($ecus as $ecu)
                <tr>
                  <td>
                    <div class="form-check">
                      <a href="" data-bs-toggle="offcanvas" data-bs-target="#offcanvasEnd" aria-controls="offcanvasEnd">{{$ecu -> name}}</a>
                      <input class="form-check-input" type="checkbox" id=""/>
                    </div>
                  </td>
                  <td>
                    <div class="d-flex justify-content-start">
                      {{$ecu -> app}}
                    </div>
                  </td>
                  <td>
                    <div class="d-flex justify-content-start">
                      {{$ecu -> software_version}}
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>

          {{-- Form Buttons --}}
          <div class="mt-4">
            <button type="submit" class="btn btn-primary me-2">Add</button>
            <button type="reset" class="btn btn-outline-secondary">Delete</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Add Machine</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      {{-- Add Machine --}}
      <form id="formAddMac" method="POST" action="{{route('mac.create')}}"  enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="row">
            <div class="col mb-3">
              <label for="name" class="form-label">New Type</label>
              <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Enter Type Name" autofocus/>
              @error('name')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
    </div>
  </div>
</div>


{{-- <button type="button" class="btn rounded-pill btn-icon btn-primary" data-bs-toggle="offcanvas" data-bs-target="#offcanvasEnd" aria-controls="offcanvasEnd">
  <span class="tf-icons bx bx-plus"></span>
</button> --}}

<!-- Offcanvas -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEnd" aria-labelledby="offcanvasEndLabel">
  <div class="offcanvas-header">
    <h5 id="offcanvasEndLabel" class="offcanvas-title">Offcanvas End</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body my-auto mx-0 flex-grow-0">
    <p class="text-center">Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.</p>
    <button type="button" class="btn btn-primary mb-2 d-grid w-100">Continue</button>
    <button type="button" class="btn btn-outline-secondary d-grid w-100" data-bs-dismiss="offcanvas">Cancel</button>
  </div>
</div>

@endsection
