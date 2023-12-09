<?php

namespace App\Http\Controllers\Setup; 
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ServerConnectionController extends Controller
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
        return view("content.dashboard.setup.server-connection");
    }
}
