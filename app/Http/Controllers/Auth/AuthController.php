<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
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

   use AuthenticatesAndRegistersUsers, ThrottlesLogins;

   /**
   * Where to redirect users after login / registration.
   *
   * @var string
   */
   protected $redirectTo = '';

   /**
   * Create a new authentication controller instance.
   *
   * @return void
   */
   public function __construct()
   {
      $this->middleware($this->guestMiddleware(), ['except' => 'logout']);

      if(Auth::guard()->guest()) {
      } else {
         $this->redirectTo = Auth::user()->role . '/dashboard';
      }
   }

   public function login(Request $request)
   {
      $this->validate($request, [
         'email' => 'required|email', 'password' => 'required',
      ]);

      $credentials = $this->getCredentials($request);

      // This section is the only change
      if (Auth::validate($credentials)) {
         $user = Auth::getLastAttempted();
         if ($user->is_active) {
            Auth::login($user, $request->has('remember'));
            return redirect()->intended($this->redirectPath());
         } else {
            return redirect('login') // Change this to redirect elsewhere
            ->withInput($request->only('email', 'remember'))
            ->with([
               'message' => 'User account not active.'
            ]);
         }
      }

      return redirect('login')
      ->withInput($request->only('email', 'remember'))
      ->withErrors([
         'email' => $this->getFailedLoginMessage(),
      ]);

   }

   /**
   * Get a validator for an incoming registration request.
   *
   * @param  array  $data
   * @return \Illuminate\Contracts\Validation\Validator
   */
   protected function validator(array $data)
   {
      return Validator::make($data, [
         'name' => 'required|max:255',
         'email' => 'required|email|max:255|unique:users',
         'password' => 'required|min:6|confirmed',
      ]);
   }

   /**
   * Create a new user instance after a valid registration.
   *
   * @param  array  $data
   * @return User
   */
   protected function create(array $data)
   {
      return User::create([
         'name' => $data['name'],
         'email' => $data['email'],
         'password' => bcrypt($data['password']),
      ]);
   }
}
