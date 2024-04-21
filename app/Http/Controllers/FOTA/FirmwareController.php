<?php

namespace App\Http\Controllers\FOTA;
use App\Http\Controllers\Controller;
use App\Models\Firmware;
use App\Models\Vehicle;
use App\Models\VehicleModel;
use Illuminate\Http\Request;


class FirmwareController extends Controller
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
        return view("content.firmware.index");
    }
    public function firmware_upload_index()
    {
        return view("content.firmware.manage");
    }

    public function add_view()
    {
        $models = VehicleModel::all();
        $vehicles = Vehicle::all();
        return view("content.firmware.add", compact("models", "vehicles"));
    }

    public function model_selector($id)
    {
        $model = VehicleModel::findOrFail($id);
        return response()->json($model->vehicles->pluck('vin', 'id'));
    }

    public function add(Request $request)
    {
        // dd($request->all());
        // $rules = Firmware::$rules;
        Firmware::create($request->all());
    }

}
