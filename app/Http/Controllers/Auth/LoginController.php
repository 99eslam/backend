<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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

    public function login(Request $request)
    {
        $this->validateLogin($request);

        // Check if the login attempt was successful
        if (Auth::attempt($this->credentials($request))) {
            $user = Auth::user();

            // Generate token using Sanctum or Passport (depending on what you're using)
            $token = $user->createToken('LoginToken')->plainTextToken;

            // Return the token (you can also return user details if needed)
            return response()->json([
                'token' => $token,
                'user' => $user,
            ], 200);
            // return redirect()->route('home');
        }

        // If login fails
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
