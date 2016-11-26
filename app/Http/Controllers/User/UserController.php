<?php

namespace Tragala\Http\Controllers\User;

use Auth;
use Tragala\User;
use Tragala\Posts;
use Tragala\Likes;
use Tragala\Friend;
use Tragala\Comments;
use Illuminate\Http\Request;
use Tragala\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as Image;

class UserController extends Controller
{
  public function __construct()
  {
    $this->middleware(['ban','auth']);
  }

  /* Home */
  public function index()
  {
    $data = Posts::where(function($query){
      return $query->where('user_id',Auth::user()->id)->orWhere('category','announcement')->orWhereIn('user_id',Auth::user()->subscribeRequestsPending()->pluck('id'));
    })
    ->orderBy('created_at','desc')
    ->paginate(10);
    return view('user.index',['posts' => $data]);
  }

  /* Profile */
  public function see($id) //Profile
  {
    $data = User::where('username',$id)->where('activated',true)->firstOrFail();
    $posts = Posts::where('user_id',$data->id)->orderBy('created_at','desc')->paginate(9);
    return view('user.profile',['user' => $data,'posts' => $posts]);
  }

  /* Subscribed To Page */
  public function subscribing()
  {

  }

  /* My Subscribers */
  public function subscribers()
  {
    $data = User::where('id',Auth::user()->mysubs()->pluck('id'));
    return view('user.mysubs',['users'=>$data]);
  }

  /* Edit Profile */
  public function edit($id)
  {
    if(!$id == Auth::user()->id){
      abort(404);
    }

    $data = User::where('username',$id)->firstOrFail();
    return view('user.edit',['user' => $data]);
  }

  /* Updating Profile */
  public function update(Request $request, $id)
  {
    $this->validate($request,[
      'fname' => 'min:2',
      'lname' => 'min:2',
    ]);

    User::where('username',$id)->update([
      'first_name' => $request->fname,
      'last_name' => $request->lname,
      'location' => $request->location,
      'gender' => $request->gender,
    ]);

    return redirect()->route('user.edit',Auth::user()->username)->withInfo('Nice you have updated your account.')->withTitle('Account Updated');
  }

  /* Avatar Update Profile */
  public function updateAvatar(Request $request,$id)
  {
    $image = $request->file('avatar');
    $this->validate($request,['avatar'=> 'image']);

    $image->move('images/users/',$image->getClientOriginalName());
    $filename = 'images/users/'.$image->getClientOriginalName();
    $changed = 'images/users/'.Auth::user()->username.'.'.$image->getClientOriginalExtension();
    $nameonly = Auth::user()->username.'.'.$image->getClientOriginalExtension();

    Image::make($filename)->save($changed);
    User::where('username',$id)->update(['avatar'=>$nameonly]);

    return redirect()->route('user.edit',Auth::user()->username)->withInfo('Nice you have updated your avatar.')->withTitle('Avatar Updated');
  }

  /* Banner Update Profile */
  public function updateBanner(Request $request,$id)
  {
    $image = $request->file('banner');
    $this->validate($request,['avatar'=> 'image']);

    $image->move('images/users/banner',$image->getClientOriginalName());
    $filename = 'images/users/banner/'.$image->getClientOriginalName();
    $changed = 'images/users/banner/'.Auth::user()->username.$image->getClientOriginalExtension();
    $nameonly = Auth::user()->username.$image->getClientOriginalExtension();

    Image::make($filename)->resize(1366,200,function($constraint){
      $constraint->upsize();
    })->save($changed);

    User::where('username',$id)->update(['banner'=>$nameonly]);
    return redirect()->route('user.edit',Auth::user()->username)->withInfo('Nice you have updated your banner.')->withTitle('Banner Updated');
  }

  /* Subscribing to Someone */
  public function subscribeTo($id)
  {
    $user = User::where('username',$id)->firstOrFail();

    if(Auth::user()->hasSubscribeRequestsPending($user) || $user->hasSubscribeRequestsPending(Auth::user()))
    {

    }
    Friend::create(['user_id' => $user->id,'friend_id' => Auth::user()->id]);
    return redirect()->back();
  }

}
