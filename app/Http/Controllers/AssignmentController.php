<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\WorkingDay;
use App\Assignment as Assignment;
use App\CommentAndStar as CommentAndStar;
use App\User;
use App\Job;
use App\WantedHairstyle;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class AssignmentController extends Controller
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

      if (!Auth::user()->hasRole('customer') & !Auth::user()->hasRole('hairdresser')) {
          return redirect('/');
      }
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
        //TODO: validator
        $data = $request->all();

        $messages = [
           'required'    => 'Polje :attribute je obavezno!',
           'max'    => 'Polje :attribute ne smije biti veće od :size znaka.',
           'between' => 'Polje :attribute mora biti između :min - :max.',
           'digits_between' => 'Polje :attribute mora biti između :min - :max.',
            'min' => 'Polje :attribute mora biti veće od 6 znakova.',
            'numeric' => 'Polje :attribute se mora sastojati samo od brojeva.',
            'unique' => 'Već postoji korisnik s tom email adresom'
        ];
        $validator = Validator::make($data, [
                   'time' => 'required|numeric',
                   'job' => 'required|exists:jobs,id',
                   'hairdresser' => 'required|exists:users,id',
                   'hairstyle' => 'mimes:jpeg,jpg,png'
               ], $messages);

        if ($validator->fails()) {
            return redirect('termin')
                               ->withErrors($validator)
                               ->withInput();
        }


        //provjeri jos jednom jel termin zauzet (krug od 1h)
        $slobodno = true;
        $start_n = Carbon::createFromTimestamp($request->time);
        $job_id = $request->job;
        $job = Job::where('id', $job_id)->first();
        $time_start2 = clone $start_n;
        $time_end2 = clone $start_n;
        $end_n = clone $start_n;
        $end_n->addMinutes($job->duration_in_minutes);
        $hairdresser_id = $request->hairdresser;
        $working_days = WorkingDay::where('user_id',$hairdresser_id)->get()->pluck('id')->all();
        //usporedit startna vremena termina da se ne preklapaju sa novim terminom
        $assignments = Assignment::where('start_at', ">=", $start_n)->where('start_at', '<', $end_n)->whereIn("working_day_id",$working_days);
        //return $assignments->get();
        if ($assignments->count()>0) {
            $slobodno = false;
        }
        $assignments = Assignment::where('start_at', ">=", $time_start2->addHours(-1))->where('start_at', '<', $time_end2->addHours(1))->whereIn("working_day_id",$working_days)->get();

        foreach ($assignments as $assg) {
            $start = $assg->start_at;
            $end = clone $assg->start_at;
            $end->addMinutes($assg->job->duration_in_minutes);
            //usporedit kraj termina dal se preklapa sa pocetkom novog t.
            if ($end>$start_n && $end<=$end_n) {
                $slobodno = false;
                break;
            }
            //usporedit veliki termin da nije progutao novog termina koj je "unutar" postojeceg
            if ($start<=$start_n && $end>=$end_n) {
                $slobodno = false;
                break;
            }
        }
        if ($slobodno == true) {
            //upisi sliku u bazu
            //dd($request);
            //echo $request->hairstyle;
            $hairstyle_id = null;
            if ($request->hasFile('hairstyle')) {
                //kod za kompresanje i sejvanje slike u bazu
              $img = Image::make(Input::file('hairstyle')->getRealPath());
                $img->resize(null, 200, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $wantedHairstyle = new wantedHairstyle;
                $wantedHairstyle->picture = $img->encode('data-url');
                $wantedHairstyle->user_id = Auth::user()->id;
                $wantedHairstyle->save();
                $hairstyle_id = $wantedHairstyle->id;
            }
        //sa id-em upisi sve u assignments
        $assg = new Assignment;
            $assg->customer_id = Auth::user()->id;
            $assg->job_id = $job_id;
            $assg->start_at = $start_n;
            $assg->confirmed = 0;
            $assg->wanted_hairstyle_id = $hairstyle_id;
            $working_day = WorkingDay::where('user_id', $request->hairdresser)->where('from', "<=", $start_n)->where('until', ">=", $start_n)->first();
            $assg->working_day_id = $working_day->id;
            $assg->save();
            return redirect('/termini')->with('message',"Rezervirali ste termin");
        } else {
            return redirect('/termini')->with('greska',"Termin zauzet");
        }
    }
    public function mojiTermini(){
      $user = Auth::user();
      $currentTime = Carbon::now();
      $termini = Assignment::where('customer_id','=',$user->id)->orderBy('start_at', 'DESC')->get();
      return view('mojiTermini')->with('termini',$termini)->with('time',$currentTime);
    }

    public function terminDetails($id){
      $termin = Assignment::where('id','=',$id)->first();
      $komentari = CommentAndStar::where('assignment_id','=',$termin->id)->get();
      return view('termin')->with('termin',$termin)->with('komentari', $komentari);
    }

    public function prihvati($id){
      $termin = Assignment::where('id','=',$id)->first();
      $termin->confirmed = 1;
      $termin->save();
      return redirect()->back()->with('message',"Termin je prihvaćen!");
    }

    public function odbi($id){
       try {
            Assignment::where('id', '=', $id)->delete();
        } catch (Exception $e) {
            return redirect('/termini')->with('greska', 'Nije moguće obrisati zapis!');
        }
        return redirect('/termini')->with('message', 'Termin je odbijen i obrisan');
    }

    public function deleteTermin($id) {
        try {
            Assignment::where('id', '=', $id)->delete();
        } catch (Exception $e) {
            return redirect()->back()->with('greska', 'Nije moguće obrisati zapis!');
        }
        return redirect()->back()->with('message', 'Termin je uspješno obrisan.');
    } 

    public function komentiraj($id) {
        return view('komentar')->with('assingment_id', $id);
    }

    public function komentirajPost(Request $request) {
         $data = $request->all();
           $messages = [
    'required'    => 'Polje :attribute je obavezno!'
];
        $validator = Validator::make($data, [
            'komentar' => 'required'
        ], $messages);

        if ($validator->fails()) {
            return redirect('termin/' . $data['assignment_id'] .'/komentiraj')
                        ->withErrors($validator)
                        ->withInput();
        }
        
        if ($request->hasFile('hairstyle')) {
            $img = Image::make(Input::file('hairstyle')->getRealPath());
                $img->resize(null, 200, function ($constraint) {
                    $constraint->aspectRatio();
                });
CommentAndStar::create([
             'assignment_id' => $data['assignment_id'],
             'comment' => $data['komentar'],
             'stars' => $data['Star-input'],
             'picture' => $img->encode('data-url'),
              'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
         ]);
        } else {
         CommentAndStar::create([
             'assignment_id' => $data['assignment_id'],
             'comment' => $data['komentar'],
             'stars' => $data['Star-input'],
              'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
         ]);
        }

       return redirect('termini/moji')->with('message', 'Termin je uspješno komentiran.');
    }
}
