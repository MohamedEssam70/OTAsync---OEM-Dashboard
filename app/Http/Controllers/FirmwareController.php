<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class FirmwareController extends Controller
{
    public function store(Request $request,$type="file")
    {
        try {
            $request->validate([
                "file" => 'required|max:10000'
            ]);

            // $fileExtension = $request->file('file')?->getClientOriginalExtension();

            // if(!in_array(Str::lower($fileExtension) , ["jpg" , "jpeg" , "png"])){
            //     return response()->json([
            //         'success' => false,
            //         'error' => "Not valid image",
            //     ], 422);
            // }

            $input = $request->file('file');

            

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'error' => ($e->errors())["file"],
            ], 422);
        }
    }
}
