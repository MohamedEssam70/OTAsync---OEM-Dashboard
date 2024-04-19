@extends('layouts/contentNavbarLayout',['navbarBreadcrumb' => true, 'navbarBreadcrumbPrev' => '', 'navbarBreadcrumbActive' => 'Upload Firmware', 'breadcrumbLink'=> route("home")])
@section('title', 'Upload firmware')
@section('page-style')
<!-- Page -->
<link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/upload-process.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/stepper/bs-stepper.min.css')}}">
@endsection
@section('content')
<div class="row">
  <div id="wizard-process" class="bs-stepper wizard-icons wizard-icons-example mb-5">
    <div class="bs-stepper-header m-auto border-0 py-4">
      <div class="step active" data-target="#firmware-upload">
        <button type="button" class="step-trigger" aria-selected="false">
          <span class="bs-stepper-icon">
            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="0.8" d="M15 17h3a3 3 0 0 0 0-6s0 0 0 0v-.5A5.5 5.5 0 0 0 7.2 9H7a4 4 0 1 0 0 8h2.2m2.8 2v-9m0 0-2 2m2-2 2 2"/>
            </svg>
          </span>
          <span class="bs-stepper-label">UPLOAD</span>
        </button>
      </div>
      <div class="line">
        <i class="bx bx-chevron-right"></i>
      </div>
      <div class="step" data-target="#firmware-details">
        <button type="button" class="step-trigger" aria-selected="false">
          <span class="bs-stepper-icon">
            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="0.8" d="M10 11h2v5m-2 0h4m-2.6-8.5h0M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
            </svg>
          </span>
          <span class="bs-stepper-label">DETAILS</span>
        </button>
      </div>
      <div class="line">
        <i class="bx bx-chevron-right"></i>
      </div>
      <div class="step" data-target="#firmware-config">
        <button type="button" class="step-trigger" aria-selected="true">
          <span class="bs-stepper-icon">
            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="0.8" d="M21 13v-2a1 1 0 0 0-1-1h-.8l-.7-1.7.6-.5a1 1 0 0 0 0-1.5L17.7 5a1 1 0 0 0-1.5 0l-.5.6-1.7-.7V4a1 1 0 0 0-1-1h-2a1 1 0 0 0-1 1v.8l-1.7.7-.5-.6a1 1 0 0 0-1.5 0L5 6.3a1 1 0 0 0 0 1.5l.6.5-.7 1.7H4a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h.8l.7 1.7-.6.5a1 1 0 0 0 0 1.5L6.3 19a1 1 0 0 0 1.5 0l.5-.6 1.7.7v.8a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-.8l1.7-.7.5.6a1 1 0 0 0 1.5 0l1.4-1.4a1 1 0 0 0 0-1.5l-.6-.5.7-1.7h.8a1 1 0 0 0 1-1Z"/>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="0.8" d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
            </svg>
          </span>
          <span class="bs-stepper-label">CONFIGRATION</span>
        </button>
      </div>
      <div class="line">
        <i class="bx bx-chevron-right"></i>
      </div>
      <div class="step" data-target="#firmware-confirm">
        <button type="button" class="step-trigger" aria-selected="false">
          <span class="bs-stepper-icon">
            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="0.8" d="m8 12 2 2 5-5m4.5 5.3 1-.9a2 2 0 0 0 0-2.8l-1-.9a2 2 0 0 1-.6-1.4V7a2 2 0 0 0-2-2h-1.2a2 2 0 0 1-1.4-.5l-.9-1a2 2 0 0 0-2.8 0l-.9 1a2 2 0 0 1-1.4.6H7a2 2 0 0 0-2 2v1.2c0 .5-.2 1-.5 1.4l-1 .9a2 2 0 0 0 0 2.8l1 .9c.3.4.6.9.6 1.4V17a2 2 0 0 0 2 2h1.2c.5 0 1 .2 1.4.5l.9 1a2 2 0 0 0 2.8 0l.9-1a2 2 0 0 1 1.4-.6H17a2 2 0 0 0 2-2v-1.2c0-.5.2-1 .5-1.4Z"/>
            </svg>
          </span>
          <span class="bs-stepper-label">CONFIRMATION</span>
        </button>
      </div>
    </div>

    <div class="bs-stepper-content border-top">
      <form id="wizard-upload-form" onsubmit="return false">
        <!-- Upload firmware file -->
        <div id="firmware-upload" class="content fv-plugins-bootstrap5 fv-plugins-framework active dstepper-block" role="tabpanel" aria-labelledby="firmware-upload-trigger">
          <div class="row">
            <!-- Cart left -->
            <div class="col-xl-8 mb-3 mb-xl-0">
              <!-- Offer alert -->
              <div class="alert alert-success mb-3" role="alert">
                <div class="fw-medium fs-5 mb-2">Upload firmware file</div>
                <ul class="list-unstyled mb-0">
                  <li> Drag and drop file here or click to upload. </li>
                  <li> Be sure that your firmware file satisfy the requirements. </li>
                </ul>
                <button type="button" class="btn-close btn-pinned" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <!--Dropzone-->
              <div class="dropzone d-flex justify-content-center" id="myDropzone" data-field="dz" style="border: 2px dashed #d9dee3; overflow: hidden;">
                <input type="hidden" id="uploaded_file" name="firmwareFile" value="">
                <div class="dz-message needsclick" style="color: #566a7f; margin: 4.0rem 0; font-weight: 500; text-align: center; font-size: 1.625rem; width:100%; text-align:center;">
                  <img src="{{asset('assets/img/backgrounds/firmware-upload.png')}}" style="width: 100px;">
                  <span class="note needsclick mt-0" style="color: #697a8d; font-weight: 400; display: block; margin-top: 0.625rem; font-size: .9375rem;"><span class="fw-medium">UPLOAD FIRMWARE</span></span>
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
                          border-bottom-left-radius: 0;
                          border-bottom-right-radius: 0;
                          position: absolute;
                          top: -1px;
                          left: -1px;
                          bottom: -1px;
                          right: -1px;
                          color: #fff;
                          z-index: 40;
                          width: 100%;
                          text-align: left;
                          overflow: auto;
                          font-weight: 500;
                        ">
                          <span data-dz-errormessage id="dz-error-message"></span>
                        </div>
                        
                        <div class="progress">
                          <div data-dz-uploadprogress class="progress-bar progress-bar-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
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

            </div>
            <!-- Cart right -->
            <div class="col-xl-4">

              <!-- Details Side -->
              <div class="border rounded p-4 mb-3 pb-3">
                <!-- Gift wrap -->
                <div class="bg-lighter rounded p-3">
                  <p class="fw-medium mb-2">Buying gift for a loved one?</p>
                  <p class="mb-2">Gift wrap and personalized message on card, Only for $2.</p>
                  <a href="javascript:void(0)" class="fw-medium">Add a gift wrap</a>
                </div>
                <hr class="mx-n4">
                <!-- Price Details -->
                <h6>Firmware File</h6>
                <dl class="row mb-0">
                  <dt class="col-6 fw-normal">Max size</dt>
                  <dd class="col-6 text-end">150 KB</dd>
  
                  <dt class="col-sm-6 fw-normal">Extension</dt>
                  <dd class="col-sm-6 text-end">
                    <span class="badge bg-label-success ms-1">.bin</span>
                    <span class="badge bg-label-success ms-1">.HEX</span>
                    <span class="badge bg-label-success ms-1">.ELF</span>
                  </dd>  
                </dl>
  
              </div>

              <div class="d-grid">
                <button class="btn btn-primary btn-next" onclick="stepper.next()">Upload</button>
              </div>

            </div>
          </div>
        </div>
  
        <!-- Address -->
        <div id="firmware-details" class="content fv-plugins-bootstrap5 fv-plugins-framework" role="tabpanel" aria-labelledby="firmware-details-trigger">
          <div class="row">
            <!-- Address left -->
            <div class="col-xl-8  col-xxl-9 mb-3 mb-xl-0">
  
              
              <button type="button" class="btn btn-label-primary mb-4" data-bs-toggle="modal" data-bs-target="#addNewAddress">Add new address</button>
  
              <!-- Choose Delivery -->
              <p>Choose Delivery Speed</p>
              <div class="row mt-2">
                <div class="col-md mb-md-0 mb-2">
                  <div class="form-check custom-option custom-option-icon position-relative checked">
                    <label class="form-check-label custom-option-content" for="customRadioDelivery1">
                      <span class="custom-option-body">
                        <i class="bx bx-user bx-lg"></i>
                        <span class="custom-option-title mb-1">Standard</span>
                        <span class="badge bg-label-success btn-pinned">FREE</span>
                        <small>Get your product in 1 Week.</small>
                      </span>
                      <input name="customRadioIcon" class="form-check-input" type="radio" value="" id="customRadioDelivery1" checked="">
                    </label>
                  </div>
                </div>
                <div class="col-md mb-md-0 mb-2">
                  <div class="form-check custom-option custom-option-icon position-relative">
                    <label class="form-check-label custom-option-content" for="customRadioDelivery2">
                      <span class="custom-option-body">
                        <i class="bx bx-crown bx-lg"></i>
                        <span class="custom-option-title mb-1">Express</span>
                        <span class="badge bg-label-secondary btn-pinned">$10</span>
                        <small>Get your product in 3-4 days.</small>
                      </span>
                      <input name="customRadioIcon" class="form-check-input" type="radio" value="" id="customRadioDelivery2">
                    </label>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-check custom-option custom-option-icon position-relative">
                    <label class="form-check-label custom-option-content" for="customRadioDelivery3">
                      <span class="custom-option-body">
                        <i class="bx bxl-telegram bx-lg"></i>
                        <span class="custom-option-title mb-1">Overnight</span>
                        <span class="badge bg-label-secondary btn-pinned">$15</span>
                        <small>Get your product in 0-1 days.</small>
                      </span>
                      <input name="customRadioIcon" class="form-check-input" type="radio" value="" id="customRadioDelivery3">
                    </label>
                  </div>
                </div>
              </div>
            </div>
  
            <!-- Address right -->
            <div class="col-xl-4 col-xxl-3">
              <div class="border rounded p-4 pb-3 mb-3">
  
                <!-- Estimated Delivery -->
                <h6>Estimated Delivery Date</h6>
                <ul class="list-unstyled">
                  <li class="d-flex gap-3 align-items-center">
                    <div class="flex-shrink-0">
                      <img src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo/assets/img/products/1.png" alt="google home" class="w-px-50">
                    </div>
                    <div class="flex-grow-1">
                      <p class="mb-0"><a class="text-body" href="javascript:void(0)">Google - Google Home - White</a></p>
                      <p class="fw-medium">18th Nov 2021</p>
                    </div>
                  </li>
                  <li class="d-flex gap-3 align-items-center">
                    <div class="flex-shrink-0">
                      <img src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo/assets/img/products/2.png" alt="google home" class="w-px-50">
                    </div>
                    <div class="flex-grow-1">
                      <p class="mb-0"><a class="text-body" href="javascript:void(0)">Apple iPhone 11 (64GB, Black)</a></p>
                      <p class="fw-medium">20th Nov 2021</p>
                    </div>
                  </li>
                </ul>
  
                <hr class="mx-n4">
  
                <!-- Price Details -->
                <h6>Price Details</h6>
                <dl class="row mb-0">
  
                  <dt class="col-6 fw-normal">Order Total</dt>
                  <dd class="col-6 text-end">$1198.00</dd>
  
                  <dt class="col-6 fw-normal">Delivery Charges</dt>
                  <dd class="col-6 text-end"><s class="text-muted">$5.00</s> <span class="badge bg-label-success ms-1">Free</span></dd>
  
                </dl>
                <hr class="mx-n4">
                <dl class="row mb-0">
                  <dt class="col-6">Total</dt>
                  <dd class="col-6 fw-medium text-end mb-0">$1198.00</dd>
                </dl>
              </div>
              <div class="d-grid">
                <button class="btn btn-primary btn-next" onclick="stepper.next()">Place Order</button>
              </div>
            </div>
          </div>
        </div>
  
        <!-- Configrations -->
        <div id="firmware-config" class="content fv-plugins-bootstrap5 fv-plugins-framework" role="tabpanel" aria-labelledby="firmware-config-trigger">
          <div class="row">
            <!-- left -->
            <div class="col-xl-8 col-xxl-9 mb-3 mb-xl-0">
              <div class="row mb-3">
                <div class="col-xxl">
                  <label class="form-label" for="name">Firmware</label>
                  <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="col-xxl">
                  <label class="form-label" for="version">Version</label>
                  <input type="text" class="form-control" id="version" name="version">
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-xxl">
                  <label for="status" class="form-label">Status</label>
                  <select class="form-select" id="status" name="status">
                    <option value="Beta" selected>Beta</option>
                    <option value="Valid">Valid</option>
                  </select>
                </div>
                <div class="col-xxl">
                  <label class="form-check form-switch mb-3">
                    <span class="switch-label">Schedule the update?</span>
                    <input class="form-check-input" type="checkbox" id="schedule" name="schedule">
                    <input class="form-check-input" type="hidden" id="schedule_hidden" name="schedule" value="off">
                  </label>
                  <input class="form-control mb-3" type="datetime-local" name="upgradeDate" value="" id="upgradeDate" disabled>
                </div>
              </div>
              <!-- Select address -->
              <p>Select priority level of the update</p>
              <div class="row mb-3">
                <div class="col-md mb-md-0 mb-2">
                  <div class="form-check custom-option custom-option-icon checked">
                    <label class="form-check-label custom-option-content d-flex align-items-start justify-content-start" for="basicPlanMain2">
                      <input class="form-check-input" type="radio" name="priority" value=false id="basicPlanMain2" checked autofocus />
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
                <div class="col-md">
                  <div class="form-check custom-option custom-option-icon">
                    <label class="form-check-label custom-option-content d-flex align-items-start justify-content-start" for="basicPlanMain1">
                      <input class="form-check-input" type="radio" name="priority" value=true id="basicPlanMain1">
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
              </div>

              
  
            </div>
            <!-- Address right -->
            <div class="col-xl-4 col-xxl-3">
              <div class="border rounded p-4">
  
                <!-- Price Details -->
                <h6>Price Details</h6>
                <dl class="row">
  
                  <dt class="col-6 fw-normal">Order Total</dt>
                  <dd class="col-6 text-end">$1198.00</dd>
  
                  <dt class="col-6 fw-normal">Delivery Charges</dt>
                  <dd class="col-6 text-end"><s class="text-muted">$5.00</s> <span class="badge bg-label-success ms-1">Free</span></dd>
                </dl>
                <hr class="mx-n4">
                <dl class="row">
                  <dt class="col-6 mb-3">Total</dt>
                  <dd class="col-6 fw-medium text-end mb-0">$1198.00</dd>
  
                  <dt class="col-6 fw-normal">Deliver to:</dt>
                  <dd class="col-6 fw-medium text-end mb-0"><span class="badge bg-label-primary">Home</span></dd>
                </dl>
                <!-- Address Details -->
                <address class="text-heading">
                  <span> John Doe (Default),</span>
                  4135 Parkway Street,
                  Los Angeles, CA, 90017.<br>
                  Mobile : +1 906 568 2332
                </address>
                <a href="javascript:void(0)">Change address</a>
              </div>
            </div>
          </div>
        </div>
  
        <!-- Confirmation -->
        <div id="firmware-confirm" class="content fv-plugins-bootstrap5 fv-plugins-framework" role="tabpanel" aria-labelledby="firmware-confirm-trigger">
          <div class="row mb-3">
            <div class="col-12 col-lg-8 mx-auto text-center mb-3">
              <h4 class="mt-2">Thank You! 😇</h4>
              <p>Your order <a href="javascript:void(0)">#1536548131</a> has been placed!</p>
              <p>We sent an email to <a href="mailto:john.doe@example.com">john.doe@example.com</a> with your order confirmation and receipt. If the email hasn't arrived within two minutes, please check your spam folder to see if the email was routed there.</p>
              <p><span class="fw-medium"><i class="bx bx-time-five me-1"></i> Time placed:&nbsp;</span> 25/05/2020 13:35pm</p>
            </div>
            <!-- Confirmation details -->
            <div class="col-12">
              <ul class="list-group list-group-horizontal-md">
                <li class="list-group-item flex-fill p-4 text-heading">
                  <h6 class="d-flex align-items-center gap-1"><i class="bx bx-map"></i> Shipping</h6>
                  <address class="mb-0">
                    John Doe <br>
                    4135 Parkway Street,<br>
                    Los Angeles, CA 90017,<br>
                    USA
                  </address>
                  <p class="mb-0 mt-3">
                    +123456789
                  </p>
                </li>
                <li class="list-group-item flex-fill p-4 text-heading">
                  <h6 class="d-flex align-items-center gap-1"><i class="bx bx-credit-card"></i> Billing Address</h6>
                  <address class="mb-0">
                    John Doe <br>
                    4135 Parkway Street,<br>
                    Los Angeles, CA 90017,<br>
                    USA
                  </address>
                  <p class="mb-0 mt-3">
                    +123456789
                  </p>
                </li>
                <li class="list-group-item flex-fill p-4 text-heading">
                  <h6 class="d-flex align-items-center gap-1"><i class="bx bxs-ship"></i> Shipping Method</h6>
                  <p class="fw-medium mb-3">Preferred Method:</p>
                  Standard Delivery<br>
                  (Normally 3-4 business days)
                </li>
              </ul>
            </div>
          </div>
  
          <div class="row">
            <!-- Confirmation items -->
            <div class="col-xl-9 mb-3 mb-xl-0">
              <ul class="list-group">
                <li class="list-group-item p-4">
                  <div class="d-flex gap-3">
                    <div class="flex-shrink-0">
                      <img src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo/assets/img/products/1.png" alt="google home" class="w-px-75">
                    </div>
                    <div class="flex-grow-1">
                      <div class="row">
                        <div class="col-md-8">
                          <a href="javascript:void(0)" class="text-body">
                            <p>Google - Google Home - White</p>
                          </a>
                          <div class="text-muted mb-1 d-flex flex-wrap"><span class="me-1">Sold by:</span> <a href="javascript:void(0)" class="me-3">Apple</a> <span class="badge bg-label-success">In Stock</span></div>
                        </div>
                        <div class="col-md-4">
                          <div class="text-md-end">
                            <div class="my-2 my-lg-4"><span class="text-primary">$299/</span><s class="text-muted">$359</s></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="list-group-item p-4">
                  <div class="d-flex gap-3">
                    <div class="flex-shrink-0">
                      <img src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo/assets/img/products/2.png" alt="google home" class="w-px-75">
                    </div>
                    <div class="flex-grow-1">
                      <div class="row">
                        <div class="col-md-8">
                          <a href="javascript:void(0)" class="text-body">
                            <p>Apple iPhone 11 (64GB, Black)</p>
                          </a>
                          <div class="text-muted mb-1 d-flex flex-wrap"><span class="me-1">Sold by:</span> <a href="javascript:void(0)" class="me-3">Apple</a> <span class="badge bg-label-success">In Stock</span></div>
                        </div>
                        <div class="col-md-4">
                          <div class="text-md-end">
                            <div class="my-2 my-lg-4"><span class="text-primary">$299/</span><s class="text-muted">$359</s></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
            <!-- Confirmation total -->
            <div class="col-xl-3">
              <div class="border rounded p-4 pb-3">
                <!-- Price Details -->
                <h6>Price Details</h6>
                <dl class="row mb-0">
  
                  <dt class="col-6 fw-normal">Order Total</dt>
                  <dd class="col-6 text-end">$1198.00</dd>
  
                  <dt class="col-sm-6 fw-normal">Delivery Charges</dt>
                  <dd class="col-sm-6 text-end"><s class="text-muted">$5.00</s> <span class="badge bg-label-success ms-1">Free</span></dd>
                </dl>
                <hr class="mx-n4">
                <dl class="row mb-0">
                  <dt class="col-6">Total</dt>
                  <dd class="col-6 fw-medium text-end mb-0">$1198.00</dd>
                </dl>
              </div>
            </div>
          </div>

        </div>
      </form>
    </div>
  </div>
</div>
@endsection


@section('page-script')
<script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.js" type="text/javascript"></script>
<script src="{{ asset('assets/vendor/libs/stepper/bs-stepper.min.js') }}"></script>
<script src="{{asset('assets/js/dropzone.js')}}"></script>
<script>
  var stepperNode = document.getElementById('wizard-process')
  var stepperElement = $('.bs-stepper')[0]
  console.log(stepperElement);
  var stepper = new Stepper(stepperElement,{
    
  })

  stepperNode.addEventListener('show.bs-stepper', function (event) {
  var index = event.detail.indexStep;
  var numberOfSteps = document.querySelectorAll('#wizard-process .step').length;
  var step = document.getElementsByClassName('step');
    for (i = 0; i < index; i++) {
      step[i].classList.add("crossed");

      for (j = index; j < numberOfSteps; j++) {
        step[j].classList.remove("crossed");
      }
    }
    if (event.detail.to == 0) {
      for (k = index; k < numberOfSteps; k++) {
        step[k].classList.remove("crossed");
      }
      step[0].classList.remove("crossed");
    }
  });

  $(document).ready(function() {

  /*
   * Disable/Enable Schedule Scection
   */
  $('#schedule').click(function() {
      if($(this).is(':checked'))
      {
          $('#scheduleDate').removeClass("disable-sec");  // checked
          $('#upgradeDate').prop("disabled", false);
          $('#schedule_hidden').prop("disabled", true);
      }
      else
      {
          $('#scheduleDate').addClass("disable-sec");  // unchecked
          $('#upgradeDate').prop("disabled", true);
          $('#schedule_hidden').prop("disabled", false);
      }
  });

  /*
   * Post  Handler
   */
  
  });
</script>
@endsection
