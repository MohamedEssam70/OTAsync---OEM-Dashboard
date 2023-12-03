<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RequestAccountController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * request account view.
     *
     * @param  Request $request
     */
    public function index(Request $request)
    {
        return view("content.authentications.auth-register-basic");
    }

    /**
     * Create a new user request after a valid registration.
     *
     * @param  Request $request
     */
    public function store(Request $request)
    {
        dd($request->all());
    }
}
