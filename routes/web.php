<?php

use App\Http\Controllers\Core\LiveDataController;
use App\Http\Controllers\Core\ModelController;
use App\Http\Controllers\Core\SensorController;
use App\Http\Controllers\Core\VehicleController;
use App\Http\Controllers\ModelsController;
use App\Http\Controllers\MonitorController;
use App\Http\Controllers\UpdateController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisterController;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\Account\ProfileController;
use App\Http\Controllers\Account\ActivityLogController;
use App\Http\Controllers\Account\SettingController;

use App\Http\Controllers\Setup\ConfigurationController;

use App\Http\Controllers\Core\DiagnosticController;

use App\Http\Controllers\Core\OTAController;
use App\Http\Controllers\Core\FirmwaresController;


use App\Http\Controllers\Org\TeamMembersController;
use App\Http\Controllers\Org\JoinRequestController;


use App\Http\Controllers\UnderMaintenanceController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes(["register"=>false]);


// Authintication
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('home', [HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'auth'], function() {
    Route::get('request', [RegisterController::class, 'index'])->name('register-show');
    Route::post('request/store', [RegisterController::class, 'store'])->name('request-acc');
});

Route::group(['middleware' => 'auth'], function(){
    // Account
    Route::get('/user/profile',[ProfileController::class, 'userProfile'])->name('user.profile');
    Route::post('/user/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/user/setting',[SettingController::class, 'index'])->name('user.setting');
    Route::get('/user/activity',[ActivityLogController::class, 'index'])->name('user.activity');


    // Settup
    Route::get('/security', [ConfigurationController::class, 'keys'])->name('security.keys');
    Route::post('/security/create-key', [ConfigurationController::class, 'createKey'])->name('security.keys.create');
    Route::get('/security/encryption', [ConfigurationController::class, 'encryption'])->name('security.encryption');

    // Diagnostic
    Route::get('diagnostic/dtc', [DiagnosticController::class, 'dtc_index'])->name('dtc.index');
    Route::post('diagnostic/dtc/add', [DiagnosticController::class, 'dtc_add'])->name('dtc.add');
    Route::get('/session', [DiagnosticController::class, 'index'])->name('sessions');
    Route::get('/session/{id}', [DiagnosticController::class, 'session_view'])->name('session.view');
    Route::get('/session/{id}/data-live', [LiveDataController::class, 'index'])->name('data.live');

    // Firmware
    Route::get('firmware', [OTAController::class, 'index'])->name('firmwares');
    Route::get('firmware/add', [OTAController::class, 'add_view'])->name('firmware.add.view');
    Route::get('firmware/selectpicker/model/{id?}', [OTAController::class, 'model_selector'])->name('firmware.model.selector');
    Route::post('firmware/store', [OTAController::class, 'store'])->name('firmware.store');
    Route::post('firmware/submit', [OTAController::class, 'add'])->name('firmware.submit');

    // Vehicles Model
    Route::get('model', [ModelController::class, 'index'])->name('models');
    Route::post('model/add', [ModelController::class, 'add'])->name('model.add');

    // Vehicles
    Route::get('model/vehicle/{id}', [VehicleController::class, 'index'])->name('vehicles');
    Route::post('model/vehicle/{id}/add', [VehicleController::class, 'add'])->name('vehicle.add');


    // Team
    Route::get('team', [TeamMembersController::class, 'index'])->name('team');
    Route::get('/join-requests', [JoinRequestController::class, 'index'])->name('requests.list');

    // Under Maintenance
    Route::get('/under-maintenance', [UnderMaintenanceController::class, 'index'])->name('under-maintenance');




    Route::group([], function () {
        if (app()->isLocal()) {

            /******************** MIGRATION ****************/
            Route::get("/migrate", function () {
                Artisan::call("migrate");
                return Artisan::output();
            });
            Route::get("/migrate/fresh", function () {
                Artisan::call("migrate:fresh");
                return Artisan::output();
            });
    
            Route::get("/storage/link", function () {
                Artisan::call("storage:link");
                return Artisan::output();
            });
    
            Route::get("/seed", function () {
                Artisan::call("db:seed");
                return Artisan::output();
            });
        }

        /******************** CACHE ****************/
        Route::get('/cache/clear', function () {
            $title = __('all.clear_cache');
    
            $output = "";
            Artisan::call('cache:clear');
            $output .= "<br/>";
            $output .= Artisan::output();
            Artisan::call('view:clear');
            $output .= "<br/>";
            $output .= Artisan::output();
            Artisan::call('route:clear');
            $output .= "<br/>";
            $output .= Artisan::output();
            Artisan::call('config:clear');
            $output .= "<br/>";
            $output .= Artisan::output();
            
            return $output;
        })->name("clear-cache");
    });

});