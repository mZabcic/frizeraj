<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/termini';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $messages = [
    'required'    => 'Polje :attribute je obavezno!',
    'max'    => 'Polje :attribute ne smije biti veće od :size znaka.',
    'between' => 'Polje :attribute mora biti između :min - :max.',
    'email'      => 'Polje :attribute mora imati format email-a.',
    'confirmed' => 'Polje :attribute mora biti potvrđena.',
     'min' => 'Polje :attribute mora biti veće od 6 znakova.',
     'unique' => 'Već postoji korisnik s tom email adresom'
];
        return Validator::make($data, [
            'Ime' => 'required|max:255',
            'Prezime' => 'required|max:255',
            'Email' => 'required|email|max:255|unique:users',
            'Lozinka' => 'required|min:6|confirmed',
        ], $messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'first_name' => $data['Ime'],
            'last_name' => $data['Prezime'],
            'email' => $data['Email'],
            'password' => bcrypt($data['Lozinka']),
            'role' => 1,
            'favorite_hairdresser' => null
        ]);
    }
}
