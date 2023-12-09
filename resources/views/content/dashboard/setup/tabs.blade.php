@php
  $activeTab = ($activeTab ?? 0);
@endphp


<div class="row">
  <div class="col-md-12">
    <ul class="nav nav-pills flex-column flex-md-row mb-3">
      <li class="nav-item"><a class="nav-link {{isset($activeTab) && $activeTab == 0 ? 'active' : '' }}" href="{{route('system.customize')}}"><i class="bx bx-customize me-1"></i> System Customization </a></li>
      <li class="nav-item"><a class="nav-link {{isset($activeTab) && $activeTab == 1 ? 'active' : '' }}" href="{{route('mqtt.config')}}"><i class="bx bx-rss me-1"></i> MQTT Configuration </a></li>
      <li class="nav-item"><a class="nav-link {{isset($activeTab) && $activeTab == 2 ? 'active' : '' }}" href="{{route('encription.config')}}"><i class="bx bx-lock me-1"></i> Encription </a></li>
      <li class="nav-item"><a class="nav-link {{isset($activeTab) && $activeTab == 3 ? 'active' : '' }}" href="{{route('server.connection')}}"><i class="bx bx-server me-1"></i> Server Connection </a></li>
    </ul>
  </div>
</div>
