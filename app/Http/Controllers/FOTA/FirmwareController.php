<?php

namespace App\Http\Controllers\FOTA;
use App\Http\Controllers\Controller;
use App\Models\Firmware;
use App\Models\Vehicle;
use App\Models\VehicleModel;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;



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

    public function store(Request $request)
    {
        try {
            $request->validate([
                "file" => 'required|max:1000000|'
            ]);

            $path = $request->file('file')->store('firmwares','public');

            return response()->json([
                'fileName' => pathinfo($path)['basename']
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'error' => ($e->errors())["file"],
            ], 422);
        }
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
        try {
            $request->validate([
                "firmwareFile" => 'required',
                "schedule" => 'required',
                "name" => 'required',
                "version" => 'required|unique:firmwares,name',
                "status" => 'required',
                "vehicle_model_id" => 'required',
                "priority" => 'required',
            ]);

            if($request->schedule == "on")
            {
                $request->validate(["upgradeDate" => 'required']);
            }

            $input = $request->all();
            $input['priority'] = $this->checkBoolean($input['priority']);
            $input['schedule'] = $this->checkBoolean($input['schedule']);

            $firmware = Firmware::create($input);

            return response()->json($firmware->toArray());
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'error' => ($e->errors()),
            ], 422);
        }

    }

    private function checkBoolean($input)
    {
        $input = Str::lower($input);
        if($input == 'false' || $input == 'off')
            return 0;
        if($input == 'true' || $input == 'on')
            return 1;
    }

}
