<?php

namespace Tragala\Http\Controllers\User;

use Auth;
use Tragala\User;
use Tragala\Posts;
use Tragala\Likes;
use Tragala\Comments;
use Illuminate\Http\Request;
use Tragala\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as Image;

class SettingsController extends Controller
{
  /* Account Settings */
  public function getAccountSettings($id)
  {
    if(!$id == Auth::user()->id){
      abort(404);
    }

    $data = User::where('username',$id)->firstOrFail();
    return view('user.settings',['user' => $data]);
  }

  /* Privacy Settings */
  public function getPrivacySettings($id)
  {
    if(!$id == Auth::user()->id){
      abort(404);
    }

    $data = User::where('username',$id)->firstOrFail();
    return view('user.privacy',['user' => $data]);
  }

  /* Change Pass Settings */
  public function getChangePass($id)
  {
    if(!$id == Auth::user()->id){
      abort(404);
    }

    $data = User::where('username',$id)->firstOrFail();
    return view('user.changepass',['user' => $data]);
  }

  /* Update Account Settings */
  public function updateAccountSettings(Request $request,$id)
  {
    if(!$id == Auth::user()->id){
      abort(404);
    }

    $data = User::where('username',$id)->firstOrFail();

    $this->validate([
      'uname' => 'min:3|unique: users,username',
      'email' => 'email|unique: users,email',
    ]);

    Auth::user()->update(['username' => $request->uname, 'email' => $request->email]);

    return view('user.settings',['user' => $data]);
  }

  /* Privacy Settings */
  public function updatePrivacySettings(Request $request,$id)
  {
    if(!$id == Auth::user()->id){
      abort(404);
    }

    $data = User::where('username',$id)->firstOrFail();
    return view('user.privacy',['user' => $data]);
  }

  /* Change Pass Settings */
  public function updateChangePass($id)
  {
    if(!$id == Auth::user()->id){
      abort(404);
    }

    $data = User::where('username',$id)->firstOrFail();
    return view('user.changepass',['user' => $data]);
  }

  /* Deactivate Account */
  public function deactivateAccount($id)
  {
    User::where('username',$id)->update(['activated' => false ]);

    Auth::logout();
    return redirect()->route('auth.login')->withInfo('Feel free to login to your account if you want to activate your account again. See you soon!')->withTitle('Account Deactivated');
  }
}
