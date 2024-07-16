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
<form id="addFirmware" method="post" action="">
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
                                            @php
                                            $currentFirmware = null;
                                            $currentFirmware = $model->firmwares()->orderByDesc('id')->first()
                                            @endphp
                                            <option value="{{$model->id}}" data-firmware="{{ $currentFirmware?->name }}" data-last-update="{{ isset($currentFirmware) ? \Carbon\Carbon::parse($currentFirmware?->created_at)->format('d M Y') : '' }}">{{$model->name}}</option>
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
                                    <select id="pickerUpdateTiming" class="selectpicker w-100" data-style="btn-select" tabindex="null" name="schedule">
                                        <option value="off">Immediately</option>
                                        <option value="on">Scheduled</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input class="form-control mb-0" type="datetime-local" value="" id="upgradeDate" disabled="" name="upgradeDate">
                        <div id="" class="form-text mt-1">Select update date and time.</div>
                    </div>
                </div>
        
                <hr class="my-4">
        
                <div class="row">
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <textarea type="text" class="form-control" id="floatingInput" placeholder="Type a description for the uploded file" aria-describedby="floatingInputHelp" name="description"></textarea>
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
                        <input class="" type="hidden" id="criticalSwitch" name="priority" value="off">
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

@if (\Session::has('success'))
<div class="modal fade" id="statusModal" tabindex="-1">
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

@endif

@endsection

@section('vendor-script')
<script src="{{asset("assets/vendor/libs/dropzone/dropzone-min.js")}}"></script>
<script src="{{asset("assets/vendor/libs/bootstrap-select/bootstrap-select.min.js")}}"></script>

@endsection

@section('page-script')

@include('_partials.dropzone_scripts', [
    'ajaxUrl' => url('firmware/store')
])


<script>
    /*
    * Disable/Enable Schedule Scection
    */
    $('#pickerUpdateTiming').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
        if(clickedIndex === 0)
        {
            $('#upgradeDate').prop("disabled", true);
        }
        else if(clickedIndex === 1)
        {
            $('#upgradeDate').prop("disabled", false);
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
        let model = $("#pickerModel").val();
        let vehicle = $("#pickerVehicle").val();

        // Update vehicle list
        $.ajax({
            url: "/firmware/selectpicker/model/"+model,
            type: 'get',
            data: {},
            success: function(response){
                $('#pickerVehicle')
                    .find('option')
                    .remove();

                $("#pickerVehicle").selectpicker('destroy');

                $("#pickerVehicle").append('<option value="" selected> All Vehicles </option>');
                $.each(response, function(key, value) {
                    let currentFirmware = value.current_firmware;
                    let optionAppend = '<option value="'+value.id+'">'+value.pin+'</option>';
                    if(currentFirmware && Object.keys(currentFirmware).length > 0) {
                        let last_update = new Date(currentFirmware.created_at).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
                        optionAppend = '<option value="'+value.id+'" data-firmware="'+currentFirmware.name+'" data-last-update="'+last_update+'">'+value.pin+'</option>';
                    }
                    else
                    {
                        optionAppend = '<option value="'+value.id+'" data-firmware="" data-last-update="">'+value.pin+'</option>';
                    }
                    $("#pickerVehicle").append(optionAppend);
                });
                
                $("#pickerVehicle").selectpicker();

                let targetSize = Object.keys(response).length;
                
                $("#pickerModel").find(':selected').attr('data-size', targetSize);

                // No. of Targets
                $("#infoTargets").text(targetSize);
            }
        });

        // Scope
        $("#infoScope").html("Model");

        // Currrent Firmware
        $("#infoFirmware").text($(this).find(':selected').data('firmware'));

        // Last Update
        $("#infoDate").text($(this).find(':selected').data('last-update'));
    });

    $('#pickerVehicle').on('change', function (e, clickedIndex, isSelected, previousValue) {
        if($(this).val()) {
            // Scope
            $("#infoScope").text("Vehicle");
            
            // No. of Targets
            $("#infoTargets").text("1");
            
            // Currrent Firmware
            $("#infoFirmware").text($(this).find(':selected').data('firmware'));
    
            // Last Update
            $("#infoDate").text($(this).find(':selected').data('last-update'));
        } else {
            let model = $("#pickerModel");

            // Scope
            $("#infoScope").text("Model");

            // No. of Targets
            $("#infoTargets").text(model.find(':selected').data('size'));

            // Currrent Firmware
            $("#infoFirmware").text(model.find(':selected').data('firmware'));
    
            // Last Update
            $("#infoDate").text(model.find(':selected').data('last-update'));
        }
    });

    /*
    * Click Dropzone via button
    */
    $('#uploadButton').on("click", function(){
        $("#myDropzone").click();
    });
</script>

<script>
    toastr.options = {
        positionClass: 'toast-top-left',
        closeButton: true,
        timeOut: 5000, // 5 seconds
        progressBar: true,
        preventDuplicates: true
    };

    let base_topic = 'otasync/ota/broadcast/';
    
function sendMQTTMessage(response) {
    // Ensure client is initialized and connected
    if (client.isConnected()){
        let message = new Paho.MQTT.Message(JSON.stringify(response));
        message.qos = 1;
        if (response.vehicle_id) {
            message.destinationName = base_topic + response.vehicle_model + '/' + response.vehicle;
        } else {
            message.destinationName = base_topic + response.vehicle_model;
        }
        client.send(message);
    } else {
        console.error('MQTT client is not connected.');
        toastr.error('MQTT client is not connected');
    }
}
$('#addFirmware').submit(function(e) {
    e.preventDefault();
    // Serialize the form data
    let formData = $( this ).serialize();
    // Send an AJAX request
    $.ajax({
        type: 'POST',
        url: '{{ route('firmware.submit') }}',
        data: formData,
        dataType: 'json',
        Accept: 'application/json',
        success: function(response) {
            sendMQTTMessage(response);
            toastr.success('Firmware added successfully!');
            console.log(response);
            // location.href = "{{ route('firmwares') }}"
        },
        error: function(xhr, status, error) {
            // Handle the error response
            let errorMessage = 'An error occurred while adding firmware.';

            // Show error message using Toastr
            toastr.error(errorMessage);
                        console.error(xhr.responseText);
                    }
                }); 
});
</script>
@endsection