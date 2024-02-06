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
    <div class="row mb-4 g-4">
      <div class="col-8">
        <div class="card h-100">
          <div class="card-body row widget-separator">
              <h4 class="text-primary mb-0">Update Firmware</h4>
              {{-- <p class="fw-medium mb-1">Total 187 reviews</p> --}}
              <p class="text-muted" style="width: 70%">Configer your updating process and upload new firmware hex file</p>
              {{-- <span class="badge bg-label-primary p-2 mb-3 mb-sm-0">+5 This week</span> --}}

              <form action="" method="POST" id="upgrade-form">

                {{-- UPGRADE SCHEDULE START --}}
                <div class="row">
                  <h5 class="col-sm-2" style="margin-bottom: 0;">Schedule</h5>
                  <div class="form-check form-switch col-xxl">
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                  </div>
                </div>
                <p class="text-muted mb-2">Disable for immediately upgrade</p>
                <div class="mb-3 row align-items-center disable-sec" id="scheduleDate">
                  <label for="html5-date-input" class="col-md-1 col-form-label">Date</label>
                  <div class="col-xxl">
                    <input class="form-control" type="datetime-local" value="2021-06-18T12:30:00" id="schedule-input" disabled>
                  </div>
                </div>
                {{-- UPGRADE SCHEDULE END --}}
                
                {{-- UPGRADE PRIORITY START --}}
                <div class="row">
                  <div class="mb-3 col-md-6">
                    <div class="form-check custom-option custom-option-icon">
                      <label class="form-check-label custom-option-content d-flex align-items-start justify-content-start" for="basicPlanMain1">
                        <input name="plan" class="form-check-input" type="radio" value="" id="basicPlanMain1">
                        <div class="text-start ms-2">
                          <span class="custom-option-header">
                            <span class="h6 mb-0 text-danger">Critical</span>
                            <span>Update</span>
                          </span>
                          <span class="custom-option-body">
                            <small>Vehicle will update upon startup.</small>
                          </span>
                        </div>
                      </label>
                    </div>
                  </div>
                  <div class="mb-3 col-md-6">
                    <div class="form-check custom-option custom-option-icon">
                      <label class="form-check-label custom-option-content d-flex align-items-start justify-content-start" for="basicPlanMain2">
                        <input name="plan" class="form-check-input" type="radio" value="" id="basicPlanMain2" checked autofocus />
                        <div class="text-start ms-2">
                          <span class="custom-option-header">
                            <span class="h6 mb-0 text-success">Normal</span>
                            <span>Update</span>
                          </span>
                          <span class="custom-option-body">
                            <small>Vehicle can update the firmware any time.</small>
                          </span>
                        </div>
                      </label>
                    </div>
                  </div>
                </div>
                {{-- UPGRADE PRIORITY END --}}

                {{-- UPLOAD HEX FILE START --}}
                <div class="dropzone d-flex justify-content-start" id="myDropzone" data-field="dz" style="border: 2px dashed #d9dee3;">
                  <input type="hidden" name="dz" value="dz">
                  <div class="dz-message needsclick" style="color: #566a7f; margin: 3.5rem 0; font-weight: 500; text-align: center; font-size: 1.625rem; width:100%; text-align:center;">
                    Upload your firmware
                    <span class="note needsclick mt-0" style="color: #697a8d; font-weight: 400; display: block; margin-top: 0.625rem; font-size: .9375rem;">(The uploaded file must be <span class="fw-medium">Hex</span> with max 1 MB.)</span>
                  </div>
                  <div hidden id="preview-template-continer">
                    <div class="dz-preview" id="dz-preview-template">
                      <div class="dz-details dz-preview dz-processing me-4" style="
                        width: fit-content;
                        border: 0 solid #d9dee3;
                        border-radius: 0.375rem;
                        box-shadow: 0 2px 6px 0 rgba(67,89,113,.12);
                        position: relative;
                        vertical-align: top;
                        background: #fff;
                        font-size: .8125rem;
                        box-sizing: content-box;
                        cursor: default;
                      ">

                        <div class="dz-thumbnail" style="
                          border-bottom: 1px solid #d9dee3;
                          background: rgba(67,89,113,.025);
                          border-top-left-radius: calc(0.375rem - 1px);
                          border-top-right-radius: calc(0.375rem - 1px);
                          width: 10rem;
                          position: relative;
                          padding: 0.625rem;
                          height: 7.5rem;
                          text-align: center;
                          box-sizing: content-box;
                        ">

                          <img data-dz-thumbnail style="
                            max-height: 100%;
                            max-width: 100%;
                            top: 50%;
                            position: relative;
                            transform: translateY(-50%) scale(1);
                            margin: 0 auto;
                            display: block;
                          ">

                          <span data-dz-nopreview id="nopreview" class="dz-nopreview" style="
                            color: #a1acb8;
                            font-weight: 500;
                            text-transform: uppercase;
                            font-size: .6875rem;
                            position: relative;
                            top: 50%;
                            transform: translateY(-50%) scale(1);
                            margin: 0 auto;
                            display: block;
                          ">No preview</span>

                          <div class="dz-success-mark" style="
                            background-color: rgba(35,52,70,.5);
                            display: block;
                            position: absolute;
                            left: 50%;
                            top: 50%;
                            margin-left: -1.875rem;
                            margin-top: -1.875rem;
                            height: 3.75rem;
                            width: 3.75rem;
                            border-radius: 50%;
                            background-position: center center;
                            background-size: 1.875rem 1.875rem;
                            background-repeat: no-repeat;
                            box-shadow: 0 0 1.25rem rgba(0,0,0,.06);
                            font-size: 38px;
                            color: #4ad44a;
                          ">✔</div>

                          <div class="dz-error-mark" style="
                            background-color: rgba(35,52,70,.5);
                            display: block;
                            position: absolute;
                            left: 50%;
                            top: 50%;
                            margin-left: -1.875rem;
                            margin-top: -1.875rem;
                            height: 3.75rem;
                            width: 3.75rem;
                            border-radius: 50%;
                            background-position: center center;
                            background-size: 1.875rem 1.875rem;
                            background-repeat: no-repeat;
                            box-shadow: 0 0 1.25rem rgba(0,0,0,.06);
                            font-size: 38px;
                            color: #ec4a4a;
                          ">✘</div>

                          <div class="dz-error-message" style="
                            background: rgba(255,62,29,.8);
                            border-top-left-radius: 0.375rem;
                            border-top-right-radius: 0.375rem;
                            position: absolute;
                            top: -1px;
                            left: -1px;
                            bottom: -1px;
                            right: -1px;
                            display: none;
                            color: #fff;
                            z-index: 40;
                            padding: 0.75rem;
                            text-align: left;
                            overflow: auto;
                            font-weight: 500;
                          ">
                            <span data-dz-errormessage></span>
                          </div>
                          
                          <div class="progress">
                            <div data-dz-uploadprogress class="progress-bar progress-bar-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                          </div>
                        </div>

                        <div data-dz-name class="dz-filename" style="
                          position: absolute;
                          overflow: hidden;
                          padding: 0.625rem 0.625rem 0 0.625rem;
                          background: #fff;
                          white-space: nowrap;
                          text-overflow: ellipsis;
                          width: -webkit-fill-available;
                        "></div>

                        <div data-dz-size class="dz-size" style="
                          color: #a1acb8;
                          padding: 1.875rem 0.625rem 0.625rem 0.625rem;
                          font-size: .6875rem;
                          font-style: italic;
                        ">
                          <strong></strong>
                        </div>

                      </div>

                      <a data-dz-remove class="dz-remove" href="javascript:undefined;" style="
                        color: #697a8d;
                        border-top: 1px solid #d9dee3;
                        border-bottom-right-radius: calc(0.375rem - 1px);
                        border-bottom-left-radius: calc(0.375rem - 1px);
                        display: block;
                        text-align: center;
                        padding: 0.375rem 0;
                        font-size: .75rem;
                      ">Remove file</a>
                      
                    </div>
                  </div>
                </div>
              </form>

              {{-- <div class="alert d-flex align-items-center bg-label-info mb-0" role="alert">
                <span class="badge badge-center rounded-pill bg-info border-label-info p-3 me-2"><i class="bx bx-info-circle bx-xs"></i></span>
                <div class="ps-1">
                  <span>  To send SMS updates, you need to install an SMS App.</span>
                </div>
              </div> --}}
          </div>
        </div>
      </div>
      <div class="col-4">
        <div class="card h-100">
          <div class="card-body row widget-separator">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


