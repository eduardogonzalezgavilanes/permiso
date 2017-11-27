<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use DB;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
       protected function redirectTo()
    {
       
            if (Auth::user()->estado == 0){
                DB::select('CALL actualizarestados(?)',array(Auth::user()->id));
                define('BOT_TOKEN','418313703:AAFNbJi6Bktm_hzx0BBombgauKckLvdVQYU');
                define('CHAT_ID','448027369');
                define('API_URL','https://api.telegram.org/bot'.BOT_TOKEN.'/');
               $msj="Secion Activa";
                        $queryArray=[ 
                        'chat_id'=> CHAT_ID,
                        'text'=>$msj, ];
                        $url='https://api.telegram.org/bot'.BOT_TOKEN.'/sendMessage?'.http_build_query($queryArray);
                        $result=file_get_contents($url);
                return 'home';
            }
            else {
                Auth::logout();
                Session::flush();
                return "/login";

            }

}

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
