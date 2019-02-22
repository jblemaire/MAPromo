<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\User;


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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'mailUser';
    }
	
	/**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $facebookUser = Socialite::driver('facebook')->user();
		$name = explode(" ", $facebookUser->getName());
       
		$user = User::where('provider_id', $facebookUser->getId())->first();
		
		if(!$user){
			//Register With Facebook
			$user = User::create([
				'nomUser' => $name[1],
				'prenomUser' => $name[0],
				'mailUser' => $facebookUser->getEmail(),
				'provider_id' => $facebookUser->getId(),
				'idRole' => 2,
			]);
		}
		
		//Login With Facebook
		Auth::login($user, true);
		
		return redirect($this->redirectTo);
    }
}
