<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RequestAccountController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
    // Profile
    Route::get('/user/profile',[ProfileController::class, 'userProfile'])->name('user.profile');
    Route::post('/user/update', [ProfileController::class, 'update'])->name('profile.update');


    // Temp
    Route::get('pages/account', function(){return view("content.pages.pages-account-settings-account");});
    Route::get('pages/notifications', function(){return view("content.pages.pages-account-settings-notifications");});
    Route::get('pages/connections', function(){return view("content.pages.pages-account-settings-connections");});
    Route::get('pages/misc-error', function(){return view("content.pages.pages-misc-error");});
    Route::get('pages/misc-under-maintenance', function(){return view("content.pages.pages-misc-under-maintenance");});

    Route::get('cards/basic', function(){return view("content.cards.cards-basic");});

    Route::get('ui/accordion', function(){return view("content.user-interface.ui-accordion");});
    Route::get('ui/alerts', function(){return view("content.user-interface.ui-alerts");});
    Route::get('ui/badges', function(){return view("content.user-interface.ui-badges");});
    Route::get('ui/buttons', function(){return view("content.user-interface.ui-buttons");});
    Route::get('ui/carousel', function(){return view("content.user-interface.ui-carousel");});
    Route::get('ui/collapse', function(){return view("content.user-interface.ui-collapse");});
    Route::get('ui/dropdowns', function(){return view("content.user-interface.ui-dropdowns");});
    Route::get('ui/footer', function(){return view("content.user-interface.ui-footer");});
    Route::get('ui/list-groups', function(){return view("content.user-interface.ui-list-groups");});
    Route::get('ui/modals', function(){return view("content.user-interface.ui-modals");});
    Route::get('ui/navbar', function(){return view("content.user-interface.ui-navbar");});
    Route::get('ui/offcanvas', function(){return view("content.user-interface.ui-offcanvas");});
    Route::get('ui/pagination-breadcrumbs', function(){return view("content.user-interface.ui-pagination-breadcrumbs");});
    Route::get('ui/progress', function(){return view("content.user-interface.ui-progress");});
    Route::get('ui/spinners', function(){return view("content.user-interface.ui-spinners");});
    Route::get('ui/tabs-pills', function(){return view("content.user-interface.ui-tabs-pills");});
    Route::get('ui/toasts', function(){return view("content.user-interface.ui-toasts");});
    Route::get('ui/tooltips-popovers', function(){return view("content.user-interface.ui-tooltips-popovers");});
    Route::get('ui/typography', function(){return view("content.user-interface.ui-typography");});

    Route::get('extended/ui-perfect-scrollbar', function(){return view("content.extended-ui.extended-ui-perfect-scrollbar");});
    Route::get('extended/ui-text-divider', function(){return view("content.extended-ui.extended-ui-text-divider");});

    Route::get('icons/boxicons', function(){return view("content.icons.icons-boxicons");});

    Route::get('forms/basic-inputs', function(){return view("content.form-elements.forms-basic-inputs");});
    Route::get('forms/input-groups', function(){return view("content.form-elements.forms-input-groups");});

    Route::get('form/layouts-vertical', function(){return view("content.form-layout.form-layouts-vertical");});
    Route::get('form/layouts-horizontal', function(){return view("content.form-layout.form-layouts-horizontal");});

    Route::get('tables/basic', function(){return view("content.tables.tables-basic");});
});