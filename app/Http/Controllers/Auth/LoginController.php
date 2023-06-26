<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\OwnerController;
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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->hasRole('owner')) {
            return redirect()->route('owner.dashboard.index');
        } elseif ($user->hasRole('staff')) {
            return redirect()->route('staff.dashboard.index');
        } else {
            return redirect('/');
        }
    }

    public function logout(Request $request)
    {
        if (Auth::check()) {
            // User is authenticated
            if (Auth::user()->hasRole('owner') || Auth::user()->hasRole('staff')) {
                // Perform additional actions or checks specific to 'owner' or 'staff'
            }

            // Perform logout action
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return redirect('/login');
    }
}
