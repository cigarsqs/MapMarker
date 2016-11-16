<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;

		$this->middleware('guest', ['except' => 'getLogout']);
	}

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|max:255',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     *
     */
    public function getLogin(Request $request)
    {
        return view('auth/login');
    }

    public function postLogin(Request $request)
    {
        //$input = $request->all();
        // $validator = validator($input);

        $username = $request->get('username');
        $password = $request->get('password');

        if(Auth::attempt(['username'=> $username, 'password' => $password])){
            return Redirect::action('User\UserController@getMapsForAuthUser');
        }else {
            return Redirect::guest('auth/login')
                ->withErrors('username or password is wrong!');
        }


    }

    public function getLogout()
    {
        if(Auth::check()){
            Auth::logout();
        }

        return Redirect::action('WelcomeController@index');
    }

}
