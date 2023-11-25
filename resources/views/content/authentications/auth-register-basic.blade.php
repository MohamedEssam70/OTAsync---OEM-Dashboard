@extends('layouts/blankLayout')

@section('title', 'Register Basic - Pages')

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection


@section('content')
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y" style="padding-right: 0 !important">
    <div class="authentication-inner" style="max-width: 800px !important">
      <!-- Register Card -->
      <div class="card">
        <div class="card-body">
          <!-- Logo -->
          <div class="app-brand justify-content-center">
            {{-- <a href="{{url('/')}}" class="app-brand-link gap-2">
              <img class="app-brand-logo" src="{{asset('assets/img/favicon/logo-txt.png')}}">
            </a> --}}
            <h2 class="mb-3">Request <a href="{{url('/')}}" class="app-brand-link gap-2" style="display: inline;"><img src="{{asset('assets/img/favicon/logo-txt.png')}}" style="width: 100px; height: auto; padding-bottom:1px;"></a> account</h2>
          </div>
          <!-- /Logo -->
          {{-- <h4 class="mb-3">Request <img src="{{asset('assets/img/favicon/logo-txt.png')}}" style="width: 80px; height: auto; padding-bottom:3px;"> account</h4> --}}
          <form id="formAuthentication" class="mb-3" action="{{url('/')}}" method="GET">
            <div class="row">
              <div class="mb-3 col-md-6">
                <label for="firstname" class="form-label">First Name</label>
                <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter your first name">
              </div>
              <div class="mb-3 col-md-6">
                <label for="lastname" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter your last name">
              </div>
                
              <div class="mb-3 col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email">
              </div>
    
              <div class="mb-3 col-md-6">
                <label for="organization" class="form-label">Organization</label>
                <input type="text" class="form-control" id="organization" name="organization" placeholder="Organization name">
              </div>
    
              <div class="mb-3 col-md-6">
                <label class="form-label" for="phoneNumber">Phone Number</label>
                <div class="input-group input-group-merge">
                  <select class="form-select input-group-text" id="bs-validation-country" required="">
                    <option value="20">Egypt (+20)</option>
                    <option value="970">Gaza (+970) </option>
                    <option value="1">US (+1)</option>
                    <option value="34">Spain (+34)</option>
                  </select>
                  <input type="text" id="phoneNumber" name="phoneNumber" class="form-control input-group-text" placeholder="Enter your phone" maxlength="10">
                </div>
              </div>

              <div class="mb-3 col-md-6" style="display: flex; align-items:flex-end;">
                <div class="flex-grow-1 row">
                  <div class="col-9 mb-sm-0 mb-2">
                    <h6 class="mb-0">Contact me on phone</h6>
                    <small class="text-muted">Disable to communicate via mail only</small>
                  </div>
                  <div class="col-3 text-end">
                    <div class="form-check form-switch">
                      <input class="form-check-input float-end" type="checkbox" role="switch" checked="">
                    </div>
                  </div>
                </div>
              </div>

              <label class="form-label" for="basicPlanMain">Plan</label>
              <div class="mb-3 col-md-6">
                <div class="form-check custom-option custom-option-icon">
                  <label class="form-check-label custom-option-content" for="basicPlanMain1">
                    <span class="custom-option-body">
                      <i class="bx bx-user"></i>
                      <span class="custom-option-title">  Personal  </span>
                      <small> Personal Plan for individual, personalized and efficient experience </small>
                    </span>
                    <input name="formValidationPlan" class="form-check-input" type="radio" value="" id="basicPlanMain1">
                  </label>
                </div>
              </div>
              <div class="mb-3 col-md-6">
                <div class="form-check custom-option custom-option-icon">
                  <label class="form-check-label custom-option-content" for="basicPlanMain2">
                    <span class="custom-option-body">
                      <i class="bx bx-group"></i>
                      <span class="custom-option-title"> Teams </span>
                      <small> Elevate your team's collaboration and productivity with our Teams Plan </small>
                    </span>
                    <input name="formValidationPlan" class="form-check-input" type="radio" value="" id="basicPlanMain2">
                  </label>
                </div>
              </div>
            </div>
            <button class="btn btn-primary d-grid w-20">
              Send
            </button>
          </form>

          <p>
            <span>Already have an account?</span>
            <a href="{{url('auth/login-basic')}}">
              <span>Sign in instead</span>
            </a>
          </p>

        </div>
      </div>
      <!-- Register Card -->
    </div>
  </div>
</div>
@endsection
