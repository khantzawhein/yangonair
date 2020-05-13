<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AppFunctions\SensorDataStore;

class AdminController extends Controller
{
    //
    function __construct()
    {
        $this->middleware('auth');
    }
    function index() 
    {
        return view('admin.home');
    }
    function refresh() {
        SensorDataStore::store();
        return redirect()->back();
    }
    
}
