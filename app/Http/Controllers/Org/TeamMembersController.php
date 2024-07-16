<?php

namespace App\Http\Controllers\Org;
use App\Http\Controllers\Controller;

use App\Models\User;

class TeamMembersController extends Controller
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
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all();
        // dd($users);
        return view("content.organization.team-members", compact('users'));
    }
}
