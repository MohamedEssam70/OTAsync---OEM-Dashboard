<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use App\Models\AESKey;
use App\Models\APIKey;
use App\Models\Vehicle;
use Illuminate\Http\Request;

use Spatie\Crypto\Rsa\KeyPair;
use Spatie\Crypto\Rsa\PrivateKey;
use Spatie\Crypto\Rsa\PublicKey;

use phpseclib3\Crypt\AES;
use phpseclib3\Crypt\RSA;
use phpseclib3\Math\BigInteger;

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
        // Test Decription
        // $encryptedFilePath = storage_path('app/public/firmwares/6639206cd02ad.bin');
        // $privateKey = PrivateKey::fromFile(base_path('/private_key.ppk'));
        // $fileContents = file_get_contents($encryptedFilePath);
        // $decryptedData = $privateKey->decrypt($fileContents); // returns 'my secret data'
        // // Path where the decrypted file will be stored
        // $outputPath = storage_path('app/public/output/6639206cd02ad.bin');
        // // Save the decrypted data to a file
        // file_put_contents($outputPath, $decryptedData);

        // Path to the public key file
        $privateKeyPath = base_path('/private_key.ppk');
        // Load the public key
        $privateKey = RSA::loadPrivateKey(file_get_contents($privateKeyPath));
        

        // Initialize AES object with CBC mode and IV
        $encryptedAesKey = AESKey::first()->key;
        $aesKey = $privateKey->decrypt($encryptedAesKey);

        $ivPath = base_path('/IV.pem');
        $iv = file_get_contents($ivPath);

        $aes = new AES('cbc');
        $aes->setKey($aesKey);
        $aes->setIV($iv);

        // Load the encrypted plaintext
        $encryptedFilePath = storage_path('app/public/firmwares/66397e6247fed.bin');
        $encryptedPlaintext = file_get_contents($encryptedFilePath);
        // Decrypt the plaintext with AES
        $plaintext = $aes->decrypt($encryptedPlaintext);
        // Save the decrypted plaintext
        $outputPath = storage_path('app/public/output/AEStest.bin');
        file_put_contents($outputPath, $plaintext);


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