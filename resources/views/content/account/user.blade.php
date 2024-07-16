@extends('layouts/contentNavbarLayout',['navbarBreadcrumbPrev' => 'Account /', 'navbarBreadcrumbActive' => 'My Profile'])

@section('title', 'My Profile')

@section('page-script')
<script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
@endsection

@section('content')

@include('content.account.tabs', ['activeTab' => 0])

<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <h5 class="card-header">Profile Details</h5>
      <!-- Profile -->
      <form id="formAccountSettings" method="POST" action="{{route('profile.update')}}"  enctype="multipart/form-data">
        @csrf
        <div class="card-body">
          <div class="d-flex align-items-start align-items-sm-center gap-4">
            <img src="{{$user->avatar}}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
            <div class="button-wrapper">
              <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                <span class="d-none d-sm-block">Upload new photo</span>
                <i class="bx bx-upload d-block d-sm-none"></i>
                <input type="file" name="avatar" id="upload" class="account-file-input" hidden accept="image/png, image/jpeg" />
              </label>
              <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                <i class="bx bx-reset d-block d-sm-none"></i>
                <span class="d-none d-sm-block">Reset</span>
              </button>

              <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
            </div>
          </div>
        </div>
        <hr class="my-0">
        <div class="card-body">
          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="firstname" class="form-label">First Name</label>
              <input class="form-control @error('firstname') is-invalid @enderror" type="text" id="firstname" name="firstname" value="{{$user->firstname}}" autofocus />
              @error('firstname')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            <div class="mb-3 col-md-6">
              <label for="lastname" class="form-label">Last Name</label>
              <input class="form-control @error('lastname') is-invalid @enderror" type="text" name="lastname" id="lastname" value="{{$user->lastname}}" />
              @error('lastname')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            <div class="mb-3 col-md-6">
              <label for="email" class="form-label">E-mail</label>
              <input class="form-control @error('email') is-invalid @enderror" type="text" id="email" name="email" value="{{$user->email}}" placeholder="john.doe@example.com" />
              @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            <div class="mb-3 col-md-6">
              <label for="org" class="form-label">Organization</label>
              <input type="text" class="form-control @error('org') is-invalid @enderror" id="org" name="org" value="{{$user->org}}" />
              @error('org')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label" for="phone">Phone Number</label>
              <div class="input-group input-group-merge">
                <span id="phone-code" class="input-group-text">{{Str::upper($countries->where('name', $user->country)->first()->name).' (+'.$countries->where('name', $user->country)->first()->code.')'}}</span>
                <input type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{$user->phone}}" />
                @error('phone')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
              </div>
            </div>
            <div class="mb-3 col-md-6">
              <label for="address" class="form-label">Address</label>
              <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{$user->address}}" />
              @error('address')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            <div class="mb-3 col-md-6">
              <label for="city" class="form-label">City</label>
              <input class="form-control @error('city') is-invalid @enderror" type="text" id="city" name="city" value="{{$user->city}}" />
              @error('city')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            <div class="mb-3 col-md-6">
              <label for="zip" class="form-label">Zip Code</label>
              <input type="text" class="form-control @error('zip') is-invalid @enderror" id="zip" name="zip" value="{{$user->zip}}" maxlength="6" />
              @error('zip')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label" for="country">Country</label>
              <select class="select2 form-select @error('country') is-invalid @enderror" id="country" name="country">
                @foreach ($countries as $country)
                  <option value="{{ $country->id }}" data-code="{{ $country->code }}" @if($user->country==$country->id) selected @endif>{{ $country->name }}</option>
                @endforeach
              </select>
              @error('country')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
              @enderror
              </div>
            <div class="mb-3 col-md-6">
              <label for="lang" class="form-label">Language</label>
              {!! Form::select(
                "lang",
                [
                  "en" => "English",
                  "ar" => "Arabic",
                ],
                $user->lang,
                ['class' => "select2 form-select"]
              ) !!}
              @error('lang')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
          <div class="mt-2">
            <button type="submit" class="btn btn-primary me-2">Save changes</button>
            <button type="reset" class="btn btn-outline-secondary">Cancel</button>
          </div>
        </div>
      </form>
      <!-- /Profile -->
    </div>
    {{-- <div class="card">
      <h5 class="card-header">Delete Account</h5>
      <div class="card-body">
        <div class="mb-3 col-12 mb-0">
          <div class="alert alert-warning">
            <h6 class="alert-heading fw-medium mb-1">Are you sure you want to delete your account?</h6>
            <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
          </div>
        </div>
        <form id="formAccountDeactivation" onsubmit="return false">
          <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="accountActivation" id="accountActivation" />
            <label class="form-check-label" for="accountActivation">I confirm my account deactivation</label>
          </div>
          <button type="submit" class="btn btn-danger deactivate-account">Deactivate Account</button>
        </form>
      </div>
    </div> --}}
  </div>
</div>
@endsection
