<?php

namespace App\Http\Controllers;

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
        return view('content.dashboard.user', compact('user'));
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
