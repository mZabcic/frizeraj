<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\WorkingDay;
use App\Assignment;
use App\User;
use App\Job;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
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
    public function termini()
    {
        //kako izracunat termine? (za korisnika)
      //1. za svaki dan pogledat working days, uzet start i end iz tablice
      //2. pogledat postojece termine gdje je start izmedju start i end-a povucenog iz working days
      //sortirano uzlazno po start_at
      //3. dohvatit duration od job_id-a od svakog od termina
      //napravit varijablu tipa [start , start_termina1], [endtermina1, startermina2]....[endterminaN, end]


      //za iduca 2 tjedna
      if (Auth::user()->hasRole('customer')) {
          $working_days = WorkingDay::where('from', ">=", Carbon::now()->addHours(-12))->where("from", "<=", Carbon::now()->addHours(-12)->addWeeks(2))->get();
          $termini = [];
          foreach ($working_days as $working_day) {
              $start = $working_day->from;
              foreach ($working_day->assignments as $assg) {
                  $termin = new \stdClass();
                  $termin->user = $working_day->user;
                  $termin->start = $start;
                  $termin->end = $assg->start_at;
              //provjera jel ovo vrijeme proslo? i jel start jednak endu
            if ($termin->end->gt(Carbon::now()) && $termin->start != $termin->end) {
                if ($termin->start->lt(Carbon::now())) {
                    $termin->start = Carbon::now();
                }
                array_push($termini, $termin);
            }
                  $start = $assg->start_at->addMinutes($assg->job->duration_in_minutes);
              }

              //provjera jel ovo vrijeme proslo?
              $termin = new \stdClass();
              $termin->user = $working_day->user;
              $termin->start = $start;
              $termin->end = $working_day->until;
              if ($termin->end->gt(Carbon::now()) && $termin->start != $termin->end) {
                  if ($termin->start->lt(Carbon::now())) {
                      $termin->start = Carbon::now();
                  }
                  array_push($termini, $termin);
              }
          }
          //dd($termini);
          return view('termini')->with('termini', $termini)->with('today', Carbon::now());
      }


      //za frizera
      if (Auth::user()->hasRole('hairdresser')) {
          $termini=[];
          $working_days = WorkingDay::where('user_id', Auth::user()->id)->get();
          foreach ($working_days as $working_day) {
              foreach ($working_day->assignments as $assg) {
                  $termin = new \stdClass();
                  $termin->user = $assg->user;
                  $termin->start = $assg->start_at;
                  $termin->id = $assg->id;
                  $termin->end = $assg->start_at->addMinutes($assg->job->duration_in_minutes);
                  array_push($termini, $termin);
              }
          }
          return view('termini')->with('termini', $termini)->with('today', Carbon::now());
      }
      //dohvatit termine start = start_at end = start_at + time iz jobs
    }



    public function rasponTermina($frizer_id, $from, $to)
    {
        $from_date = Carbon::createFromTimestamp($from);
        $to_date = Carbon::createFromTimestamp($to);
        $times = [];
        $time = $from_date;
        while ($time<$to_date) {
            array_push($times, $time);
            $time = clone $time;
            $time->addMinutes(15);
        }
        $hairdresser = User::where('id', $frizer_id)->first();
        $jobs = Job::all();
        return view('rasponTermina')->with('times', $times)->with("hairdresser", $hairdresser)->with('jobs', $jobs);
    }
    public function rezervacijaTermina(Request $request)
    {
        //TODO: verifikator, sliku kompresat i spremit u bazu!
        //TODO: fixat kod za termine
        //provjeri jos jednom jel termin zauzet (krug od 1h)
        $slobodno = true;
        $time = Carbon::createFromTimestamp($request->time);
        $job_id = $request->job;
        $job = Job::where('id', $job_id)->first();
        //prvo za pocetna vremena, da se ne poklapaju
        $assignments = Assignment::where('start_at', ">=", Carbon::now())->where('start_at', '<=', Carbon::now()->addMinutes($job->duration_in_minutes));
        return $assignments->get();
        if ($assignments->count()>0) {
            $slobodno = false;
        }
        //zatim za krajnja vremena da se ne preklapaju
        $assignments = Assignment::where('start_at', ">=", Carbon::now()->addHours(-1))->where('start_at', '<=', Carbon::now()->addHours(1))->get();

        foreach ($assignments as $assg) {
            $start = $assg->start_at;
            $end = clone $assg->start_at->addMinutes($assg->job->duration_in_minutes);
            if ($time>=$start && $time<=$end) {
                $slobodno = false;
                echo "false";
                break;
            }
        }
        if ($slobodno == true) {
            //upisi sliku u bazu
            //dd($request);
            //echo $request->hairstyle;
            if ($request->hasFile('hairstyle'))
            {
              echo "lol";

            }
        //sa id-em upisi sve u assignments
        $assg = new Assignment;
            $assg->customer_id = Auth::user()->id;
            $assg->job_id = $job_id;
            $assg->start_at = $time;
            $assg->confirmed = 0;
            $assg->wanted_hairstyle_id = null;
            $working_day = WorkingDay::where('user_id', $request->hairdresser)->where('from', "<=", $time)->where('until', ">=", $time)->first();
            $assg->working_day_id = $working_day->id;
            $assg->save();
        } else {
            echo "termin zauzet";
        }
    }
}
