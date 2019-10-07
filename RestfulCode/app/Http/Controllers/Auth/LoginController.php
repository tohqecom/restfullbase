<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
        // $this->middleware('guest')->except('logout');
        $this->middleware('auth:web', ['except' => ['login']]);
    }

    public function login() {
        $credentials = request(['email', 'password']);
// dd(auth()->attempt($credentials));
        if (! $token = auth()->attempt($credentials)) {
            $this->redirectTo = '/welcome';
        }
// dd(auth()->factory()->getTTL());
        return redirect('/chat');
    }

    public function logout() {
        if (Auth::logout()) {
            redirect('/welcome');
        }
    }
}
