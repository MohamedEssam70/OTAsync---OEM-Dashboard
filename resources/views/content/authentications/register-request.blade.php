@extends('layouts/blankLayout')

@section('title', 'Register Request')

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
          <form id="formAuthentication" class="mb-3" method="POST" action="{{ route('request-acc') }}">
            @csrf

            <div class="row">
              <div class="mb-3 col-md-6">
                <label for="first-name" class="form-label">{{ __('First Name') }}</label>

                <div class="col-12">
                    <input id="first-name" type="text" class="form-control @error('first-name') is-invalid @enderror" placeholder="Enter your first name" name="first-name" value="{{ old('first-name') }}" required autocomplete="first-name" autofocus>

                    @error('first-name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
              </div>
              <div class="mb-3 col-md-6">
                <label for="last-name" class="form-label">{{ __('Last Name') }}</label>

                <div class="col-12">
                    <input id="last-name" type="text" class="form-control @error('last-name') is-invalid @enderror" placeholder="Enter your last name" name="last-name" value="{{ old('last-name') }}" required autocomplete="last-name" autofocus>

                    @error('last-name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
              </div>
                
              <div class="mb-3 col-md-6">
                <label for="email" class="form-label">{{ __('Email Address') }}</label>

                <div class="col-12">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter your email" name="email" value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
              </div>
    
              <div class="mb-3 col-md-6">
                <label for="organization" class="form-label">{{ __('Organization') }}</label>

                <div class="col-12">
                    <input id="organization" type="text" class="form-control @error('organization') is-invalid @enderror" placeholder="Organization name" name="organization" value="{{ old('organization') }}" required autocomplete="organization" autofocus>

                    @error('organization')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
              </div>
    
              <div class="mb-3 col-md-6">
                <label class="form-label" for="phone">Phone Number</label>
                <div class="input-group input-group-merge">
                  <select class="form-select input-group-text" id="bs-validation-country" required="">
                    <option value="20">Egypt (+20)</option>
                    <option value="970">Gaza (+970) </option>
                    <option value="1">US (+1)</option>
                    <option value="34">Spain (+34)</option>
                  </select>
                  <input type="text" id="phone" name="phone" class="form-control input-group-text" placeholder="Enter your phone" maxlength="10">
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
                      <input class="form-check-input float-end" name="phone-contact" type="checkbox" role="switch" checked="">
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
                    <input name="plan" class="form-check-input" type="radio" value="" id="basicPlanMain1">
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
                    <input name="plan" class="form-check-input" type="radio" value="" id="basicPlanMain2">
                  </label>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-primary d-grid w-20">
              {{ __('Send') }}
            </button>
          </form>

          <p>
            <span>Already have an account?</span>
            <a href="{{ route('login') }}">
              <span>{{ __('Sign in instead') }}</span>
            </a>
          </p>

        </div>
      </div>
      <!-- Register Card -->
    </div>
  </div>
</div>
@endsection
