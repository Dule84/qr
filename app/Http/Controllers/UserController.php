<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;

class UserController extends Controller
{
    public function postSignup(Request $request)
    {
        $this->validate($request, [
            'email' => 'email|required|unique:users',
            'name' => 'required',
            'password' => 'required|min:4',
            'city' => 'required',
            'address' => 'required',
            'category' => 'required'
        ],[
            'email.required' => 'Email je obavezan!',
            'email.email' => 'Email mora sadrzati znak @!',
            'email.unique' => 'Email adresa je vec zauzeta!',
            'name.required' => 'Ime je obavezno!',
            'city.required' => 'Grad je obavezan!',
            'address.required' => 'Adresa je obavezna!',
            'password.required' => 'Lozinka je obavezna!',
            'password.min' => 'Lozinka mora imati vise od 4 karaktera!',
            'category.required' => 'Morate odabrati vrstu trgovine!'
        ]);

        $unique_str = str_random(60);
        

        $array_from_to = array(
                         ' ' => '-',      
                         'Č' => 'C',
                         'Đ' => 'Dj',
                         'Š' => 'S',
                         'Ž' => 'Z');
            
        $file = strtr($request->input('name'),$array_from_to);

        $city = strtr($request->input('city'),$array_from_to);

        mkdir(public_path('images/'.strtolower($file).'-'.$unique_str), 0755, true);

        $user = new User([
            'email' => $request->input('email'),
            'name' => $request->input('name'),
            'city' => $request->input('city'),
            'city_slug' => strtolower($city),
            'address' => $request->input('address'),
            'category' => $request->input('category'),
            'is_activated' => 0,
            'password' => bcrypt($request->input('password')),
            'directorium' => strtolower($file),
            'unique_str' => $unique_str,
            'slug' => strtolower($file)
        ]);

        $user->save();

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    public function postSignin(Request $request)
    {
        $this->validate($request, [
            'email' => 'email|required',
            'password' => 'required',
        ],[
            'email.required' => 'Email je obavezan!',
            'email.email' => 'Email mora sadrzati znak @!',
            'password.required' => 'Lozinka je obavezna!'
        ]);

//	dd($request->all());


        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        
            return redirect()->route('dashboard');
        }
        return redirect()->route('signin');
    }

    public function getLogout() {
        Auth::logout();
	Session::remove('password_hash');
	//Session::flush();
        return redirect()->route('signin');
    }
}
