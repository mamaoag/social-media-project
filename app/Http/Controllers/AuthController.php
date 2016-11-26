<?php

namespace Tragala\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Tragala\User;
use Tragala\Mail\Confirm;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
  /*
  LOGIN
  */
  public function login()
  {
  return view('auth.login');
  }

  public function checkAccount(Request $request)
  {
    $this->validate($request,[
      'user' => 'required|min:3',
      'pass' => 'required|min:4'
    ]);

    if(!Auth::attempt(['username' => $request->user, 'password' => $request->pass])){
      return redirect()->route('auth.login')->withTitle('Login Failed')->withInfo('Check your credentails or maybe register that account');
    }
    $test = User::where('username', $request->user)->first();
    if($test->verified == false){
      Auth::logout();
      return redirect()->route('auth.login')->withTitle('Login Failed')->withInfo('Verify your email first');
    }
    else{
      $test->activated = true;
      $test->save();
      return redirect()->route('user.index');
    }
  }

  /*
  REGISTER
  */
  public function register()
  {
    return view('auth.register');
  }

  public function submit(Request $request)
  {
    //Validation
    $this->validate($request,[
      'fname' => 'required|min:2',
      'lname' => 'required|min:2',
      'uname' => 'required|min:2|unique:users,username',
      'email' => 'required|email|min:2|unique:users,email',
      'gender' => 'required',
      'password' => 'required|min:4|confirmed',
    ]);

    $code = str_random(10);
    User::create([
      'first_name' => ucfirst($request->fname),
      'last_name' => ucfirst($request->lname),
      'username' => $request->uname,
      'email' => $request->email,
      'gender' => $request->gender,
      'password' => Hash::make($request->password),
      'hash' => $code,
    ]);

    Mail::to($request->email)->send(new Confirm(ucfirst($request->fname),$code));
    return redirect()->route('auth.login')->withInfo('Congratulations, you created an account. Check your mail to activate it')->withTitle('Success!');
  }

  public function logout()
  {
    Auth::logout();
    return redirect()->route('auth.login')->withTitle('Logout Success')->withInfo('Hope to see you again!');
  }

  public function verifyAccount($id)
  {
    $data = User::where('hash',$id)->first();

    if($data){
      $data->update(['activated'=>true,'verified'=>true,])->save();
      return redirect()->route('auth.login')->withTitle('Account Authenticated')->withInfo('Login now');
    }else{
      abort(404);
    }
  }

}
