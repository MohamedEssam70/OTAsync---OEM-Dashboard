<?php

namespace App\Http\Controllers;

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
                "file" => 'required|mimes:txt|max:1000000|'
            ]);

            $fileExtension = $request->file('file')?->getClientOriginalExtension();

            if(!in_array(Str::lower($fileExtension) , ["txt"])){
                return response()->json([
                    'success' => false,
                    'error' => "Not valid firmware file",
                ], 422);
            }

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
}
