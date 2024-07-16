@extends('layouts/contentNavbarLayout', ['navbarBreadcrumbPrev' => 'Security /', 'navbarBreadcrumbActive' => 'Security'])
@section('title', 'Security')
@section('content')
@include('content.security.tabs', ['activeTab' => 1])
<div class="row">
    <div class="col-md-12">
      <div class="card mb-4">
        <h5 class="card-header">Encryption Keys</h5>
        <div class="card-body">
          <p>An API key is a simple encrypted string that identifies an application without any principal. They are useful for make vehicles access data securely.</p>
          <div class="row">
            <div class="col-md-12">
                {{-- Public Key --}}
                <div class="bg-lighter rounded p-3 mb-3 position-relative">
                    <div class="d-flex align-items-center flex-wrap mb-3">
                        <h4 class="mb-0 me-3">Public Key</h4>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <span class="me-2"><span class="fw-medium" id="public_key">-----PUBLIC KEY----- ************************************************************************************************************************************************</span></span>
                        <span class="text-light cursor-pointer" id="copy-public"><i class="bx bx-copy"></i></span>
                    </div>
                </div>
                {{-- Private key --}}
                <div class="bg-lighter rounded p-3 mb-3 position-relative">
                    <div class="d-flex align-items-center flex-wrap mb-3">
                        <h4 class="mb-0 me-3">Private key</h4>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <span class="me-2"><span class="fw-medium" id="private_key">-----PRIVATE KEY----- ************************************************************************************************************************************************</span></span>
                        <span class="text-light cursor-pointer" id="copy-private"><i class="bx bx-copy"></i></span>
                    </div>
                </div>
            </div>
        </div>
      </div>
      
    </div>
</div>


<div class="modal fade" id="authModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Authentication Required</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <form id="authForm" autocomplete="off">
                  <div class="mb-3">
                      <label for="email" class="form-label">Email</label>
                      <input type="email" class="form-control" id="email" required autocomplete="off" spellcheck="false">
                  </div>
                  <div class="mb-3">
                      <label for="password" class="form-label">Password</label>
                      <input type="password" class="form-control" id="password" required autocomplete="new-password">
                  </div>
              </form>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="submitAuth">Submit</button>
          </div>
      </div>
  </div>
</div>
@endsection

@section('page-script')
<script>
  toastr.options = {
    positionClass: 'toast-bottom-right',
    closeButton: true,
    timeOut: 5000, // 5 seconds
    progressBar: true,
    preventDuplicates: true
    };
  document.addEventListener('DOMContentLoaded', function() {
      let currentKeyType;
      const modal = new bootstrap.Modal(document.getElementById('authModal'));

      const authModal = document.getElementById('authModal');
      authModal.addEventListener('hidden.bs.modal', function () {
          document.getElementById('authForm').reset();
      });
  
      function copyToClipboard(keyType) {
          currentKeyType = keyType;
          modal.show();
      }
  
      document.getElementById('copy-public').addEventListener('click', function() {
          copyToClipboard('public');
      });
  
      document.getElementById('copy-private').addEventListener('click', function() {
          copyToClipboard('private');
      });
  
      document.getElementById('submitAuth').addEventListener('click', function() {
          const email = document.getElementById('email').value;
          const password = document.getElementById('password').value;
  
          // Send authentication request to server
          fetch('/api/authenticate', {
              method: 'POST',
              headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
              },
              body: JSON.stringify({ email, password })
          })
          .then(response => response.json())
          .then(data => {
              if (data.success) {
                  // If authentication is successful, proceed with copying the key
                  fetch(`/api/get-key/${currentKeyType}`)
                      .then(response => response.text())
                      .then(key => {
                          navigator.clipboard.writeText(key).then(() => {
                              toastr.success(`${currentKeyType.charAt(0).toUpperCase() + currentKeyType.slice(1)} key copied to clipboard`);
                          }, () => {
                              toastr.error('Failed to copy key!');
                          });
                      })
                      .catch(error => {
                          console.error('Error:', error);
                          toastr.error('Failed to copy key!');
                      });
                  modal.hide();
              } else {
                  toastr.warning('Authentication failed. Please try again!');
              }
          })
          .catch(error => {
              console.error('Error:', error);
              toastr.warning('Authentication failed. Please try again!');
          });
      });
  });
  </script>
@endsection