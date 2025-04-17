<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    protected function credentials($request)
    {
        return [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'active' => true,
        ];
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        $user = \App\Models\User::where('email', $request->email)->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => ['Cette adresse e-mail est inconnue.'],
            ]);
        }

        if ($user && !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Le mot de passe est incorrect.'],
            ]);
        }
    
        if ($user && !$user->active) {
            throw ValidationException::withMessages([
                'email' => ['Votre compte a été désactivé. Veuillez contacter un administrateur.'],
            ]);
        }
    
        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }
    
}
