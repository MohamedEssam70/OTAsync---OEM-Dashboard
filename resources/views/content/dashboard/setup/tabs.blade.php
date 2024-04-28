@php
  $activeTab = ($activeTab ?? 0);
@endphp


<div class="row">
  <div class="col-md-12">
    <ul class="nav nav-pills flex-column flex-md-row mb-3">
      <li class="nav-item"><a class="nav-link {{isset($activeTab) && $activeTab == 0 ? 'active' : '' }}" href="{{route('system.security')}}"><i class="bx bx-customize me-1"></i> API Keys </a></li>
      <li class="nav-item"><a class="nav-link {{isset($activeTab) && $activeTab == 1 ? 'active' : '' }}" href="{{route('system.encryption')}}"><i class="bx bx-lock me-1"></i> Encryption </a></li>
    </ul>
  </div>
</div>
