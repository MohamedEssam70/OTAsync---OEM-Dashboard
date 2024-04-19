<div class="modal fade" id="statusModal" tabindex="-1" style="display: none;" aria-hidden="true">
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
                @foreach (\App\Enums\FirmwareStatus::cases() as $value)
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
