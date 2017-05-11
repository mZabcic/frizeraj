<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Job;

class AdminJobsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function poslovi()
     {
         $jobs = Job::paginate(10);
         return view('admin.jobs')->with('jobs', $jobs);
     }
    public function dodajPosao()
    {
        return view('admin.createJob');
    }
    public function upisiPosao($id = 0, Request $request)
    {
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
                   'Ime' => 'required',
                   'Opis' => 'required',
                   'Trajanje' => 'required|numeric|between:15,45',
                   'Cijena' => 'required|numeric'
               ], $messages);

        if ($validator->fails()) {
            return redirect('admin/posao/dodaj')
                               ->withErrors($validator)
                               ->withInput();
        }

        try {
            Job::create([
                   'name' => $data['Ime'],
                   'description' => $data['Opis'],
                   'duration_in_minutes' => $data['Trajanje'],
                   'price' =>$data['Cijena'],
                   'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                   'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
               ]);
        } catch (Exception $e) {
            return redirect('admin/posao/dodaj')
                               ->with('greska', 'Greška s bazom podataka')
                               ->withInput();
        }
        return redirect('admin/poslovi')
                            ->with('message', 'Posao ' . $data['Ime'] . ' je dodan.' );

    }
    public function obrisiPosao($id, Request $request)
    {
        $job = Job::where('id', $id)->delete();
        return back()->with('message',"Posao je obrisan");
    }
}
