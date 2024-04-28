<?php

namespace App\Http\Controllers\Core;
use App\Http\Controllers\Controller;
use App\Models\Firmware;
use App\Models\Vehicle;
use App\Models\VehicleModel;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;



class ModelController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view("content.vehicles_model.index");
    }





    public function add(Request $request)
    {
        $rules = VehicleModel::$rules;
        VehicleModel::create($request->validate($rules));
        return redirect()->back();
    }

}
