<?php

namespace App\Http\Controllers\Setup; 
use App\Http\Controllers\Controller;

use App\Models\MacTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class SystemCustomizeController extends Controller
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
        $macs = MacTypes::all();
        return view("content.dashboard.setup.system-customize", compact('macs'));
    }

    public function create(Request $request)
    {
        // $mac = new MacTypes;
        // // $mac->name = $request->input('macname');

        $rules = MacTypes::$rules;
        // $this->validate($request, $rules);

        // $mac->save($request);

        MacTypes::create($request->validate($rules));


        return Redirect::back();
    }
}
