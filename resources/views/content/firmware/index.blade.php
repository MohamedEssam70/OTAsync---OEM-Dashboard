@extends('layouts/contentNavbarLayout',['navbarBreadcrumb' => true, 'navbarBreadcrumbPrev' => '', 'navbarBreadcrumbActive' => 'Upload Firmware', 'breadcrumbLink'=> route("home")])
@section('title', 'Firmwares Updates')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('page-style')
@endsection

@section('content')
<div class="row">
  <div class="col-lg-8 col-md-8 mb-4">
    <div class="col-12 h-100">
      <div class="card h-100">
        <div class="d-flex align-items-end row">
          <div class="col-sm-7">
            <div class="card-body">
              <h5 class="card-title text-primary">New Updateds!</h5>
              <p class="mb-4">Assign a new software updates for whole vehicle model or assign to specific vehicle.</p>
  
              <a href="{{route("firmware.add.view")}}" class="btn btn-sm btn-primary" target="_blank">New Software Update</a>
            </div>
          </div>
          <div class="col-sm-5 text-center text-sm-left">
            <div class="card-body pb-0 pt-0 px-0 px-md-4">
              <img src="../../assets/img/illustrations/undraw_Server_push_re_303w.png" height="180" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-md-4 mb-4">
    <div class="card h-100">
      <div class="card-body">
        <h4 class="mb-2 pb-1">Upcoming Update</h4>
        <p class="small">Next Generation Frontend Architecture Using Layout Engine And React Native Web.</p>
        <div class="row mb-3 g-3">
          <div class="col-6">
            <div class="d-flex">
              <div class="avatar flex-shrink-0 me-2">
                <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-calendar-exclamation bx-sm"></i></span>
              </div>
              <div>
                <h6 class="mb-0 text-nowrap">17 Nov 23</h6>
                <small>Date</small>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="d-flex">
              <div class="avatar flex-shrink-0 me-2">
                <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-time-five bx-sm"></i></span>
              </div>
              <div>
                <h6 class="mb-0 text-nowrap">32 minutes</h6>
                <small>Duration</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-12">
    <div class="card mb-4 p-4">
      @livewire("firmwares-table", ["theme" => "bootstrap-5"])
    </div>
  </div>
  
</div>


@endsection


@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
<script>
  Livewire.on('openModal', currnetStatus => {
    $('#statusModal').modal('show');
    // Fetch data or perform other actions based on the currnetStatus
    $('#statusModal').find('#status option[value="'+currnetStatus[0]+'"]').prop("selected", true);
    // on save status
    $('#statusModal').find('#update-status').on('click', function() {
      var status = $('#statusModal').find('#status').val();
      Livewire.dispatch('updateStatus', { status: status });
      $('#statusModal').modal('hide');
    });
  });

  $('#statusModal').on('hidden.bs.modal', function () {
    Livewire.dispatch('resetModal');
  });
</script>
@endsection