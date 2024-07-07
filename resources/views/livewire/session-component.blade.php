<div>
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
        <div class="d-flex flex-column justify-content-center">
            <h5 class="mb-1 mt-3">
                Session #{{$session->id}} 
            </h5>
            <p class="text-body text-uppercase">{{\Carbon\Carbon::parse($session->created_at)->toFormattedDateString()}}, {{\Carbon\Carbon::parse($session->created_at)->toTimeString()}} (GMT+2)</p>
        </div>
        <div class="d-flex align-content-center flex-wrap gap-2">
            <button class="btn btn-label-danger delete-order active-options" id="session_close_btn"><i class='bx bx-no-signal'></i>&nbsp;Disconnect</button>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12 col-lg-4" id="general_details_Sec">
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
              <div id="cip">
                @if($session->status  == \App\Enums\SessionStatus::Active)
                  <h6 class="mb-2">CONNECTION: <span class="ms-2 text-primary">STABLE</span></h6>
                  <h6 class="mb-2">INTERFACE: <span class="ms-2">Ethernet</span></h6>
                  <h6 class="mb-3">PROTOCOL: <span class="ms-2">DoIP</span></h6>
                @elseif ($session->status  == \App\Enums\SessionStatus::Closed)
                  <h6 class="mb-2">CONNECTION: <span class="ms-2 text-muted">OFFLINE</span></h6></h6>
                  <h6 class="mb-2">INTERFACE: <span class="ms-2 text-danger">NA</span></h6>
                  <h6 class="mb-3">PROTOCOL: <span class="ms-2 text-danger">NA</span></h6>
                @else
                <h6 class="mb-2">CONNECTION: <span class="ms-2 text-danger">NA</span></h6></h6>
                <h6 class="mb-2">INTERFACE: <span class="ms-2 text-danger">NA</span></h6>
                <h6 class="mb-3">PROTOCOL: <span class="ms-2 text-danger">NA</span></h6>
                @endif
              </div>
              <h6 class="mb-2">Last Session: 
                  @if ($priorSession = $session->vehicle->priorSession($session->id))
                      {{ \Carbon\Carbon::parse($priorSession)->toFormattedDateString() }}
                  @else
                      No prior sessions
                  @endif
              </h6>
              <h6 class="mb-3">No. of Diagnostic Sessions: {{$session->vehicle->sessions->count()}}</h6>
              <h6 class="mb-3">Firmware: AC7k-88071-AT</h6>
              <hr class="mb-1">
              <div class="row">
                <div class="col">
                  <p class=" mb-0">Engine Codes:</p>
                </div>
                <div class="col-6">
                  <span class="text-muted" id="dtc_counter"></span>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <p class="mb-0">Readiness Monitors:</p>
                </div>
                <div class="col-6">
                  <span class="text-muted" id="monitors_counter"></span>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <p class="mb-0">Freeze Frame:</p>
                </div>
                <div class="col-6">
                  <span class="text-muted" id="frames_counter"></span>
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
    
        <div class="col-12 col-lg-8" id="DTCs_details_Sec">
          <div class="card h-100">
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
                <button type="button" class="btn btn-dribbble btn-sm ms-2 active-options" id="dtc_refresh_btn">
                  <span>
                      <i class="bx bx-refresh me-0 me-sm-1"></i>
                      <span class="">Refresh</span>
                  </span>
                </button>
                <button type="button" class="btn btn-success btn-sm ms-2 active-options clear-btn" data-target="0" id="clear_all_btn">
                  <span>
                    <i class="fa-solid fa-check-double me-0 me-sm-1"></i>
                    <span class="">Clear All</span>
                  </span>
                </button>
              </div>
            </div>
            <div class="card-body px-0">
              <div class="nav-align-top">
                <ul class="nav nav-tabs" role="tablist" id="DTC_navs">
                  <li class="nav-item" role="presentation">
                    <button type="button" class="nav-link shadow-none active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-confirmed" aria-controls="navs-top-confirmed" aria-selected="false" tabindex="-1" style="border-top-left-radius: 0;">Confirmed DTCs <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-danger ms-2" id="confirmed_counter"></span></button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-pending" aria-controls="navs-top-pending" aria-selected="false" tabindex="-1">Pending DTCs</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-logs" aria-controls="navs-top-logs" aria-selected="true">DTCs Logs</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-frame" aria-controls="navs-top-frame" aria-selected="true">Freeze Frame</button>
                  </li>
                </ul>
                <div class="tab-content px-0 pb-0 shadow-none h-100 scrollable-tab-content" id="DTCs_content">
                  <div class="tab-pane fade active show" id="navs-top-confirmed" role="tabpanel">
                    <div class="">
                      {{-- @livewire("confirmed-table", ["theme" => "bootstrap-5", "id" => $session->id]) --}}
                      <div class="table-responsive text-nowrap">
                        <table class="table table-hover px-5">
                          <thead>
                            <tr>
                              <th>Code</th>
                              <th>System</th>
                              <th>Manufacturer</th>
                              <th>Description</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody class="table-border-bottom-0" id="confirmed_data_table">
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="navs-top-pending" role="tabpanel">
                    <div class="">
                      {{-- @livewire("pending-table", ["theme" => "bootstrap-5", "id" => $session->id]) --}}
                      <div class="table-responsive text-nowrap">
                        <table class="table table-hover px-5">
                          <thead>
                            <tr>
                              <th>Code</th>
                              <th>System</th>
                              <th>Manufacturer</th>
                              <th>Description</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody class="table-border-bottom-0" id="pending_data_table">
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="navs-top-logs" role="tabpanel">
                    <div class="">
                      {{-- @livewire("logs-table", ["theme" => "bootstrap-5", "id" => $session->id]) --}}
                      <div class="table-responsive text-nowrap">
                        <table class="table table-hover px-5">
                          <thead>
                            <tr>
                              <th>Code</th>
                              <th>Type</th>
                              <th>Read At</th>
                              <th>Cleared</th>
                            </tr>
                          </thead>
                          <tbody class="table-border-bottom-0" id="logs_data_table">
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="navs-top-frame" role="tabpanel">
                    @include('content.diagnostic.sessions.frames_collapse')
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
            <button type="button" class="btn btn-dribbble btn-sm ms-2 active-options" id="sensor_refresh_btn">
              <span>
                  <i class="bx bx-refresh me-0 me-sm-1"></i>
                  <span class="">Refresh</span>
              </span>
            </button>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive text-nowrap">
              <table class="table table-hover px-5">
                <thead>
                  <tr>
                    <th>Sensor</th>
                    <th>Value</th>
                    <th>Min</th>
                    <th>Avg</th>
                    <th>Max</th>
                  </tr>
                </thead>
                <tbody class="table-border-bottom-0" id="sensor_data_table">
                </tbody>
              </table>
            </div>
            <div class="p-5">
              <canvas id="sensorChart"></canvas>
            </div>
            <div id="no-monitor" style="
                  position: absolute;
                  top: 50%;
                  transform: translateX(-50%);
                  left: 47%;
              " class="h4 text-light">
              <span></span>
            </div>
          </div>
        </div>
    
      </div>
    </div>
</div>
