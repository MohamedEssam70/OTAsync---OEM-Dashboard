@php
  $activeTab = ($activeTab ?? 0);
@endphp


<div class="row">
  <div class="col-md-12">
    <ul class="nav nav-pills flex-column flex-md-row mb-3">
      <li class="nav-item"><a class="nav-link {{isset($activeTab) && $activeTab == 0 ? 'active' : '' }}" href="{{route('user.profile')}}"><i class="bx bx-user me-1"></i> My Profile </a></li>
      <li class="nav-item"><a class="nav-link {{isset($activeTab) && $activeTab == 1 ? 'active' : '' }}" href="{{route('user.setting')}}"><i class="bx bx-cog me-1"></i> Settings </a></li>
      <li class="nav-item"><a class="nav-link {{isset($activeTab) && $activeTab == 2 ? 'active' : '' }}" href="{{route('user.activity')}}"><i class="bx bx-history me-1"></i> Activity Log</a></li>
    </ul>
  </div>
</div>
