{{-- START ADD VEHICLE MODEL OFFCANVAS --}}
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvas_addVehicleModel" aria-labelledby="offcanvasEndLabel">
  <div class="offcanvas-header">
    <h5 id="offcanvasEndLabel" class="offcanvas-title">Add Vehicle Model</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body my-4 mx-0 flex-grow-0">
    <form id="addVehicleModel" method="POST" action="{{ route('model.add') }}"  enctype="multipart/form-data">
      @csrf
      <div class="row">
        <div class="col-12 mb-3">
          <label for="name" class="form-label">Model Name</label>
          <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="XX0X-00000-XX" autofocus/>
          @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        <div class="col-12 mb-3">
          <label for="serial" class="form-label">Serial Number</label>
          <input type="text" id="serial" class="form-control @error('serial') is-invalid @enderror" name="serial" placeholder="X00000XXX"/>
          @error('serial')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
      </div>
      <button type="submit" class="btn btn-primary mb-2 d-grid w-100">Add</button>
      <button type="button" class="btn btn-outline-secondary d-grid w-100" data-bs-dismiss="offcanvas">Cancel</button>
    </form>
  </div>
</div>
{{-- END ADD ECU OFFCANVAS --}}


