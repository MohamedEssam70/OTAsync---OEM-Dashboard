<?php

namespace App\Http\Controllers\FOTA;
use App\Http\Controllers\Controller;
use App\Models\AESKey;
use App\Models\Firmware;
use App\Models\Vehicle;
use App\Models\VehicleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use phpseclib3\Crypt\AES;
use Spatie\Crypto\Rsa\PublicKey;
use phpseclib3\Crypt\RSA;
use phpseclib3\Math\BigInteger;



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
            $fileName = uniqid();
            $fileExtension = '.'.$file->getClientOriginalExtension();

            // Save the uploaded file to a temporary location
            $tempFilePath = $file->storeAs('temp', $fileName.$fileExtension);

            // Path to the public key file
            $publicKeyPath = base_path('/public_key.ppk');

            // Load the public key
            $publicKey = RSA::loadPublicKey(file_get_contents($publicKeyPath));

            // Generate a random AES key
            $aesKey = random_bytes(32); // 256-bit key for AES-256

            // IV for AES-CBC, 16 bytes
            $iv_path = base_path('/IV.pem');
            $iv = file_get_contents($iv_path); 


            // Initialize AES object with CBC mode and IV
            $aes = new AES('cbc');
            $aes->setKey($aesKey);
            $aes->setIV($iv);
            
            // Load the firmware file
            $firmwareData = file_get_contents(storage_path('app/'.$tempFilePath));

            // Encrypt the plaintext with AES
            $encryptedPlaintext = $aes->encrypt($firmwareData);

            // Encrypt the AES key with RSA
            $encryptedAesKey = $publicKey->encrypt($aesKey);
            
            // Path where the encrypted file will be stored
            $encryptedFilePath = storage_path('app/public/firmwares/'.$fileName.$fileExtension);
            $AES_key_path = storage_path('app/private/'.$fileName.'_AES.pem');
            // $AES_vi_path = storage_path('app/private/'.$fileName.'_VI.pem');

            // Save the encrypted AES key and encrypted plaintext
            file_put_contents($encryptedFilePath, $encryptedPlaintext);
            file_put_contents($AES_key_path, $encryptedAesKey);
            // file_put_contents($AES_vi_path, $encryptedIv);
            
            // Delete the temporary file
            Storage::delete($tempFilePath);

            return response()->json([
                'fileName' => $fileName.$fileExtension
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
            $fileName = explode(".", $firmware->firmwareFile)[0];
            $AES_key_path = storage_path('app/private/'.$fileName.'_AES.pem');
            $AES_key = file_get_contents($AES_key_path);
            $secureKey = AESKey::create(['key'=>$AES_key, 'firmware_id'=>$firmware->id]);

            // Storage::delete($AES_key_path);

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
