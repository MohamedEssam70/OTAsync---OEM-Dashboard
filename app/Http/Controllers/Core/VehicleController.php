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



class VehicleController extends Controller
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
    public function index($id)
    {
        $model_id= $id;
        return view("content.vehicles.index", compact('model_id'));
    }





    public function add(Request $request, $id)
    {
        $rules = Vehicle::$rules;
        $input = $request->validate($rules);
        $input['model'] = $id;
        Vehicle::create($input);
        return redirect()->back();
    }

}
