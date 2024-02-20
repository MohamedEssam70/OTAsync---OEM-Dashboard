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
<script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.js" type="text/javascript"></script>
<script>
    
    $(document).ready(function() {

        /*
        * Disable/Enable Schedule Scection
        */
        $('#schedule').click(function() {
            if($(this).is(':checked'))
            {
                $('#scheduleDate').removeClass("disable-sec");  // checked
                $('#upgradeDate').prop("disabled", false);
                $('#schedule_hidden').prop("disabled", true);
            }
            else
            {
                $('#scheduleDate').addClass("disable-sec");  // unchecked
                $('#upgradeDate').prop("disabled", true);
                $('#schedule_hidden').prop("disabled", false);
            }
        });


        /*
        * Drop Zone
        */
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

        /*
         * Post 
         *
        */
        const form = document.querySelector("#upgrade-form");
        $('#upgrade-form').submit(function(e) {
            e.preventDefault();
            // Serialize the form data
            let formData = $( this ).serialize();
            formData += '&vehicleModelId={{$vehicle_model->id}}';
            console.log(formData);
            // Send an AJAX request
            $.ajax({
                type: 'GET',
                url: '{{ route('firmware.update') }}',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response) {
                    // Handle the response message
                    console.log(response);

                    // Create a client instance
                    client = new Paho.MQTT.Client('e01eebd935794e0b9876143ab709f203.s1.eu.hivemq.cloud', Number(8884), "client-1");

                    // set callback handlers
                    client.onConnectionLost = onConnectionLost;
                    client.onMessageArrived = onMessageArrived;

                    // connect the client
                    client.connect({
                    onSuccess:onConnect,
                    mqttVersion: 3,
                    useSSL: true,
                    userName : "OTAsync_system",
                    password : "$fWGY%R3"
                    });

                    // called when the client connects
                    function onConnect() {
                    // Once a connection has been made, make a subscription and send a message.
                    console.log("onConnect");
                    client.subscribe("my/test/topic");
                    client.subscribe("test");
                    message = new Paho.MQTT.Message(JSON.stringify(response));
                    message.qos = 1;
                    message.destinationName = "test";
                    client.send(message); 
                    }

                    // called when the client loses its connection
                    function onConnectionLost(responseObject) {
                    if (responseObject.errorCode !== 0) {
                        console.log("onConnectionLost:"+responseObject.errorMessage);
                    }
                    }

                    // called when a message arrives
                    function onMessageArrived(message) {
                    console.log("onMessageArrived:"+message.payloadString);
                    }

                },
                error: function(xhr, status, error) {
                    // Handle errors if needed
                    console.error(xhr.responseText);
                }
            });
        });
    });
    
</script>
@endsection