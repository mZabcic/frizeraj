<?php

namespace App\Http\Controllers;

use App\User as User;
use App\Role as Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function customers()
    {
        $numOf = User::with('roleNav')->where('role','=',1)->count();
        $data = User::with('roleNav')->where('role','=',1)->orderBy('last_name')->paginate(13);
        return view('admin.users')->with('data', $data)->with('count', $numOf);
    }


    public function hairdressers()
    {
        $numOf = User::with('roleNav')->where('role','=',2)->count();
        $data = User::with('roleNav')->where('role','=',2)->orderBy('last_name')->paginate(13);
        return view('admin.hairdressers')->with('data', $data)->with('count', $numOf);
    }

     public function admins()
    {
        $numOf = User::with('roleNav')->where('role','=',3)->count();
        $data = User::with('roleNav')->where('role','=',3)->orderBy('last_name')->paginate(13);
        return view('admin.admins')->with('data', $data)->with('count', $numOf);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     //POST
    public function create(Request $request)
    {

        $data = $request->all();

        $messages = [
    'required'    => 'Polje :attribute je obavezno!',
    'max'    => 'Polje :attribute ne smije biti veće od :size znaka.',
    'between' => 'Polje :attribute mora biti između :min - :max.',
    'email'      => 'Polje :attribute mora imati format email-a.',
    'confirmed' => 'Polje :attribute mora biti potvrđena.',
     'min' => 'Polje :attribute mora biti veće od 6 znakova.',
     'unique' => 'Već postoji korisnik s tom email adresom'
];
        $validator = Validator::make($data, [
            'Ime' => 'required|max:255',
            'Prezime' => 'required|max:255',
            'Email' => 'required|email|max:255|unique:users',
            'Lozinka' => 'required|min:6|confirmed',
        ], $messages);

         if ($validator->fails()) {
            return redirect('admin/korisnici/novi')
                        ->withErrors($validator)
                        ->withInput();
        }

   try {
        User::create([
            'first_name' => $data['Ime'],
            'last_name' => $data['Prezime'],
            'email' => $data['Email'],
            'password' => bcrypt($data['Lozinka']),
            'role' => $data['Rola'],
            'favorite_hairdresser' => null,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
   } catch (Exception $e) {
       return redirect('admin/korisnici/novi')
                        ->with('greska', 'Greška s bazom podataka')
                        ->withInput();
    }
    if ($data['Rola'] == 1) {
    return redirect('admin/korisnici')
                        ->with('message', 'Korisnik ' . $data['Ime'] . ' ' . $data['Prezime'] . ' je dodan s ulogom Korisnik' );
    } else if ($data['Rola'] == 2 ){
        return redirect('admin/frizeri')
                        ->with('message', 'Korisnik ' . $data['Ime'] . ' ' . $data['Prezime'] . ' je dodan s ulogom Frizer' );
    } else {
        return redirect('admin/administratori')
                        ->with('message', 'Korisnik ' . $data['Ime'] . ' ' . $data['Prezime'] . ' je dodan s ulogom Administrator');
    }
                     


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         try {
        $user = User::where('id','=',$id)->first();
        } catch (Exception $e) {
            return redirect()->back()->with('greska', 'Nije moguće uredit zapis!');
        } 
        return view('admin.editUser')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
          $data = $request->all();

        $messages = [
    'required'    => 'Polje :attribute je obavezno!',
    'max'    => 'Polje :attribute ne smije biti veće od :size znaka.',
    'between' => 'Polje :attribute mora biti između :min - :max.',
    'email'      => 'Polje :attribute mora imati format email-a.',
    'confirmed' => 'Polje :attribute mora biti potvrđena.',
     'min' => 'Polje :attribute mora biti veće od 6 znakova.',
     'unique' => 'Već postoji korisnik s tom email adresom'
];
        $validator = Validator::make($data, [
            'Ime' => 'required|max:255',
            'Prezime' => 'required|max:255',
            'Email' => 'required|email|max:255'
        ], $messages);

         if ($validator->fails()) {
            return redirect('admin/korisnici/' . $data['Id'] .'/uredi')
                        ->withErrors($validator)
                        ->withInput();
        }
  try {
        $user = User::where('id','=',$data['Id'])->first();
        $test = User::where([['email','=',$data['Email']],  ['id', '<>', $data['Id']],])->count();
        if ($test > 0) {
             return redirect('admin/korisnici/' . $data['Id'] .'/uredi')
                        ->with('greska', 'Korisnik s emailom ' . $data['Email'] .' već postoji')
                        ->withInput();
        }
        $user->first_name =  $data['Ime'];
        $user->last_name =  $data['Prezime'];
        $user->email =  $data['Email'];
        $user->role =  $data['Rola'];
        $user->save();
  }  catch (Exception $e) {
            return redirect()->back()->with('greska', 'Nije moguće urediti zapis!');
        } 
           if ($data['Rola'] == 1) {
    return redirect('admin/korisnici')
                        ->with('message', 'Korisnik ' . $data['Ime'] . ' ' . $data['Prezime'] . ' je uređen s ulogom Korisnik' );
    } else if ($data['Rola'] == 2 ){
        return redirect('admin/frizeri')
                        ->with('message', 'Korisnik ' . $data['Ime'] . ' ' . $data['Prezime'] . ' je uređen s ulogom Frizer' );
    } else {
        return redirect('admin/administratori')
                        ->with('message', 'Korisnik ' . $data['Ime'] . ' ' . $data['Prezime'] . ' je uređen s ulogom Administrator');
    }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        try {
        User::where('id','=',$id)->delete();
        } catch (Exception $e) {
            return redirect()->back()->with('greska', 'Nije moguće obrisati zapis!');
        } 
        return redirect()->back()->with('message', 'Korisnik je uspješno obrisan.');
    }
}
