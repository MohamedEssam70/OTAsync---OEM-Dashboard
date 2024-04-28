{{-- <div class="modal fade" id="statusModal" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Change Status</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col mb-3">
              <label for="status" class="form-label">Status</label>
              <select id="status" class="form-select" name="status">
                @foreach (\App\Enums\RegistryStatus::cases() as $value)
                  <option value="{{ $value }}">{{ $value->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="update-status">Save</button>
        </div>
      </div>
    </div>
</div>



<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRegistrySettings" aria-labelledby="offcanvasEndLabel">
  <div class="offcanvas-header">
    <h5 id="offcanvasEndLabel" class="offcanvas-title">Add Auditor</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body mx-0 flex-grow-0">
    <div class="row">
      @if (!empty($currentAuditors))
        @foreach ($currentAuditors as $currentAuditor)
          <div class="col-12 mb-3">
            <div class="input-group">
              <label class="form-control">{{ $currentAuditor->name }}</label>
              <input type="hidden" value="{{ $currentAuditor->id }}" class="c-aud">
              <button class="input-group-text remove-auditor" data-id="{{ $currentAuditor->id }}"><i class="bx bx-trash me-1"></i></button>
            </div>
          </div>
        @endforeach
      @endif
    </div>
    <div class="row">
      <div class="col-12 mb-3">
        <label for="auditors" class="form-label">Auditors</label>
        <select id="auditors" class="form-select" name="auditors">
          <option value="" selected>Select Auditor</option>
          @if(!empty($auditors))
            @foreach ($auditors as $auditor)
              <option value="{{ $auditor->id }}">{{ $auditor->name }}</option>
            @endforeach
          @endif
        </select>
      </div>
    </div>
    <button type="button" class="btn btn-primary mb-2 d-grid w-100" id="add-auditor">Add</button>
    <button type="button" class="btn btn-outline-secondary d-grid w-100" data-bs-dismiss="offcanvas">Cancel</button>
  </div>
</div> --}}