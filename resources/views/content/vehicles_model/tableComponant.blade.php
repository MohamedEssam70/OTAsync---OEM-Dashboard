@aware(['component'])
 
@if ($component->isBootstrap())
    <div class="">
        <button type="button" class="btn btn-secondary btn-primary ms-3" tabindex="0" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_addVehicleModel" aria-controls="offcanvasEnd">
            <span>
                <i class="bx bx-plus me-0 me-sm-1"></i>
                <span class="d-none d-sm-inline-block">Add New Vehicle Model</span>
            </span>
        </button>
    </div>
@elseif ($component->isTailwind())
    <div><!-- Implement Other Themes if needed--></div>
@endif