<?php

namespace App\Http\Controllers\Core;
use App\Http\Controllers\Controller;
use App\Models\DTCs;
use App\Models\Session;
use Illuminate\Http\Request;


class DiagnosticController extends Controller
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
        return view("content.diagnostic.sessions.index");
    }

    public function dtc_index()
    {
        return view("content.diagnostic.dtcs.index");
    }

    public function dtc_add(Request $request)
    {
        $rules = DTCs::$rules;
        $rules['type'] = $rules['type'] . "," .  $request->get('code');
        $rules['code'] = $rules['code'] . "," .  $request->get('type');
        DTCs::create($request->validate($rules));
        return redirect()->back();
    }

    public function session_view($id)
    {
        $session = Session::find($id);
        return view("content.diagnostic.sessions.view", compact('session'));
    }
}
