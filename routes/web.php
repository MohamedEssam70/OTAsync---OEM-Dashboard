<?php

use App\Http\Controllers\Core\ModelController;
use App\Http\Controllers\Core\VehicleController;
use App\Http\Controllers\ModelsController;
use App\Http\Controllers\UpdateController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RequestAccountController;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\Account\ProfileController;
use App\Http\Controllers\Account\ActivityLogController;
use App\Http\Controllers\Account\SettingController;

use App\Http\Controllers\Setup\EncriptionConfigController;
use App\Http\Controllers\Setup\MqttConfigController;
use App\Http\Controllers\Setup\ServerConnectionController;
use App\Http\Controllers\Setup\SystemCustomizeController;

use App\Http\Controllers\Diagnostic\DiagnosticController;

use App\Http\Controllers\FOTA\FirmwareController;
use App\Http\Controllers\FOTA\OTAVersionsController;


use App\Http\Controllers\Org\TeamMembersController;
use App\Http\Controllers\Org\JoinRequestController;


use App\Http\Controllers\UnderMaintenanceController;

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
Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'auth'], function() {
    Route::get('request', [RequestAccountController::class, 'index'])->name('register-show');
    Route::post('request/store', [RequestAccountController::class, 'store'])->name('request-acc');
});

Route::group(['middleware' => 'auth'], function(){
    // Account
    Route::get('/user/profile',[ProfileController::class, 'userProfile'])->name('user.profile');
    Route::post('/user/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/user/setting',[SettingController::class, 'index'])->name('user.setting');
    Route::get('/user/activity',[ActivityLogController::class, 'index'])->name('user.activity');


    // Settup
    Route::get('/setup/system-customize', [SystemCustomizeController::class, 'index'])->name('system.customize');
    Route::post('/setup/add-mac', [SystemCustomizeController::class, 'create'])->name('mac.create');
    Route::post('/setup/insert/{target}', [SystemCustomizeController::class, 'insert'])->name('setup.insert');
    Route::post('/setup/system/update', [SystemCustomizeController::class, 'update'])->name('system.update');
    Route::delete('/setup/system/{target}', [SystemCustomizeController::class, 'destroy'])->name('system.destroy');

    Route::get('/setup/encription-config', [EncriptionConfigController::class, 'index'])->name('encription.config');
    Route::get('/setup/mqtt-config', [MqttConfigController::class, 'index'])->name('mqtt.config');
    Route::get('/setup/server-connection', [ServerConnectionController::class, 'index'])->name('server.connection');

    // Diagnostic
    Route::get('/diagnostic', [DiagnosticController::class, 'index'])->name('diagnostic');

    // Firmware
    Route::get('firmware', [FirmwareController::class, 'index'])->name('firmwares');
    Route::get('firmware/add', [FirmwareController::class, 'add_view'])->name('firmware.add.view');
    Route::get('firmware/selectpicker/model/{id}', [FirmwareController::class, 'model_selector'])->name('firmware.model.selector');
    Route::post('firmware/store', [FirmwareController::class, 'store'])->name('firmware.store');
    Route::post('firmware/submit', [FirmwareController::class, 'add'])->name('firmware.submit');

    // Vehicles Model
    Route::get('model', [ModelController::class, 'index'])->name('models');
    Route::post('model/add', [ModelController::class, 'add'])->name('model.add');

    // Vehicles
    Route::get('vehicle/{id}', [VehicleController::class, 'index'])->name('vehicles');
    Route::post('vehicle/{id}/add', [VehicleController::class, 'add'])->name('vehicle.add');



    Route::get('models', [ModelsController::class, 'index'])->name('models.manage');
    Route::get('models/show/{id}', [ModelsController::class, 'show'])->name('models.show');
    Route::get('firmware/update', [UpdateController::class, 'update'])->name('firmware.update');
    // Route::get('/download/{filename}', function ($filename) {
    //     $path = storage_path().'\\'.'app\\public\\storage\\uploads\\'.$filename;
    //     return Response::download($path);
    // });


    // Team
    Route::get('/team', [TeamMembersController::class, 'index'])->name('team');
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