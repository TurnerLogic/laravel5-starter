<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
	/**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a user's dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard(Request $request)
    {
        return view('dashboard');
    }

}
