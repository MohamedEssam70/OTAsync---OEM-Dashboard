<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VehicleAPIController extends Controller{
    public function keepAlive(Request $request)
    {
        Vehicle::where('vin', $request->header('x-vehicle-vin'))->update(['keepalive' => Carbon::now()]);
        return response()->json(true);
    }

}