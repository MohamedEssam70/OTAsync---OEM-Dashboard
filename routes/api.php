<?php

use App\Http\Controllers\API\UserAPIController;
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

Route::middleware('api_key')->group(function() {
    Route::get('/download/{filename}', function ($filename) {
        $path = storage_path().'/'.'app/public/storage/uploads/'.$filename;
        return Response::download($path);
    });
    
});