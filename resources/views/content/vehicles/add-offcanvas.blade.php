{{-- START ADD VEHICLE MODEL OFFCANVAS --}}
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvas_addVehicle" aria-labelledby="offcanvasEndLabel">
  <div class="offcanvas-header">
    <h5 id="offcanvasEndLabel" class="offcanvas-title">Add Vehicle</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body my-4 mx-0 flex-grow-0">
    <form id="addVehicleModel" method="POST" action="{{ route('vehicle.add', $model_id) }}"  enctype="multipart/form-data">
      @csrf
      <div class="row">
        <div class="col-12 mb-3">
          <label for="pin" class="form-label">PIN Number</label>
          <input type="text" id="pin" class="form-control @error('pin') is-invalid @enderror" name="pin" placeholder="0000" autofocus/>
          @error('pin')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        <div class="col-12 mb-3">
          <label for="vin" class="form-label">VIN Number</label>
          <input type="text" id="vin" class="form-control @error('vin') is-invalid @enderror" name="vin" placeholder="0X0XXXX00X0000000"/>
          @error('vin')
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


