<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Job;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }
    public function cjenik()
    {
        $jobs = Job::paginate(12);
        return view('cjenik')->with('jobs', $jobs);
    }

}
