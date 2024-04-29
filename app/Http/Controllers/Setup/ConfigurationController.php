<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use App\Models\APIKey;
use App\Models\Vehicle;
use Illuminate\Http\Request;

use Spatie\Crypto\Rsa\KeyPair;
use Spatie\Crypto\Rsa\PrivateKey;
use Spatie\Crypto\Rsa\PublicKey;

class ConfigurationController extends Controller
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

        // $encryptedFilePath = storage_path('app/public/firmwares/662ee312d9e36.bin');
        // $privateKey = PrivateKey::fromFile(base_path('/private_key.ppk'));
        // $fileContents = file_get_contents($encryptedFilePath);
        // $decryptedData = $privateKey->decrypt($fileContents); // returns 'my secret data'
        // // Path where the encrypted file will be stored
        // $outputPath = storage_path('app/public/output/662ee312d9e36.bin');
        // // Save the decrypted data to a file
        // file_put_contents($outputPath, $decryptedData);

        $apiKeys = APIKey::get();
        $vehicles = Vehicle::pluck('pin', 'id');
        return view("content.dashboard.setup.security", compact('apiKeys', 'vehicles'));
    }

    public function createKey(Request $request) {
        $validated = $request->validate(APIKey::$rules);
        APIKey::create($validated);
        return redirect()->back();
    }
}
