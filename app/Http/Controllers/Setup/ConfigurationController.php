<?php

namespace App\Http\Controllers\Setup;

use App\Enums\KeysTypes;
use App\Http\Controllers\Controller;
use App\Models\APIKey;
use App\Models\Vehicle;
use Illuminate\Http\Request;

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
