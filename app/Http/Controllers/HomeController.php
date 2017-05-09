<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\WorkingDay;
use App\Assignment;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function termini(){
      //kako izracunat termine? (za korisnika)
      //1. za svaki dan pogledat working days, uzet start i end iz tablice
      //2. pogledat postojece termine gdje je start izmedju start i end-a povucenog iz working days
      //sortirano uzlazno po start_at
      //3. dohvatit duration od job_id-a od svakog od termina
      //napravit varijablu tipa [start , start_termina1], [endtermina1, startermina2]....[endterminaN, end]


      //za iduca 2 tjedna
      if(Auth::user()->hasRole('customer')){
      $working_days = WorkingDay::where('from',">=",Carbon::now()->addHours(-12))->where("from","<=",Carbon::now()->addHours(-12)->addWeeks(2))->get();
      $termini = [];
      foreach($working_days as $working_day){
        $start = $working_day->from;
        //$assgs = Assignment::where('working_day_id', $working_day->id)->get();
        foreach($working_day->assignments as $assg){
          $termin = new \stdClass();
          $termin->user = $working_day->user;
          $termin->start = $start;
          $termin->end = $assg->start_at;

          if($termin->end->gt(Carbon::now())){
            if($termin->start->lt(Carbon::now()))
              $termin->start = Carbon::now();
            array_push($termini, $termin);
          }
          $start = $assg->start_at->addMinutes($assg->job->duration_in_minutes);
        }
        $termin = new \stdClass();
        $termin->user = $working_day->user;
        $termin->start = $start;
        $termin->end = $working_day->until;
        array_push($termini, $termin);
      }
      //return $termini;
      return view('home')->with('termini', $termini)->with('today', Carbon::now());
    }
      //za frizera
      if(Auth::user()->hasRole('hairdresser')){
        $termini=[];
        $working_days = WorkingDay::where('user_id',Auth::user()->id)->get();
        foreach($working_days as $working_day){
          foreach($working_day->assignments as $assg){
            $termin = new \stdClass();
            $termin->user = $assg->user;
            $termin->start = $assg->start_at;
            $termin->id = $assg->id;
            $termin->end = $assg->start_at->addMinutes($assg->job->duration_in_minutes);
            array_push($termini, $termin);
          }
        }
        return view('home')->with('termini', $termini)->with('today', Carbon::now());
      }
      //dohvatit termine start = start_at end = start_at + time iz jobs

    }
}
