<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use DB;
use Session;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{

protected function getLogout()
    {
    DB::statement('CALL actualizarestados(?)',array(Auth::user()->id));
	Auth::logout();
	Session::flush();
    return redirect('login');
    }


}
