<?php

namespace App\Http\Controllers\FOTA;
use App\Http\Controllers\Controller;


class OTAUploadController extends Controller
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
        return view("content.dashboard.fota.ota-uplaod");
    }
}
