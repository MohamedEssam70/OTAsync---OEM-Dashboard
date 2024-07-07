<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RSAencryptionAPIController extends Controller
{
    public function getKey($type)
    {
        if ($type !== 'public' && $type !== 'private') {
            return response('Invalid key type', 400);
        }

        $path = base_path("{$type}_key.ppk");

        if (!file_exists($path)) {
            return response('Key file not found', 404);
        }

        $key = file_get_contents($path);
        return response($key);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }
}