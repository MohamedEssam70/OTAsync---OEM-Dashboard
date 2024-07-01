@extends('layouts/contentNavbarLayout',['navbarBreadcrumb' => true, 'navbarBreadcrumbPrev' => '', 'navbarBreadcrumbActive' => 'Diagnostic Sessions', 'breadcrumbLink'=> ''])
@section('title', 'Diagnositic')

@section('vendor-style')
@endsection

@section('page-style')
@endsection

@section('content')

<div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
    <div class="d-flex flex-column justify-content-center">
        <h5 class="mb-1 mt-3">
            Session #32543 
            {{-- <span class="badge bg-label-info">Ready to Pickup</span> --}}
            {{-- <span class="badge bg-label-success me-2 ms-2">Connected</span> --}}
        </h5>
        <p class="text-body">Aug 17, <span id="orderYear">2024</span>, 5:48 (GMT+3)</p>
    </div>
    <div class="d-flex align-content-center flex-wrap gap-2">
        <button class="btn btn-label-danger delete-order"><i class='bx bx-no-signal'></i>&nbsp;Disconnect</button>
    </div>
</div>
<div class="row mb-3">
    <div class="col-12 col-lg-4">
      <div class="card mb-4">
        <div class="card-header">
          <h6 class="card-title m-0">Vehicle details</h6>
        </div>
        <div class="card-body">
          <div class="d-flex justify-content-start align-items-center mb-4">
            <div class="avatar me-2">
              <img src={{asset("assets/img/elements/awdi2.png")}} alt="Avatar" class="rounded-circle">
            </div>
            <div class="d-flex flex-column">
              <span class="d-flex justify-content-between">
                <h6 class="mb-0 me-2">4S3BMHB68B3286078</h6>
                <small>(PIN: 2001)</small>
              </span>
              <small class="text-muted">MODEL: EVT77G-01</small></div>
          </div>
          <h6 class="mb-2">CONNECTION: <span class="ms-2 text-primary">STABLE</span></h6>
          <h6 class="mb-2">INTERFACE: <span class="ms-2 text-danger">NA</span></h6>
          <h6 class="mb-3">PROTOCOL: <span class="ms-2 text-danger">NA</span></h6>
          <h6 class="mb-2">Last Connection: JUL 3, 2024</h6>
          <h6 class="mb-3">No. of Diagnostic Sessions: 4</h6>
          <h6 class="mb-3">Firmware: AC7k-88071-AT</h6>
          <hr class="mb-1">
          <div class="row">
            <div class="col">
              <p class=" mb-0">Engine Codes:</p>
            </div>
            <div class="col-6">
              <span class="text-muted">8</span>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <p class="mb-0">Readiness Monitors:</p>
            </div>
            <div class="col-6">
              <span class="text-muted">4</span>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <p class="mb-0">Freeze Frame:</p>
            </div>
            <div class="col-6">
              <span class="text-muted">0</span>
            </div>
          </div>
        </div>
      </div>
    
      <div class="card mb-0">
        <div class="card-header d-flex justify-content-between">
          <h6 class="card-title m-0">Supportd sensors</h6>
        </div>
        <div class="card-body">
          <p class="mb-0">Monitor status since DTCs cleared</p>
          <p class="mb-0">Freeze frame trouble code</p>
          <p class="mb-0">Engine coolant temperature</p>
          <p class="mb-0">Vehicle collision avoidance sensor</p>
        </div>
      </div>
    </div>

    <div class="col-12 col-lg-8">
      <div class="card mb-4 h-100">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h4 class="card-title m-0">Trouble Codes</h4>
          <div>
            <div class="btn-group">
              <button type="button" class="btn btn-label-primary p-2 py-1 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <span>
                  <i class='bx bx-export small' ></i>
                  <span class="small">Export</span>
              </span>
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="javascript:void(0);"><i class='bx bxs-printer'></i>&nbsp;Print</a></li>
                <li><a class="dropdown-item" href="javascript:void(0);"><i class="fa-solid fa-file-csv"></i>&nbsp;CSV</a></li>
                <li><a class="dropdown-item" href="javascript:void(0);"><i class='bx bxs-file-pdf' ></i>&nbsp;PDF</a></li>
                <li><a class="dropdown-item" href="javascript:void(0);"><i class='bx bx-copy' ></i>&nbsp;Copy</a></li>
              </ul>
            </div>
            <button type="button" class="btn btn-dribbble btn-sm ms-2">
              <span>
                  <i class="bx bx-refresh me-0 me-sm-1"></i>
                  <span class="">Refresh</span>
              </span>
            </button>
            <button type="button" class="btn btn-success btn-sm ms-2">
              <span>
                <i class="fa-solid fa-check-double me-0 me-sm-1"></i>
                <span class="">Clear All</span>
              </span>
            </button>
          </div>
        </div>
        <div class="card-body px-0">
          <div class="nav-align-top mb-4 h-100">
            <ul class="nav nav-tabs" role="tablist">
              <li class="nav-item" role="presentation">
                <button type="button" class="nav-link shadow-none active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="false" tabindex="-1" style="border-top-left-radius: 0;">Confirmed DTCs <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-danger ms-2">3</span></button>
              </li>
              <li class="nav-item" role="presentation">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-profile" aria-controls="navs-top-profile" aria-selected="false" tabindex="-1">Pending DTCs</button>
              </li>
              <li class="nav-item" role="presentation">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-messages" aria-controls="navs-top-messages" aria-selected="true">Freeze Frame</button>
              </li>
            </ul>
            <div class="tab-content shadow-none h-100">
              <div class="tab-pane fade" id="navs-top-home" role="tabpanel">
                <p>
                  Icing pastry pudding oat cake. Lemon drops cotton candy caramels cake caramels sesame snaps powder. Bear
                  claw
                  candy topping.
                </p>
                <p class="mb-0">
                  Tootsie roll fruitcake cookie. Dessert topping pie. Jujubes wafer carrot cake jelly. Bonbon jelly-o
                  jelly-o ice
                  cream jelly beans candy canes cake bonbon. Cookie jelly beans marshmallow jujubes sweet.
                </p>
              </div>
              <div class="tab-pane fade" id="navs-top-profile" role="tabpanel">
                <p>
                  Donut dragée jelly pie halvah. Danish gingerbread bonbon cookie wafer candy oat cake ice cream. Gummies
                  halvah
                  tootsie roll muffin biscuit icing dessert gingerbread. Pastry ice cream cheesecake fruitcake.
                </p>
                <p class="mb-0">
                  Jelly-o jelly beans icing pastry cake cake lemon drops. Muffin muffin pie tiramisu halvah cotton candy
                  liquorice caramels.
                </p>
              </div>
              <div class="tab-pane fade active show" id="navs-top-messages" role="tabpanel">
                <p>
                  Oat cake chupa chups dragée donut toffee. Sweet cotton candy jelly beans macaroon gummies cupcake gummi
                  bears
                  cake chocolate.
                </p>
                <p class="mb-0">
                  Cake chocolate bar cotton candy apple pie tootsie roll ice cream apple pie brownie cake. Sweet roll icing
                  sesame snaps caramels danish toffee. Brownie biscuit dessert dessert. Pudding jelly jelly-o tart brownie
                  jelly.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

<div class="row">
  <div class="col-12 col-lg-12">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title m-0">Monitoring</h4>
      </div>
      <div class="card-body">

      </div>
    </div>

  </div>
</div>

@endsection


@section('vendor-script')
@endsection

@section('page-script')
@endsection