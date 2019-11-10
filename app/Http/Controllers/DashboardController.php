<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Job;
use Auth;

class DashboardController extends Controller
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
        $user = User::find(auth()->user()->id);
        $role = $user->role()->first()->name;
        
        $jobs = Job::where("status", "=", "0")->get();
        return view('dashboard')->with(compact("role", "jobs"));
        
    }
}
