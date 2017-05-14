<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Job;
use App\User;
use App\WorkingDay;

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

    public function frizeri(){

    }
    public function frizer($frizer_id)
    {

        $hairdresser = User::where('id', $frizer_id)->first();
        if($hairdresser && $hairdresser->hasRole('hairdresser')){
          $working_days = WorkingDay::where('user_id', $frizer_id)->where('until',">=",Carbon::now())->paginate(5);
          $favorites = User::where('favorite_hairdresser', $frizer_id)->count();
          return view('frizer')->with("hairdresser", $hairdresser)->with("working_days",$working_days)->with('favorites', $favorites);
        }else{
          return back();
        }
    }

}
