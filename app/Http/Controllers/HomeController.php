<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Job;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Auth;
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
      $numOf = User::with('roleNav')->where('role','=',2)->count();
      $data = User::with('roleNav')->where('role','=',2)->orderBy('last_name')->paginate(13);
      $working_days = WorkingDay::where('until',">=",Carbon::now())->get();
      //return $data[0]->working_days;
      return view('frizeri')->with('data', $data)->with('count', $numOf)->with("working_days",$working_days);
    }


    public function omiljeniFrizer($id, Request $request)
    {
      if(Auth::guest())
        return "";
        if (Auth::user()->hasRole('customer')) {
            $hairdresser = User::where('id', $id)->where('role', Role::where('name', 'hairdresser')->first()->id)->first();
            if ($hairdresser) {
                $user = User::where('id', Auth::user()->id)->first();
                $user->favorite_hairdresser = $id;
                $user->save();
                return 1;
            }
        }
    }
    public function frizer($frizer_id)
    {
        $hairdresser = User::where('id', $frizer_id)->first();
        if ($hairdresser && $hairdresser->hasRole('hairdresser')) {
            $working_days = WorkingDay::where('user_id', $frizer_id)->where('until', ">=", Carbon::now())->paginate(5);
            $favorites = User::where('favorite_hairdresser', $frizer_id)->count();
            return view('frizer')->with("hairdresser", $hairdresser)->with("working_days", $working_days)->with('favorites', $favorites);
        } else {
            return back();
        }
    }
}
