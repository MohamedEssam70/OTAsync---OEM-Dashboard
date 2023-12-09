<?php

namespace App\Http\Controllers\Account;
use App\Http\Controllers\Controller;

use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
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
    public function userProfile(Request $request)
    {
        // Check if $profile is the same as Auth::user()
        // If only the user can see his own profile

        $user = Auth::user();
        $countries = Country::all();
        return view('content.dashboard.account.user', compact('user', 'countries'));
    }

    public function update(Request $request)
    {
        $user=Auth()->user();

        $rules = User::$rules;
        $rules['email'] = $rules['email'] . ',' . $user->id;
        $this->validate($request, $rules);
        
        $user->update($request->except("avatar"));

        if($request->hasFile('avatar')){
            $filename = $request->avatar->getClientOriginalName();
            $request->avatar->storeAs('avatars',$filename,'public');
            $user->update(['avatar'=>$filename]);
        }

        return redirect()->back();
    }

}
