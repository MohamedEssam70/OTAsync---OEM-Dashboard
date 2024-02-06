@extends('layouts/contentNavbarLayout', ['navbarBreadcrumb' => true,
                                         'navbarBreadcrumbHome' => true,
                                         'navbarBreadcrumbPrev' => 'Vehicle Models',
                                         'navbarBreadcrumbActive' => $vehicle_model->name,
                                         'breadcrumbLink'=> route("models.manage")
                                         ])

@section('page-style')
    <link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />
@endsection

@section('title', 'Vehicle Models')

@section('content')
<div class="container-xxl flex-grow-1">
    <div class="card bg-transparent shadow-none border-0 mb\-4">
        <div class="card-body row p-0 pb-3">
            <div class="col-12 col-md-8 card-separator">
                <h3>Details</h3>
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 me-5">
                    <div class="d-flex align-items-center me-4 me-sm-0">
                        <img src="{{$vehicle_model->image}}" class="d-block h-auto" id="uploadedAvatar" style="width: 40px; border-radius:50%" />
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="content-right">
                            <span class="mb-0 text-light" style="font-size: 12px">Producer</span>
                            <h6 class="text-gray mb-0">OTAsync</h6>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="content-right">
                            <span class="mb-0 text-light" style="font-size: 12px">Model</span>
                            <h6 class="text-gray mb-0">{{$vehicle_model->name}}</h6>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="content-right">
                            <span class="mb-0 text-light" style="font-size: 12px">Serial Number</span>
                            <h6 class="text-gray mb-0">{{$vehicle_model->serial}}</h6>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="content-right">
                            <span class="mb-0 text-light" style="font-size: 12px">Firmware</span>
                            <h6 class="text-gray mb-0">{{$vehicle_model->firmwares()->orderByDesc('id')->first()->name}}</h6>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="content-right">
                            <span class="mb-0 text-light" style="font-size: 12px">Connection Reilabilty</span>
                            <h6 class="text-gray mb-0">-</h6>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 ps-md-3 ps-lg-5 pt-3 pt-md-0">
                <div class="d-flex justify-content-between align-items-center" style="position: relative;">
                    <div>
                        <div>
                            <h5 class="mb-2">Last Upgrade</h5>
                            <p class="mb-4">{{$vehicle_model->firmwares()->orderByDesc('id')->first()->created_at->diffForHumans()}}</p>
                        </div>
                        <div class="time-spending-chart">
                            <h3 class="mb-2">{{$vehicle_model->firmwares()->count()}} <span class="text-muted" style="font-size: 1rem">Firmware Upgrade</span></h3>
                            <span class="badge bg-label-success">+18.4%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('content.models-tabs')

@endsection

@section('page-script')
<script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>

<script>
    
    $(document).ready(function() {

        /*
        * Disable/Enable Schedule Scection
        */
        $('#flexSwitchCheckDefault').click(function() {
            if($("#flexSwitchCheckDefault").is(':checked'))
            {
                $('#scheduleDate').removeClass("disable-sec");  // checked
                $('#schedule-input').prop("disabled", false);
            }
            else
            {
                $('#scheduleDate').addClass("disable-sec");  // unchecked
                $('#schedule-input').prop("disabled", true);
            }
        });

        /*
        * Drop Zone
        */
        var dz = $('#dz-preview-template').html();
        Dropzone.autoDiscover = false;
        $("div#myDropzone").dropzone({ 
            url:"{{url('firmware/store')}}", 
            addRemoveLinks: true,
            previewTemplate: dz,            
        });

        // $("div#myDropzone").on('change', function(){

        //     $('.dz-remove').css("color: #697a8d; border-top: 1px solid #d9dee3; border-bottom-right-radius: calc(0.375rem - 1px); border-bottom-left-radius: calc(0.375rem - 1px); display: block; text-align: center; padding: 0.375rem 0; font-size: .75rem;")
        // });
        


        // Dropzone.discover();
        // let myDropzone = $("myDropzone");
        // Dropzone.options.myDropzone =
        // {
        //     paramName: "file",
        //     url: "",
        //     parallelUploads: 1,
        //     addRemoveLinks: true,
        //     accept: function(file, done) {
        //         console.log(file.name);
        //         done();
        //     }
        //     myDropzone.on("addedfile", file => {
        //     console.log("A file has been added")});
        // };

    });
    
</script>
@endsection