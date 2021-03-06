<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Job;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Auth;
use App\WorkingDay;
use App\Assignment as Assignment;
use App\WantedHairstyle as WantedHairstyle;
use Image;
use Illuminate\Support\Facades\Response;
use App\CommentAndStar as CommentAndStar;
use DB;

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
      $data = User::with('roleNav')->where('role','=',2)->orderBy('last_name')->paginate(15);
      $working_days = WorkingDay::where('until',">=",Carbon::now())->get();
      $i = 0;
      $prosjek = array();
      foreach ($data as $item ){
      $count = DB::table('comments_and_stars')
            ->join('assignments', 'assignments.id', '=', 'comments_and_stars.assignment_id')
            ->join('working_days', 'working_days.id', '=', 'assignments.working_day_id')
            ->join('users', 'users.id', '=', 'working_days.user_id')
            ->where('users.id','=',$item->id)
            ->where('comments_and_stars.stars','>',0)
            ->select('comments_and_stars.stars')
            ->count();
        $sum = DB::table('comments_and_stars')
            ->join('assignments', 'assignments.id', '=', 'comments_and_stars.assignment_id')
            ->join('working_days', 'working_days.id', '=', 'assignments.working_day_id')
            ->join('users', 'users.id', '=', 'working_days.user_id')
            ->where('users.id','=',$item->id)
            ->where('comments_and_stars.stars','>',0)
            ->select('comments_and_stars.stars')
            ->sum('comments_and_stars.stars');
        if ($count > 0){
            $prosjek[$item->id] = $sum / $count;
        } else {
             $prosjek[$item->id] = 0;
        }
      }
      $user = Auth::user();
      //return $data[0]->working_days;
      return view('frizeri')->with('data', $data)->with('count', $numOf)->with("working_days",$working_days)->with("prosjek", $prosjek)->with('customer',$user);
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
     $comments = CommentAndStar::all();
        if ($hairdresser && $hairdresser->hasRole('hairdresser')) {
            $working_days = WorkingDay::where('user_id', $frizer_id)->where('until', ">=", Carbon::now())->paginate(5);
            $favorites = User::where('favorite_hairdresser', $frizer_id)->count();
            return view('frizer')->with("hairdresser", $hairdresser)->with("working_days", $working_days)->with('favorites', $favorites)->with('comments_and_stars',  $comments);
        } else {
            return back();
        }
    }

    public function showPicture($id)
    {
        $picId =  Assignment::findOrFail($id);
        $picture = WantedHairstyle::findOrFail($picId->wanted_hairstyle_id);
        $pic = Image::make($picture->picture);
        $response = Response::make($pic->encode('jpeg'));

        //setting content-type
        $response->header('Content-Type', 'image/jpeg');

        return $response;
    }

    public function showPictureRating($id)
    {
       
        $picture = CommentAndStar::where('id','=',$id)->first();
        $pic = Image::make($picture->picture);
        $response = Response::make($pic->encode('jpeg'));

        //setting content-type
        $response->header('Content-Type', 'image/jpeg');

        return $response;
    }
}
