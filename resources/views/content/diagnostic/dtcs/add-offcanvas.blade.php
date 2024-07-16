{{-- START ADD VEHICLE MODEL OFFCANVAS --}}
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvas_addDTC" aria-labelledby="offcanvasEndLabel">
  <div class="offcanvas-header">
    <h5 id="offcanvasEndLabel" class="offcanvas-title">Diagnostic Trouble Code</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body my-4 mx-0 flex-grow-0">
    <form id="addVehicleModel" method="POST" action="{{ route('dtc.add') }}"  enctype="multipart/form-data">
      @csrf
      <div class="row">
        <div class="col-12 mb-3">
          <label for="code" class="form-label">Code</label>
          <div class="input-group">
            <select id="DTC_type" class="form-select @error('type') is-invalid @enderror" name="type" aria-label="select code type" placeholder="Code Type">
              @foreach (\App\Enums\DTCsTypes::cases() as $value)
                  <option value="{{ $value }}">{{ $value }}</option>
              @endforeach
            </select>
            <input type="text" id="DTC_code" class="form-control @error('code') is-invalid @enderror" name="code" maxlength="4" placeholder="0000"/>
            {{-- oninput="this.value = this.value.replace(/\D+/g, '')" --}}
            @error('type')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
            @error('code')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
        </div>
        <div class="col-12 mb-3"> 
          <label for="system" class="form-label">System</label>
          <select id="DTC_system" class="form-select @error('system') is-invalid @enderror" name="system" aria-label="select system" placeholder="System">
            @foreach (\App\Enums\SystemsTypes::cases() as $value)
                <option value="{{ $value }}">{{ $value }}</option>
            @endforeach
          </select>
          @error('system')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        <div class="col-12 mb-3"> 
          <label for="manufactor" class="form-label">Manufactor</label>
          <select id="DTC_manufactor" class="form-select @error('manufactor') is-invalid @enderror" name="manufactor" aria-label="select manufactor" placeholder="Manufactor">
            @foreach (\App\Enums\Manufactors::cases() as $value)
                <option value="{{ $value }}">{{ $value }}</option>
            @endforeach
          </select>
          @error('manufactor')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        <div class="col-12 mb-3">
          <label for="description" class="form-label">Description</label>
          <input type="text" id="DTC_description" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="DTC description"/>
          @error('description')
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


