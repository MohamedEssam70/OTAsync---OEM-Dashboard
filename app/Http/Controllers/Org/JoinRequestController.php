<?php

namespace App\Http\Controllers\Org;
use App\Http\Controllers\Controller;


class JoinRequestController extends Controller
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
        return view("content.organization.join-request");
    }
}
