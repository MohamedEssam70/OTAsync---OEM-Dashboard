@extends('layouts/contentNavbarLayout',['isMenu'=>false, 'isNavbar'=>false])

@section('title', 'Upload firmware')

@section('vendor-style')
<link href="{{asset("assets/vendor/libs/dropzone/dropzone.css")}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{asset("assets/vendor/libs/bootstrap-select/bootstrap-select.min.css")}}">
@endsection

@section('page-style')
<link rel="stylesheet" href="{{asset("assets/vendor/css/pages/page-add-firmware.css")}}">
@endsection

@section('content')
<form id="addFirmware" method="POST" action="{{ route('firmware.submit')}}">
    @csrf
    <div class="row">
        <div class="col-lg-9 col-12 mb-lg-0 mb-4">
            <div class="card">
            <div class="card-body">
                <div class="row p-sm-3 p-0">
                    <div class="col-md-6 mb-md-0 mb-4">
                        <div class="d-flex svg-illustration mb-2 gap-2">
                            <span class="app-brand-logo demo me-2">
                                <img src="{{asset("assets/img/elements/upload_card.png")}}" style="width: 100px; height: auto;">
                            </span>
                            <span class="app-brand-text demo text-body fw-bold" style="text-transform:none">Fiemware Upload</span>
                        </div>
                        <p class="mb-1">Please note that uploading firmware via this tool is intended for</p>
                        <p class="mb-1">Arm Cortex-M3 MCU, STM32F103C8T6.</p>
                        <p class="mb-0">Its strongly recommended that updates be .HEX, .BIN</p>
                    </div>
                    <div class="col-md-6">
                        <dl class="row mb-2">
                            <dt class="col-sm-6 mb-2 mb-sm-0 text-md-end">
                                <span class="h4 text-capitalize mb-0 text-nowrap">Type</span>
                            </dt>
                            <dd class="col-sm-6 d-flex justify-content-md-end">
                                <div class="w-px-150">
                                    <div class="dropdown bootstrap-select w-100">
                                        <select id="pickerUpdateType" class="selectpicker w-100" data-style="btn-select" tabindex="null" name="type">
                                            @foreach (\App\Enums\UpdateTypes::cases() as $value)
                                                <option value="{{ $value }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </dd>
                            <dt class="col-sm-6 mb-2 mb-sm-0 text-md-end">
                                <span class="fw-normal">Firmware:</span>
                            </dt>
                            <dd class="col-sm-6 d-flex justify-content-md-end">
                                <div class="w-px-150">
                                    <input type="text" class="form-control date-picker flatpickr-input" placeholder="XX0X-00000-XX" name="name">
                                </div>
                            </dd>
                            <dt class="col-sm-6 mb-2 mb-sm-0 text-md-end">
                                <span class="fw-normal">Version:</span>
                            </dt>
                            <dd class="col-sm-6 d-flex justify-content-md-end">
                                <div class="w-px-150">
                                    <input type="text" class="form-control date-picker flatpickr-input" placeholder="0.00" name="version">
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>

                <hr class="my-2 mx-n4">
        
                <div class="row p-sm-3 p-0">
                    <div class="col-md-6 col-sm-7">
                        <h6 class="pb-2">Broadcast To:</h6>
                        <dl class="col-12 mb-2">
                            <div class="row align-items-center mb-2">
                                <dt class="col-sm-2 mb-2 mb-sm-0 text-md-start">
                                    <span class="pe-3 text-capitalize mb-0 text-nowrap">Model:</span>
                                </dt>
                                <dd class="col-sm-6 d-flex justify-content-md-start mb-0">
                                    <select id="pickerModel" class="selectpicker w-100" data-style="btn-select" tabindex="null" title="Vehicle Model Name" data-live-search="true" name="vehicle_model_id">
                                        @foreach ($models as $model)
                                            <option value="{{$model->id}}">{{$model->name}}</option>
                                        @endforeach
                                    </select>
                                </dd>
                            </div>
                            <div class="row align-items-center">
                                <dt class="col-sm-2 mb-2 mb-sm-0 text-md-start">
                                    <span class="fw-normal">Vehicle:</span>
                                </dt>
                                <dd class="col-sm-6 d-flex justify-content-md-start mb-0">
                                    <select id="pickerVehicle" class="selectpicker w-100" data-style="btn-select" tabindex="null" title="Vehicle VIN" data-live-search="true" name="vehicle_id">
                                    </select>
                                </dd>
                            </div>
                        </dl>
                    </div>
                    <div class="col-md-6 col-sm-5 col-12 mb-sm-0 mb-4">
                        <h6 class="pb-2">Details</h6>
                        <table>
                            <tbody>
                                <tr>
                                    <td class="pe-3">Scope:</td>
                                    <td id="infoScope"></td>
                                </tr>
                                <tr>
                                    <td class="pe-3">No. of targets:</td>
                                    <td id="infoTargets"></td>
                                </tr>
                                <tr>
                                    <td class="pe-3">Current Firmware:</td>
                                    <td id="infoFirmware"></td>
                                </tr>
                                <tr>
                                    <td class="pe-3">Last Update:</td>
                                    <td id="infoDate"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
        
                <hr class="mx-n4">
        
                <div class="row justify-content-between w-100 m-0 p-3">
                    <div class="col-md-7 col-12 mb-md-0 mb-3">
                        <div class="d-flex flex-column h-100">
                            <div class="mb-auto">
                                <h5 class="card-title text-primary">Firmware File</h5>
                                <p class="mb-1">Please ensure a stable internet connection during the upload process. Interruptions during the process could lead to errors.</p>
                                <p class="mb-3">Your firmware file will undergo encryption to safeguard its integrity and confidentiality. Once encrypted, securely the file will upload to our server.</p>
                                <h6 class="mb-0">Compatible:</h6>
                                <table class="mb-3">
                                    <tbody>
                                        <tr>
                                            <td class="pe-3">MCU</td>
                                            <td>STM32F103C8T6</td>
                                        </tr>
                                        <tr>
                                            <td class="pe-3">File type</td>
                                            <td>.BIN</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <button type="button" id="uploadButton" class="btn btn-label-secondary d-grid w-50">Select Firmware File</button>
                        </div>
                    </div>
                    <div class="col-md-4 col-12 mb-md-0 mb-3 ps-md-0">
                        @include('_partials.dropzone')
                    </div>
                </div>

                <hr class="my-4 mx-n4">
        
                <div class="row py-sm-3">
                    <div class="col-md-5 mb-md-0 mb-3">
                        <div class="row align-items-center mb-3">
                            <div class="col-md-4">
                                <label for="updateTiming" class="form-label me-0 fw-medium">Update Timing:</label>
                            </div>
                            <div class="col-md">
                                <div class="dropdown bootstrap-select w-100">
                                    <select id="pickerUpdateTiming" class="selectpicker w-100" data-style="btn-select" tabindex="null">
                                        <option value="0">Immediately</option>
                                        <option value="1">Scheduled</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input class="form-control mb-0" type="datetime-local" name="updateDate" value="" id="updateDate" disabled="" name="upgradeDate">
                        <div id="" class="form-text mt-1">Select update date and time.</div>
                        <input class="visually-hidden" type="checkbox" id="schedule" name="schedule">
                    </div>
                </div>
        
                <hr class="my-4">
        
                <div class="row">
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <textarea type="text" class="form-control" id="floatingInput" placeholder="Type a description for the uploded file" aria-describedby="floatingInputHelp"></textarea>
                            <label for="floatingInput">What's New?</label>
                            <div id="floatingInputHelp" class="form-text">We'll never share your details with anyone else.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <div class="col-lg-3 col-12">
            <div class="card mb-4">
                <div class="card-body">
                    <button class="btn btn-primary d-grid w-100 mb-3" type="submit">
                        <span class="d-flex align-items-center justify-content-center text-nowrap">
                            <i class="bx bx-paper-plane bx-xs me-1"></i>
                            Submit Update
                        </span>
                    </button>
                </div>
            </div>
            <div>
                <p class="mb-2">New software status</p>
                <select id="status" class="form-select mb-3" name="status">
                    @foreach (\App\Enums\FirmwareStatus::cases() as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                    @endforeach
                </select>
                <div class="d-flex justify-content-between mb-0">
                    <label for="payment-terms" class="mb-0 text-danger">Critical Update</label>
                    <label class="switch switch-primary me-0">
                        <input type="checkbox" class="switch-input" id="critical-update" name="priority">
                        <span class="switch-toggle-slider">
                            <span class="switch-on">
                                <i class="bx bx-check"></i>
                            </span>
                            <span class="switch-off">
                                <i class="bx bx-x"></i>
                            </span>
                        </span>
                        <span class="switch-label"></span>
                    </label>
                </div>
                <div id="" class="form-text mt-0 mb-3">
                    Vehicle will update upon startup.
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <label for="client-notes" class="mb-0">Send Notification</label>
                    <label class="switch switch-primary me-0">
                        <input type="checkbox" class="switch-input" id="send-notification" checked="" disabled>
                        <span class="switch-toggle-slider">
                            <span class="switch-on">
                                <i class="bx bx-check"></i>
                            </span>
                            <span class="switch-off">
                                <i class="bx bx-x"></i>
                            </span>
                        </span>
                        <span class="switch-label"></span>
                    </label>
                </div>
                <div class="d-flex justify-content-between">
                    <label for="payment-stub" class="mb-0">Encryption</label>
                    <label class="switch switch-primary me-0">
                        <input type="checkbox" class="switch-input" id="encryption" checked="" disabled>
                        <span class="switch-toggle-slider">
                            <span class="switch-on">
                                <i class="bx bx-check"></i>
                            </span>
                            <span class="switch-off">
                                <i class="bx bx-x"></i>
                            </span>
                        </span>
                        <span class="switch-label"></span>
                    </label>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('vendor-script')
<script src="{{asset("assets/vendor/libs/dropzone/dropzone-min.js")}}"></script>
<script src="{{asset("assets/vendor/libs/mqtt/mqttws31.js")}}" type="text/javascript"></script>
<script src="{{asset("assets/vendor/libs/bootstrap-select/bootstrap-select.min.js")}}"></script>

@endsection

@section('page-script')
<script>
    var dz = $('#dz-preview-template').html();
    var currentFile = null;
    Dropzone.autoDiscover = false;
    $("div#myDropzone").dropzone({ 

        url:"{{url('firmware/store')}}",
        
        method: "post",

        addRemoveLinks: true,

        /**
         * A string that contains the template used for each dropped
         * file. Change it to fulfill your needs but make sure to properly
         * provide all elements.
         */
        previewTemplate: dz,
        
        parallelUploads: 1,

        filesizeBase: 1024,

        maxFilesize: 2,

        paramName: "file",

        renameFile: "updd",
        
        maxFiles: 1,
        
        /**
         * The default implementation of `accept` checks the file's mime type or
         * extension against this list. This is a comma separated list of mime
         * types or file extensions.
         * Eg.: `image/*,application/pdf,.psd`
         */
        acceptedFiles: '.bin',

        /**
         * Sends the file as binary blob in body instead of form data.
         */
        binaryBody: false,

        /**
         * The text used before any files are dropped.
         */
        dictDefaultMessage: "Drop files here to upload",

        /**
         * The text that replaces the default message text it the browser is not supported.
         */
        dictFallbackMessage:
        "Your browser does not support drag'n'drop file uploads.",

        /**
         * The text that will be added before the fallback form.
         * If you provide a  fallback element yourself, or if this option is `null` this will
         * be ignored.
         */
        dictFallbackText:
        "Please use the fallback form below to upload your files like in the olden days.",

        /**
         * If the filesize is too big.
         * `filesize` and `maxFilesize` will be replaced with the respective configuration values.
         */
        dictFileTooBig:
        "File is too big (filesize MiB). Max filesize: maxFilesize}}MiB.",

        /**
         * If the file doesn't match the file type.
         */
        dictInvalidFileType: "You can't upload files of this type.",

        /**
         * If the server response was invalid.
         * `statusCode` will be replaced with the servers status code.
         */
        dictResponseError: "Server responded with statusCode}} code.",

        /**
         * If `addRemoveLinks` is true, the text to be used for the cancel upload link.
         */
        dictCancelUpload: "Cancel upload",

        /**
         * The text that is displayed if an upload was manually canceled
         */
        dictUploadCanceled: "Upload canceled.",

        /**
         * If `addRemoveLinks` is true, the text to be used for confirmation when cancelling upload.
         */
        dictCancelUploadConfirmation: "Are you sure you want to cancel this upload?",

        /**
         * If `addRemoveLinks` is true, the text to be used to remove a file.
         */
        dictRemoveFile: "Remove file",

        /**
         * If this is not null, then the user will be prompted before removing a file.
         */
        dictRemoveFileConfirmation: "Uploaded file will be removed, are you sure?",

        /**
         * Displayed if `maxFiles` is st and exceeded.
         * The string `maxFiles}}` will be replaced by the configuration value.
         */
        dictMaxFilesExceeded: "You can not upload any more files.",

        /**
         * Allows you to translate the different units. Starting with `tb` for terabytes and going down to
         * `b` for bytes.
         */
        dictFileSizeUnits: { tb: "TB", gb: "GB", mb: "MB", kb: "KB", b: "b" },

        /*
            * Add Listener here
            *
            */
        init: function() {
            this.on('addedfile', function(file){
                if (currentFile) {
                    this.removeFile(currentFile);
                }
                currentFile = file;
            });
            this.on('error', function(file, errorMessage) {
                var errorDisplay = $('[data-dz-errormessage]');
                console.log(errorMessage.message);
                errorDisplay.text(errorMessage.message);
            });
            this.on('sending', function(file, xhr, formData){
                formData.append("_token", "{{ csrf_token() }}");
            });
            this.on('complete', function(file){
            });
            this.on('success', function(file, response){
                $('#uploaded_file').val(response['fileName']);
                console.log($('#uploaded_file').val());
            });
            this.on('removedfile', function(file){
                $('#uploaded_file').val(null);
            });
        }
    });
</script>
<script>
    /*
    * Disable/Enable Schedule Scection
    */
    $('#pickerUpdateTiming').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
        if(clickedIndex === 0)
        {
            $('#updateDate').prop("disabled", true);
            $("#schedule").prop("checked", !$("#schedule").prop("checked"));
        }
        else if(clickedIndex === 1)
        {
            $('#updateDate').prop("disabled", false);
            $("#schedule").prop("checked", !$("#schedule").prop("checked"));
        }
        else
        {
            // 
        }
    });


    /*
    * Data table depend on selected options
    */
    $('#pickerModel').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
        $model = $("#pickerModel").val();
        $vehicle = $("#pickerVehicle").val();

        // Update vehicle list
        $.ajax({
            url: "/firmware/selectpicker/model/"+$model,
            type: 'get',
            data: {},
            success: function(response){
                $("#pickerVehicle").empty()
                $("#pickerVehicle").append('<option value="" defult> All Vehicles </option>');
                $.each(response, function(key, value){
                    $("#pickerVehicle").append('<option value="'+key+'">'+value+'</option>');
                })
                $("#pickerVehicle").selectpicker('refresh');
                $("#pickerVehicle").selectpicker('val', '');
            }
        });


        // Model selected, Vehicle not selected
        if($vehicle == "")
        {
            // Scope
            $("#infoScope").text("Model");

            // No. of Targets
            $("#infoTargets").text("#");

            // Currrent Firmware
            $("#infoFirmware").text("xxxxxxxxx");

            // Last Update
            $("#infoDate").text("ssdf");
        }
        // Model selected, Vehicle selected
        else
        {
            // Scope
            $("#infoScope").text("Vehicle");
            
            // No. of Targets
            $("#infoTargets").text("1");
            
            // Currrent Firmware
            $("#infoFirmware").text("DDDDDD");

            // Last Update
            $("#infoDate").text("dsgf");
        }

        console.log("Model:" + $model);
        console.log("Vehicle:" + $vehicle);
    });

    $('#pickerVehicle').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
        $model = $("#pickerModel").val();
        $vehicle = $("#pickerVehicle").val();

        if(clickedIndex === 1 || clickedIndex === 0 || clickedIndex === null)  // No vehicle selected
        {
            // Scope
            $("#infoScope").text("Model");

            // No. of Targets
            $("#infoTargets").text("#");

            // Currrent Firmware
            $("#infoFirmware").text("xxxxxxxxx");

            // Last Update
            $("#infoDate").text("ssdf");
        }
        else
        {
            // Scope
            $("#infoScope").text("Vehicle");
            
            // No. of Targets
            $("#infoTargets").text("1");
            
            // Currrent Firmware
            $("#infoFirmware").text("DDDDDD");

            // Last Update
            $("#infoDate").text("dsgf");
        }

        console.log("Model:" + $model);
        console.log("Vehicle:" + $vehicle);
    });

    /*
    * Click Dropzone via button
    */
    $('#uploadButton').on("click", function(){
        $("#myDropzone").click();
    });
</script>
@endsection
    