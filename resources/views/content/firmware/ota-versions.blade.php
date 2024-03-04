@extends('layouts/contentNavbarLayout',['navbarBreadcrumb' => true, 'navbarBreadcrumbPrev' => '', 'navbarBreadcrumbActive' => 'Upload Firmware', 'breadcrumbLink'=> route("home")])
@section('title', 'Upload firmware')
@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/upload-process.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/stepper/bs-stepper.min.css')}}">
@endsection
@section('content')
<div id="wizard-process" class="bs-stepper vertical mt-2 linear" data-select2-id="wizard-process">
  <div class="bs-stepper-header">
    <div class="step active" data-target="#deal-type">
      <button type="button" class="step-trigger" aria-selected="true">
        <span class="bs-stepper-circle">
          <i class="bx bx-purchase-tag"></i>
        </span>
        <span class="bs-stepper-label">
          <span class="bs-stepper-title">Deal Type</span>
          <span class="bs-stepper-subtitle">Choose type of deal</span>
        </span>
      </button>
    </div>
    <div class="line"></div>
    <div class="step" data-target="#deal-details">
      <button type="button" class="step-trigger" aria-selected="false" disabled="disabled">
        <span class="bs-stepper-circle">
          <i class="bx bx-detail"></i>
        </span>
        <span class="bs-stepper-label">
          <span class="bs-stepper-title">Deal Details</span>
          <span class="bs-stepper-subtitle">Provide deal details</span>
        </span>
      </button>
    </div>
    <div class="line"></div>
    <div class="step" data-target="#deal-usage">
      <button type="button" class="step-trigger" aria-selected="false" disabled="disabled">
        <span class="bs-stepper-circle">
          <i class="bx bx-credit-card"></i>
        </span>
        <span class="bs-stepper-label">
          <span class="bs-stepper-title">Deal Usage</span>
          <span class="bs-stepper-subtitle">Limitations &amp; Offers</span>
        </span>
      </button>
    </div>
    <div class="line"></div>
    <div class="step" data-target="#review-complete">
      <button type="button" class="step-trigger" aria-selected="false" disabled="disabled">
        <span class="bs-stepper-circle">
          <i class="bx bx-rocket"></i>
        </span>
        <span class="bs-stepper-label">
          <span class="bs-stepper-title">Review &amp; Complete</span>
          <span class="bs-stepper-subtitle">Launch a deal!</span>
        </span>
      </button>
    </div>
  </div>
  <div class="bs-stepper-content" data-select2-id="7">
    <form id="wizard-process-form" onsubmit="return false" data-select2-id="wizard-process-form">
      <!-- Deal Type -->
      <div id="deal-type" class="content dstepper-block fv-plugins-bootstrap5 fv-plugins-framework active" data-select2-id="deal-type">
        <div class="row g-3" data-select2-id="6">
          <div class="col-12">
            <img src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo/assets/img/illustrations/shopping-girl-light.png" class="img-fluid w-100 border rounded-2" alt="shopping girl" data-app-dark-img="illustrations/shopping-girl-dark.png" data-app-light-img="illustrations/shopping-girl-light.png">
          </div>
          <div class="col-12">
            <div class="row">
              <div class="col-md mb-md-0 mb-2">
                <div class="form-check custom-option custom-option-icon checked">
                  <label class="form-check-label custom-option-content" for="customRadioPercentage">
                    <span class="custom-option-body">
                      <i class="bx bx-purchase-tag"></i>
                      <span class="custom-option-title">Percentage</span>
                      <small>Create a deal which offer uses some % off (i.e 5% OFF) on total.</small>
                    </span>
                    <input name="customRadioIcon" class="form-check-input" type="radio" value="" id="customRadioPercentage" checked="">
                  </label>
                </div>
              </div>
              <div class="col-md mb-md-0 mb-2">
                <div class="form-check custom-option custom-option-icon">
                  <label class="form-check-label custom-option-content" for="customRadioFlat">
                    <span class="custom-option-body">
                      <i class="bx bx-dollar"></i>
                      <span class="custom-option-title"> Flat Amount </span>
                      <small>Create a deal which offer uses flat $ off (i.e $5 OFF) on the total.</small>
                    </span>
                    <input name="customRadioIcon" class="form-check-input" type="radio" value="" id="customRadioFlat">
                  </label>
                </div>
              </div>
              <div class="col-md mb-md-0 mb-2">
                <div class="form-check custom-option custom-option-icon">
                  <label class="form-check-label custom-option-content" for="customRadioPrime">
                    <span class="custom-option-body">
                      <i class="bx bx-user"></i>
                      <span class="custom-option-title"> Prime Member </span>
                      <small>Create prime member only deal to encourage the prime members.</small>
                    </span>
                    <input name="customRadioIcon" class="form-check-input" type="radio" value="" id="customRadioPrime">
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 fv-plugins-icon-container fv-plugins-bootstrap5-row-valid">
            <label class="form-label" for="dealAmount">Discount</label>
            <input type="number" name="dealAmount" id="dealAmount" class="form-control" placeholder="25" min="0" max="100" aria-describedby="dealAmountHelp">
            <div id="dealAmountHelp" class="form-text">Enter the discount percentage. 10 = 10%</div>
          <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
          <div class="col-sm-6 fv-plugins-icon-container fv-plugins-bootstrap5-row-valid" data-select2-id="5">
            <label class="form-label" for="dealRegion">Region</label>
            <div class="position-relative" data-select2-id="4"><select id="dealRegion" name="dealRegion" class="select2 form-select select2-hidden-accessible" multiple="" aria-describedby="dealRegionHelp" data-select2-id="dealRegion" tabindex="-1" aria-hidden="true">
              <option disabled="" value="" data-select2-id="15">Select targeted region</option>
              <option value="asia" data-select2-id="16">Asia</option>
              <option value="africa" data-select2-id="17">Africa</option>
              <option value="europe" data-select2-id="18">Europe</option>
              <option value="north america" data-select2-id="19">North America</option>
              <option value="south america" data-select2-id="20">South America</option>
              <option value="australia" data-select2-id="21">Australia</option>
            </select><span class="select2 select2-container select2-container--default select2-container--above" dir="ltr" data-select2-id="1" style="width: 427.6px;"><span class="selection"><span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-disabled="false"><ul class="select2-selection__rendered"><li class="select2-selection__choice" title="South America" data-select2-id="22"><span class="select2-selection__choice__remove" role="presentation">×</span>South America</li><li class="select2-search select2-search--inline"><input class="select2-search__field" type="search" tabindex="0" autocomplete="off" autocorrect="off" autocapitalize="none" spellcheck="false" role="searchbox" aria-autocomplete="list" placeholder="" style="width: 0.75em;"></li></ul></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span></div>
            <div id="dealRegionHelp" class="form-text">Select applicable regions for the deal.</div>
          <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
          <div class="col-12 d-flex justify-content-between">
            <button class="btn btn-label-secondary btn-prev" disabled=""> <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
              <span class="align-middle d-sm-inline-block d-none">Previous</span>
            </button>
            <button class="btn btn-primary btn-next">
              <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
              <i class="bx bx-chevron-right bx-sm me-sm-n2"></i>
            </button>
          </div>
        </div>
      </div>
      <!-- Deal Details -->
      <div id="deal-details" class="content fv-plugins-bootstrap5 fv-plugins-framework dstepper-block" data-select2-id="deal-details">
        <div class="row g-3" data-select2-id="27">
          <div class="col-sm-6 fv-plugins-icon-container fv-plugins-bootstrap5-row-valid">
            <label class="form-label" for="dealTitle">Deal Title</label>
            <input type="text" id="dealTitle" name="dealTitle" class="form-control" placeholder="Black friday sale, 25% off">
          <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
          <div class="col-sm-6 fv-plugins-icon-container fv-plugins-bootstrap5-row-valid">
            <label class="form-label" for="dealCode">Deal Code</label>
            <input type="text" id="dealCode" name="dealCode" class="form-control" placeholder="25PEROFF">
          <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
          <div class="col-sm-6">
            <label class="form-label" for="dealDescription">Deal Description</label>
            <textarea id="dealDescription" name="dealDescription" class="form-control" rows="5" placeholder="To sell or distribute something as a business deal"></textarea>
          </div>
          <div class="col-sm-6" data-select2-id="26">
            <div class="row">
              <div class="col-12 mb-3" data-select2-id="25">
                <label class="form-label" for="dealOfferedItem">Offered Items</label>
                <div class="position-relative" data-select2-id="24"><select class="select2 select2-hidden-accessible" id="dealOfferedItem" name="dealOfferedItem" multiple="" data-select2-id="dealOfferedItem" tabindex="-1" aria-hidden="true">
                  <option disabled="" value="" data-select2-id="28">Select offered item</option>
                  <option value="65328" data-select2-id="29">Apple iPhone 12 Pro Max (256GB)</option>
                  <option value="25612" data-select2-id="30">Apple iPhone 12 Pro (512GB)</option>
                  <option value="65454" data-select2-id="31">Apple iPhone 12 Mini (256GB)</option>
                  <option value="12365" data-select2-id="32">Apple iPhone 11 Pro Max (256GB)</option>
                  <option value="85466" data-select2-id="33">Apple iPhone 11 (64GB)</option>
                  <option value="98564" data-select2-id="34">OnePlus Nord CE 5G (128GB)</option>
                </select><span class="select2 select2-container select2-container--default select2-container--below" dir="ltr" data-select2-id="2" style="width: auto;"><span class="selection"><span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-disabled="false"><ul class="select2-selection__rendered"><li class="select2-selection__choice" title="Apple iPhone 12 Pro (512GB)" data-select2-id="35"><span class="select2-selection__choice__remove" role="presentation">×</span>Apple iPhone 12 Pro (512GB)</li><li class="select2-search select2-search--inline"><input class="select2-search__field" type="search" tabindex="0" autocomplete="off" autocorrect="off" autocapitalize="none" spellcheck="false" role="searchbox" aria-autocomplete="list" placeholder="" style="width: 0.75em;"></li></ul></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span></div>
              </div>
              <div class="col-12">
                <label class="form-label" for="dealCartCondition">Cart condition</label>
                <select class="form-select" id="dealCartCondition" name="dealCartCondition">
                  <option disabled="" value="">Select cart condition</option>
                  <option value="all">Cart must contain all selected Downloads</option>
                  <option value="any">Cart needs one or more of the selected Downloads</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-sm-6">
            <label for="dealDuration" class="form-label">Deal Duration</label>
            <input type="text" id="dealDuration" name="dealDuration" class="form-control flatpickr-input" placeholder="YYYY-MM-DD to YYYY-MM-DD" readonly="readonly">
          </div>
          <div class="col-sm-6">
            <label class="form-label">Notify Users</label>
            <div class="row">
              <div class="col mt-2">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="dealNotifyEmail" name="dealNotifyEmail" value="email">
                  <label class="form-check-label" for="dealNotifyEmail">Email</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="dealNotifySMS" name="dealNotifySMS" value="sms">
                  <label class="form-check-label" for="dealNotifySMS">SMS</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="dealNotifyPush" name="dealNotifyPush" value="push">
                  <label class="form-check-label" for="dealNotifyPush">Push Notification</label>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 d-flex justify-content-between">
            <button class="btn btn-primary btn-prev">
              <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
              <span class="align-middle d-sm-inline-block d-none">Previous</span>
            </button>
            <button class="btn btn-primary btn-next">
              <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
              <i class="bx bx-chevron-right bx-sm me-sm-n2"></i></button>
          </div>
        </div>
      </div>
      <!-- Deal Usage -->
      <div id="deal-usage" class="content fv-plugins-bootstrap5 fv-plugins-framework dstepper-block">
        <div class="row g-3">
          <div class="col-sm-6">
            <label class="form-label" for="dealUserType">User Type</label>
            <select id="dealUserType" name="dealUserType" class="form-select">
              <option selected="" disabled="" value="">Select user type</option>
              <option value="all">All</option>
              <option value="registered">Registered</option>
              <option value="unregistered">Unregistered</option>
              <option value="prime-members">Prime members</option>
            </select>
          </div>
          <div class="col-sm-6">
            <label class="form-label" for="dealMaxUsers">Max Users</label>
            <input type="number" id="dealMaxUsers" name="dealMaxUsers" class="form-control" placeholder="500">
          </div>
          <div class="col-sm-6">
            <label class="form-label" for="dealMinimumCartAmount">Minimum Cart Amount</label>
            <input type="number" id="dealMinimumCartAmount" name="dealMinimumCartAmount" class="form-control" placeholder="$99">
          </div>
          <div class="col-sm-6">
            <label class="form-label" for="dealPromotionalFee">Promotional Fee</label>
            <input type="number" id="dealPromotionalFee" name="dealPromotionalFee" class="form-control" placeholder="$9">
          </div>
          <div class="col-sm-6">
            <label class="form-label" for="dealPaymentMethod">Payment Method</label>
            <select id="dealPaymentMethod" name="dealPaymentMethod" class="form-select">
              <option selected="" disabled="" value="">Select payment method</option>
              <option value="any">Any</option>
              <option value="credit-card">Credit Card</option>
              <option value="net-banking">Net Banking</option>
              <option value="wallet">Wallet</option>
            </select>
          </div>
          <div class="col-sm-6">
            <label class="form-label" for="dealStatus">Deal Status</label>
            <select id="dealStatus" name="dealStatus" class="form-select">
              <option selected="" disabled="" value="">Select status</option>
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
              <option value="suspend">Suspend</option>
              <option value="abandon">Abandone</option>
            </select>
          </div>
          <div class="col-lg-12">
            <label class="switch">
              <input type="checkbox" class="switch-input" id="dealLimitUser" name="dealLimitUser">
              <span class="switch-toggle-slider">
                <span class="switch-on"></span>
                <span class="switch-off"></span>
              </span>
              <span class="switch-label"> Limit this discount to a single-use per customer?</span>
            </label>
          </div>
          <div class="col-12 d-flex justify-content-between">
            <button class="btn btn-primary btn-prev"> <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
              <span class="align-middle d-sm-inline-block d-none">Previous</span>
            </button>
            <button class="btn btn-primary btn-next"> <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span> <i class="bx bx-chevron-right bx-sm me-sm-n2"></i></button>
          </div>
        </div>
      </div>
      <!-- Review & Complete -->
      <div id="review-complete" class="content fv-plugins-bootstrap5 fv-plugins-framework dstepper-block">
        <div class="row g-3">

          <div class="col-lg-6">
            <div class="row">
              <div class="col-12 mb-0">
                <h3>Almost done! 🚀</h3>
                <p>Confirm your deal details information and submit to create it.</p>
              </div>
              <div class="col-12 mb-0">
                <table class="table table-borderless">
                  <tbody>
                    <tr>
                      <td class="ps-0 align-top text-nowrap py-1"><span class="fw-medium">Deal Type</span></td>
                      <td class="px-0 py-1">Percentage</td>
                    </tr>
                    <tr>
                      <td class="ps-0 align-top text-nowrap py-1"><span class="fw-medium">Amount</span></td>
                      <td class="px-0 py-1">25%</td>
                    </tr>
                    <tr>
                      <td class="ps-0 align-top text-nowrap py-1"><span class="fw-medium">Deal Code</span></td>
                      <td class="px-0 py-1">
                        <div class="badge bg-label-warning">25PEROFF</div>
                      </td>
                    </tr>
                    <tr>
                      <td class="ps-0 align-top text-nowrap py-1"><span class="fw-medium">Deal Title</span></td>
                      <td class="px-0 py-1">Black friday sale, 25% OFF</td>
                    </tr>
                    <tr>
                      <td class="ps-0 align-top text-nowrap py-1"><span class="fw-medium">Deal Duration</span></td>
                      <td class="px-0 py-1"><span class="fw-medium">2021-07-14</span> to <span class="fw-medium">2021-07-30</span></td>
                    </tr>
                  </tbody>
                </table>

              </div>
            </div>
          </div>
          <div class="col-lg-6 d-flex align-items-center justify-content-center">
            <img class="img-fluid w-px-200" src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo/assets/img/illustrations/man-with-laptop-light.png" alt="deal image cap" data-app-light-img="illustrations/man-with-laptop-light.png" data-app-dark-img="illustrations/man-with-laptop-dark.png">
          </div>
          <div class="col-md-12">
            <label class="switch">
              <input type="checkbox" class="switch-input" id="dealConfirmed" name="dealConfirmed">
              <span class="switch-toggle-slider">
                <span class="switch-on"></span>
                <span class="switch-off"></span>
              </span>
              <span class="switch-label"> I have confirmed the deal details.</span>
            </label>
          </div>
          <div class="col-12 d-flex justify-content-between">
            <button class="btn btn-primary btn-prev"> <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
              <span class="align-middle d-sm-inline-block d-none">Previous</span>
            </button>
            <button class="btn btn-success btn-submit btn-next">Submit</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection


@section('page-script')
<script src="{{ asset('assets/vendor/libs/stepper/bs-stepper.min.js') }}"></script>
@endsection
