{{-- START TEMPLATE OFFCANVAS --}}
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasDefult" aria-labelledby="offcanvasEndLabel">
  <div class="offcanvas-header">
    <h5 id="offcanvasEndLabel" class="offcanvas-title">Offcanvas End</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body my-auto mx-0 flex-grow-0">
    <p class="text-center">Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.</p>
    <button type="button" class="btn btn-primary mb-2 d-grid w-100">Continue</button>
    <button type="button" class="btn btn-outline-secondary d-grid w-100" data-bs-dismiss="offcanvas">Cancel</button>
  </div>
</div>
{{-- END TEMPLATE OFFCANVAS --}}

{{-- START ADD MODEL OFFCANVAS --}}
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddModel" aria-labelledby="offcanvasEndLabel">
  <div class="offcanvas-header">
    <h5 id="offcanvasEndLabel" class="offcanvas-title">Add Model</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body my-auto mx-0 flex-grow-0">
    <form id="formAddModel" method="POST" action="{{ route('setup.insert', ['target' => 'model']) }}"  enctype="multipart/form-data">
      @csrf
      <div class="row">
        <div class="col-12 mb-3">
          <label for="name" class="form-label">Model Name</label>
          <input type="text" id="modelname" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Enter Model Name" autofocus/>
          @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        <div class="col-12 mb-3">
          <label for="serial" class="form-label">Serial</label>
          <input type="text" id="modelserial" class="form-control @error('serial') is-invalid @enderror" name="serial" placeholder="Enter Model Serial"/>
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
{{-- END ADD MODEL OFFCANVAS --}}

{{-- START ADD ECU OFFCANVAS --}}
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddECU" aria-labelledby="offcanvasEndLabel">
  <div class="offcanvas-header">
    <h5 id="offcanvasEndLabel" class="offcanvas-title">Add ECU</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body my-auto mx-0 flex-grow-0">
    <form id="formAddECU" method="POST" action="{{ route('setup.insert', ['target' => 'ecu']) }}"  enctype="multipart/form-data">
      @csrf
      <div class="row">
        <div class="col-12 mb-3">
          <label for="name" class="form-label">ECU</label>
          <input type="text" id="ecuname" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="ECU" autofocus/>
          @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        <div class="col-12 mb-3">
          <label for="app" class="form-label">Application</label>
          <input type="text" id="app" class="form-control @error('app') is-invalid @enderror" name="app" placeholder="Application For the ECU"/>
          @error('app')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        <div class="col-12 mb-3">
          <label for="mac_models_id" class="form-label">Application</label>
          <select id="mac_models_id" class="form-select @error('mac_models_id') is-invalid @enderror" name="mac_models_id">
            @foreach ($models as $model)
            <option value="{{$model->id}}">{{$model->name}}</option>
            @endforeach
          </select>
          @error('mac_models_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        <div class="col-12 mb-3">
          <label for="controller" class="form-label">Controller</label>
          <input type="text" id="controller" class="form-control @error('controller') is-invalid @enderror" name="controller" placeholder="Enter Controller Name"/>
          @error('controller')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        <div class="col-12 mb-3">
          <label for="software_version" class="form-label">Firmware Version</label>
          <input type="text" id="software_version" class="form-control @error('software_version') is-invalid @enderror" name="software_version" placeholder="Current Firmware Version"/>
          @error('software_version')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        <div class="col-12 mb-3">
          <label for="manufactor_hw_number" class="form-label">Manufactor Hardware Number</label>
          <input type="text" id="manufactor_hw_number" class="form-control @error('manufactor_hw_number') is-invalid @enderror" name="manufactor_hw_number" placeholder="Enter the Supplayer HW Number"/>
          @error('manufactor_hw_number')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        <div class="col-12 mb-3">
          <label for="serial" class="form-label">Serial</label>
          <input type="text" id="ecuserial" class="form-control @error('serial') is-invalid @enderror" name="serial" placeholder="Enter ECU Serial Number"/>
          @error('serial')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        <div class="col-12 mb-3">
          <label for="vin" class="form-label">VIN</label>
          <input type="text" id="vin" class="form-control @error('vin') is-invalid @enderror" name="vin" placeholder="Enter Model Serial"/>
          @error('vin')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        <div class="col-12 mb-3">
          <label for="flash_size" class="form-label">Flash Size</label>
          <input type="text" id="flash_size" class="form-control @error('flash_size') is-invalid @enderror" name="flash_size" placeholder="Enter Flash Size in KB"/>
          @error('flash_size')
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


