<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class authcontroller extends Controller
{
    // Register User
    public function register(Request $request){
        // Validate
          $fields = $request->validate([
              'username' => ['required', 'max:255'],
              'password' => ['required', 'min:3', 'confirmed'],
              'first_name' => ['required', 'max:255'],
              'lst_name' => ['required', 'max:255'],
              'wmsu_email' => ['required', 'max:255', 'email', 'unique:users']
          ]);
  
          // Register
        //   $user = User::create($fields);
  
        //   // Login 
        //   Auth::login($user);
  
        //   // Redirect
        //   return redirect()->route('home');
      }
  
    //   // login User
    //   public function login(Request $request) {
    //        // Validate
    //        $fields = $request->validate([
    //           'email' => ['required', 'max:255', 'email'],
    //           'password' => ['required']
    //       ]);
  
    //       // Try to login the user
    //       if (Auth::attempt($fields, $request->remember)) {
    //           return redirect()->intended('dashboard');
    //       } else {
    //           return back()->withErrors([
    //               'failed' => 'The provided credentials do not match our records'
    //           ]);
    //       }
    //   }
  
    //   //Logout User
    //   public function logout(Request $request) {
    //       //Logout the sser
    //       Auth::logout();
  
    //       // Invalidate user's session
    //       $request->session()->invalidate();
  
    //       // Regenerate CSRF token
    //       $request->session()->regenerateToken();
  
    //       // Redirect to home
    //       return redirect('/');
    //   }
}
