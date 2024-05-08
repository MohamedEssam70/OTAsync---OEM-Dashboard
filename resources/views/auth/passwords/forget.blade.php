@extends('layouts/blankLayout')

@section('title', 'Forgot Password')

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('content')
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner py-4">

      <!-- Forgot Password -->
      <div class="card">
        <div class="card-body">
          <!-- Logo -->
          <div class="app-brand justify-content-center">
            <a href="{{url('/')}}" class="app-brand-link gap-2">
              <img class="app-brand-logo" src="{{asset('assets/img/favicon/logo-txt.png')}}">
            </a>
          </div>
          <!-- /Logo -->
          <h4 class="mb-2">Forgot Password? 🔒</h4>
          <p class="mb-4">Enter your email and we'll send you instructions to reset your password</p>

          @if (session('status'))
              <div class="alert alert-success" role="alert">
                  {{ session('status') }}
              </div>
          @endif

          <form id="formAuthentication" class="mb-3" method="POST" action="{{ route('password.email') }}">
            @csrf
            
            <div class="mb-3">
              <label for="email" class="form-label">{{ __('Email Address') }}</label>
              <div class="col-12">
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter your email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                  @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
            </div>
            <button type="submit" class="btn btn-primary d-grid w-100">
              {{ __('Send Reset Link') }}
            </button>
          </form>
          <div class="text-center">
            <a href="{{ route("login") }}" class="d-flex align-items-center justify-content-center">
              <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
              Back to login
            </a>
          </div>
        </div>
      </div>
      <!-- /Forgot Password -->
    </div>
  </div>
</div>
@endsection
