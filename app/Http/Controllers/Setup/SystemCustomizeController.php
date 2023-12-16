<?php

namespace App\Http\Controllers\Setup; 
use App\Http\Controllers\Controller;

use App\Models\Config;
use App\Models\Ecus;
use App\Models\MacModels;
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
        $config_mac = Config::first()->macid;
        // dd($config_mac);
        $macs = MacTypes::all();
        $models = MacModels::where('mac_id', $config_mac)->get();
        // dd($models);
        $ecus = Ecus::whereIn('mac_models_id', $models->pluck('id'))->get();
        // dd($ecus);
        return view("content.dashboard.setup.system-customize", compact('macs', 'models', 'ecus'));
    }

    public function create(Request $request)
    {
        $rules = MacTypes::$rules;
        MacTypes::create($request->validate($rules));
        return Redirect::back();
    }


    public function update(Request $request)
    {
        $config = Config::first();

        $rules = Config::$rules;
        $this->validate($request, $rules);
        // dd($request);
        $config->update(['macid' => $request->macid]);
        $this->index();
        return redirect()->back();
    }

    public function destroy($target, Request $request)
    {
        switch ($request->input('action'))
        {
            case 'add':
                break;
            
                case 'del':
                    $reports = $request->input('reports');
                    if(!empty($reports)) $keys = array_keys($reports);

                    if($target == 'model')
                    {
                        foreach($keys as $key)
                        {
                            $modelToDelete = MacModels::findOrFail($key);
                            $modelToDelete->ecus()->delete();
                            $modelToDelete->delete();
                        }
                    }
                    else if($target == 'ecu')
                    {
                        foreach($keys as $key)
                        {
                            $enuToDelete = ECUS::findOrFail($key);
                            $enuToDelete->delete();
                        }
                    }
                    else
                    {
                        // 
                    }
                    
                    break;
        }
        

        return Redirect::back();
    }
    // public function destroy(Request $request)
    // {
    //     $reports = $request->input('reports');
    //     $keys = array_keys($reports);
    //     foreach($keys as $key)
    //     {
    //         $modelToDelete = MacModels::findOrFail($key);
    //         $modelToDelete->ecus()->delete();
    //         $modelToDelete->delete();
    //     }
    //     // $modelToDelete = MacModels::find(key($reports));
    //     // dd($modelToDelete);

    //     return Redirect::back();
    // }

}
