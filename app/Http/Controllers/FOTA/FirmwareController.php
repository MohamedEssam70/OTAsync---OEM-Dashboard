<?php

namespace App\Http\Controllers\FOTA;
use App\Http\Controllers\Controller;
use App\Models\Firmware;
use App\Models\Vehicle;
use App\Models\VehicleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Spatie\Crypto\Rsa\PublicKey;

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
                "file" => 'required|max:1000000'
            ]);

            $file = $request->file('file');

            // Generate a unique file name
            $fileName = uniqid().'.'.$file->getClientOriginalExtension();

            // Save the uploaded file to a temporary location
            $tempFilePath = $file->storeAs('temp', $fileName);

            // Path to the public key file
            $publicKeyPath = base_path('/public_key.ppk');

            // Path where the encrypted file will be stored
            $encryptedFilePath = storage_path('app/public/firmwares/'.$fileName);

            // Encrypt the uploaded file with the public key
            $this->encryptFileWithPublicKey(storage_path('app/'.$tempFilePath), $publicKeyPath, $encryptedFilePath);

            // Delete the temporary file
            Storage::delete($tempFilePath);

            return response()->json([
                'fileName' => $fileName
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

    public function model_selector($id = null)
    {
        $vehicles = Vehicle::query();
        if(!empty($id))
        {
            $vehicles = $vehicles->where('model', $id);
        }
        
        return response()->json($vehicles->pluck('vin', 'id'));
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

    // Function to encrypt file with public key
    private function encryptFileWithPublicKey($filePath, $publicKeyPath, $outputPath)
    {
        // Read the file contents
        $fileContents = file_get_contents($filePath);

        // Get public key contents
        $publicKey = PublicKey::fromFile($publicKeyPath);

        $encryptedData = $publicKey->encrypt($fileContents); // returns something unreadable

        // Save the encrypted data to a file
        file_put_contents($outputPath, $encryptedData);
    }
}
