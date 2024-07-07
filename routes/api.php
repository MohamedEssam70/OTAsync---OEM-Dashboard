<?php

use App\Http\Controllers\API\RSAencryptionAPIController;
use App\Http\Controllers\API\SessionAPIController;
use App\Http\Controllers\API\UserAPIController;
use App\Http\Controllers\API\VehicleAPIController;
use App\Models\AESKey;
use App\Models\Firmware;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/auth/login', [UserAPIController::class, 'login']);

Route::get('/get-key/{type}', [RSAencryptionAPIController::class, 'getKey']);
Route::post('/authenticate', [RSAencryptionAPIController::class, 'authenticate']);

Route::middleware('api_key')->group(function() {
    Route::get('/keepalive', [VehicleAPIController::class, 'keepAlive']);

    // Download File (OLD)
    Route::get('/download/{filename}', function ($filename) {
        $path = storage_path().'/'.'app/public/storage/uploads/'.$filename;
        return Response::download($path);
    });

    // Request download software file
    Route::get('/get/firmware/{id}', function ($id) {
        // Get Firmware object
        $firmware = Firmware::findOrFail($id);

        // Generate file path
        $firmwarePath = $firmware->get_firmware_path();

        // Return the file as a response with headers
        return response()->download($firmwarePath, basename($firmwarePath), [
            'Content-type: application/octet-stream',
        ]);
    });

    // Request download software file
    Route::get('/retrieve/key/{id}', function ($id) {
        // Get Firmware object
        $firmware = Firmware::findOrFail($id);

        // Get AES secure key
        $AESKey = $firmware->AESKeys()->orderByDesc('id')->first();

        // base64 decode the key
        $secureKey = $AESKey->key;
        
        // Return the file as a response with headers
        return response()->make($secureKey, 200, [
            'Content-type: application/octet-stream',
            'Content-Disposition: attachment; filename=file.bin'
        ]);
    });

    // Session APIs
    Route::post('/new-session', [SessionAPIController::class, 'newSession']);
    Route::post('/session/clear', [SessionAPIController::class, 'clearDTC']);
    Route::post('/session/refresh/dtcs', [SessionAPIController::class, 'refreshDTCs']);
    Route::post('/session/refresh/monitors', [SessionAPIController::class, 'refreshMonitors']);
    Route::post('/session/close', [SessionAPIController::class, 'closeSession']);
    
});

