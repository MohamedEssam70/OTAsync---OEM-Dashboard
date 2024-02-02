{{-- Tabs --}}
<div class="row">
  <div class="col-md-12">
    <ul class="nav nav-pills nav-tabs flex-column flex-md-row mb-3">
      <li class="nav-item me-1">
        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#details-tab-contents" aria-controls="details-tab-contents">Model Data</button>
      </li>
      <li class="nav-item me-1">
        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#vehicles-tab-contents" aria-controls="vehicles-tab-contents">Vehicles</button>
      </li>
      <li class="nav-item me-1">
        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#diagnostic-tab-contents" aria-controls="diagnostic-tab-contents">Diagnostic Sessions</button>
      </li>
      <li class="nav-item me-1">
        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#logs-tab-contents" aria-controls="logs-tab-contents">Logs</button>
      </li>
      <li class="nav-item">
        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#firmwares-tab-contents" aria-controls="firmwares-tab-contents">Firmwares</button>
      </li>
    </ul>
  </div>
</div>


{{-- Tabs Contents --}}

<div class="tab-content shadow-none border-0 pb-0 ps-0">
  <div class="tab-pane fade active show" id="details-tab-contents" role="tabpanel">
    <div class="row">
      <div class="col-xxl mb-4 order-5 order-xxl-0">
        <div class="card h-100">
            <div class="card-header">
                <div class="card-title mb-0">
                    <h5 class="m-0">Firmware updater overview</h5>
                </div>
            </div>
            <div class="card-body">
                <div class="d-none d-lg-flex vehicles-progress-labels mb-3">
                    <div class="vehicles-progress-label on-the-way-text" style="width: 40%;">Up to date</div>
                    <div class="vehicles-progress-label unloading-text" style="width: 60.0%;">Updates pending</div>
                </div>
                <div class="vehicles-overview-progress progress rounded-2 mb-3" style="height: 46px;">
                    <div class="progress-bar fs-big fw-medium text-start bg-success text-white px-1 px-lg-3 rounded-start shadow-none" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">40%</div>
                    <div class="progress-bar fs-big fw-medium text-start bg-lighter text-secondary px-1 px-lg-3 rounded-end shadow-none" role="progressbar" style="width: 60.0%" aria-valuenow="60.0" aria-valuemin="0" aria-valuemax="100">60.0%</div>
                </div>
                <div class="table-responsive">
                    <table class="table card-table">
                    <tbody class="table-border-bottom-0">
                        <tr>
                          <td class="w-50 ps-0">
                              <div class="d-flex justify-content-start align-items-center">
                              <div class="me-2">
                                <i class='bx bx-check-double text-success'></i>
                              </div>
                              <h6 class="mb-0 fw-normal">Up to date</h6>
                              </div>
                          </td>
                          <td class="text-end pe-0 text-nowrap">
                              <h6 class="mb-0">40 vehicles</h6>
                          </td>
                          <td class="text-end pe-0">
                              <span class="fw-medium">40%</span>
                          </td>
                        </tr>
                        <tr>
                          <td class="w-50 ps-0">
                              <div class="d-flex justify-content-start align-items-center">
                              <div class="me-2">
                                <i class="fa-solid fa-spinner fa-spin"></i>
                              </div>
                              <h6 class="mb-0 fw-normal">Updates pending</h6>
                              </div>
                          </td>
                          <td class="text-end pe-0 text-nowrap">
                              <h6 class="mb-0">60 vehicles</h6>
                          </td>
                          <td class="text-end pe-0">
                              <span class="fw-medium">60.0%</span>
                          </td>
                        </tr>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
      </div>
      <div class="col-xxl mb-4 order-5 order-xxl-0">
        <div class="row" style="flex-direction: column">
          <div class="col mb-4">
            <div class="card card-border-shadow-primary h-100">
              <div class="card-body">
                <div class="d-flex align-items-center mb-2 pb-1">
                  <div class="avatar me-2">
                    <span class="avatar-initial rounded bg-label-primary"><i class="fa-regular fa-circle-check"></i></span>
                  </div>
                  <h4 class="ms-1 mb-0">92</h4>
                </div>
                <p class="mb-1">Vehicles with no issues</p>
                <p class="mb-0">
                  <span class="fw-medium me-1">92.0%</span>
                  <small class="text-muted">of diagnostics sessions</small>
                </p>
              </div>
            </div>
          </div>
          <div class="col mb-4">
            <div class="card card-border-shadow-warning h-100">
              <div class="card-body">
                <div class="d-flex align-items-center mb-2 pb-1">
                  <div class="avatar me-2">
                    <span class="avatar-initial rounded bg-label-warning"><i class="bx bx-error"></i></span>
                  </div>
                  <h4 class="ms-1 mb-0">8</h4>
                </div>
                <p class="mb-1">Vehicles with issues</p>
                <p class="mb-0">
                  <span class="fw-medium me-1">8.0%</span>
                  <small class="text-muted">of diagnostics sessions</small>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="tab-pane fade" id="vehicles-tab-contents" role="tabpane2">
  </div>

  <div class="tab-pane fade" id="diagnostic-tab-contents" role="tabpane3">
  </div>
  
  <div class="tab-pane fade" id="logs-tab-contents" role="tabpane4">
  </div>

  <div class="tab-pane fade" id="firmwares-tab-contents" role="tabpane5">
  </div>
</div>
