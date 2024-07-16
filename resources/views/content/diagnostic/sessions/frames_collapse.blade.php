<div class="px-2">
    <div class="nav-align-left mb-4">
        <ul class="nav nav-pills me-3" id="frames_nav" role="tablist">
            {{-- @foreach ($session->get_updated_frames() as $frame)
                <li class="nav-item" role="presentation">
                    <button type="button" class="frames-nav nav-link justify-content-center {{ $activeFrame == $loop->index ? 'active' : '' }}" 
                        role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-{{ $loop->index }}" 
                        aria-controls="navs-pills-{{ $loop->index }}">
                        {{ $frame->dtc }}
                    </button>
                </li>
            @endforeach --}}
        </ul>
        <div class="tab-content shadow-none" id="frames_content">
            {{-- @foreach ($session->get_updated_frames() as $frame)
                <div class="tab-pane fade {{ $activeFrame == $loop->index ? 'show active' : '' }}" 
                    id="navs-pills-{{ $loop->index }}" role="tabpanel">
                    <h5>Freeze Frame Sensor Snapshot</h5>
                    @foreach ($frame->data as $sensor)
                    <div class="row">
                        <span class="">{{ $sensor->name }}</span>
                        <div>
                            <span class="text-warning w-auto">{{ $sensor->value }}</span>
                        </div>
                    </div>
                    <hr class="mt-1">
                    @endforeach
                </div>
            @endforeach --}}
        </div>
    </div>
</div>