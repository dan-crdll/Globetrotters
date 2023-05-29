<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Hash;

class LandingController extends BaseController
{
    public function showLogin()
    {
        if (!Session::get('user_id')) {
            return view('login');
        } else {
            return redirect('home');
        }
    }

    public function login(Request $req)
    {
        $username = $req->username;
        $password = $req->password;

        $res = Account::all()->where("USERNAME", $username)->first();

        $error = "username e/o password non validi";
        if (!$res) {
            return view('login')
                ->with('error', $error);
        } else {

            if (Hash::check($password, $res->PASSWORD)) {
                Session::put('user_id', $res->ID);
                Session::put('username', $username);
                return redirect('home');
            } else {
                return view('login')
                    ->with('error', $error);
            }
        }
    }

    public function signUp(Request $req)
    {
        $validated = $req->validate([
            'username' => ['required', 'unique:App\Models\Account,USERNAME', 'regex:/^[a-zA-Z][a-zA-Z0-9_]*$/'],
            'password' => ['required', 'regex:/^(?=.*[!@#$%^&*])(?=.*[A-Z])(?=.*[0-9]).{8,}$/'],
            'name' => ['required', 'regex:/^[a-zA-ZÀ-ÿ\s]+$/'],
            'surname' => ['required', 'regex:/^[a-zA-ZÀ-ÿ\s]+$/'],
            'email' => ['required', 'unique:App\Models\Account,EMAIL', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/']
        ]);

        $username = $req->username;
        $password = $req->password;
        $name = $req->name;
        $surname = $req->surname;
        $email = $req->email;

        $account = new Account;
        $account->NAME = $name;
        $account->SURNAME = $surname;
        $account->EMAIL = $email;
        $account->USERNAME = $username;
        $account->PASSWORD = Hash::make($password);

        $account->save();

        Session::put('user_id', $account->id);
        Session::put('username', $username);
        return redirect('home');
    }

    public function showSignUp()
    {
        if (!Session::get('user_id')) {
            return view('signup');
        } else {
            return redirect('home');
        }
    }

    public function checkUserExists($username)
    {
        $res = Account::where('USERNAME', "=", $username);
        if ($res->count() > 0) {
            return ['present' => true];
        } else {
            return ['present' => false];
        }
    }

    public function checkEmailExists($email)
    {
        $res = Account::where('EMAIL', "=", $email);
        if ($res->count() > 0) {
            return ['present' => true];
        } else {
            return ['present' => false];
        }
    }
}
