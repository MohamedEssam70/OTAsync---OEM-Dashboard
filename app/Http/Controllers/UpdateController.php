<?php

namespace App\Http\Controllers;

use App\Models\Firmware;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class UpdateController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                "file" => 'required|max:1000000|'
            ]);

            // $fileExtension = $request->file('file')?->getClientOriginalExtension();

            // if(!in_array(Str::lower($fileExtension) , ["txt, bin"])){
            //     return response()->json([
            //         'success' => false,
            //         'error' => "Not valid firmware file",
            //     ], 422);
            // }

            $path = $request->file->store('storage/uploads','public');

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


    public function update(Request $request)
    {
        try {
            $request->validate([
                "firmwareFile" => 'required',
                "priority" => 'required',
                "schedule" => 'required',
                "name" => 'required',
                "version" => 'required',
                "status" => 'required',
            ]);

            if($request->schedule == "on")
            {
                $request->validate(["upgradeDate" => 'required']);
            }


            Firmware::create([
                'vehicle_model_id' => $request['vehicleModelId'],
                'name' => $request['name'],
                'version' => $request['version'],
                'firmwareFile' => $request['firmwareFile'],
                'priority' => $this->checkBoolean($request['priority']),
                'schedule' => $this->checkBoolean($request['schedule']),
                'upgradeDate' => $request['upgradeDate'],
                'status' => $request['status'],
                ]);

            return response()->json([
                'vehicleModelId' => $request->vehicleModelId,
                'name' => $request->name,
                'version' => $request->version,
                'status' => $request->status,
                'firmwareFile' => $request->firmwareFile,
                'priority' => $request->priority,
                'schedule' => $request->schedule,
                'upgradeDate' => $request->upgradeDate,
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'error' => ($e->errors())["file"],
            ], 422);
        }
    }

    private function checkBoolean($input)
    {
        if($input == 'false' || $input == 'off')
            return 0;
        if($input == 'true' || $input == 'on')
            return 1;
    }
}
