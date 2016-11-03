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

class UserController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    $data = Posts::where(function($query){
      return $query->where('user_id',Auth::user()->id)->orWhere('category','announcement')->orWhereIn('user_id',Auth::user()->subscribeRequestsPending()->pluck('id'));
    })
    ->orderBy('created_at','desc')
    ->paginate(10);
    return view('user.index',['posts' => $data]);
  }

  public function see($id) //Profile
  {
    $data = User::where('username',$id)->where('activated',true)->firstOrFail();
    $posts = Posts::where('user_id',$data->id)->orderBy('created_at','desc')->paginate(9);
    return view('user.profile',['user' => $data,'posts' => $posts]);
  }

  public function checkPost($id) //Posts
  {
    $data = Posts::findOrFail($id);
    return view('user.post',['user' => $data]);
  }

  public function subscribing()
  {

  }

  public function subscribers()
  {
    $data = User::where('id',Auth::user()->mysubs()->pluck('id'));
    return view('user.mysubs',['users'=>$data]);
  }

  public function edit($id)
  {
    if(!$id == Auth::user()->id){
      abort(404);
    }

    $data = User::where('username',$id)->firstOrFail();
    return view('user.edit',['user' => $data]);
  }

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

    return view('user.edit')->withInfo('Nice you have updated your account.')->withTitle('Account Updated');
  }

  public function getAccountSettings($id)
  {
    if(!$id == Auth::user()->id){
      abort(404);
    }

    $data = User::where('username',$id)->firstOrFail();
    return view('user.account',['user' => $data]);
  }

  public function getPrivacySettings($id)
  {
    if(!$id == Auth::user()->id){
      abort(404);
    }

    $data = User::where('username',$id)->firstOrFail();
    return view('user.privacy',['user' => $data]);
  }

  public function changePass($id)
  {
    if(!$id == Auth::user()->id){
      abort(404);
    }

    $data = User::where('username',$id)->firstOrFail();
    return view('user.changepass',['user' => $data]);
  }

  public function updateAvatar(Request $request,$id)
  {
    $image = $request->file('avatar');
    $this->validate($request,['avatar'=> 'image']);

    User::where('username',$id)->update(['avatar'=>$image->getClientOriginalName()]);
    $image->move('images/users/',$image->getClientOriginalName());

    return view('user.edit')->withInfo('Nice you have updated your avatar.')->withTitle('Avatar Updated');
  }

  public function updateBanner(Request $request,$id)
  {
    $image = $request->file('banner');
    $this->validate($request,['avatar'=> 'image']);

    User::where('username',$id)->update(['banner'=>$image->getClientOriginalName()]);
    $image->move('images/users/banner',$image->getClientOriginalName());

    $filename = 'images/users/banner/'.$image->getClientOriginalName();
    Image::make($filename)->resize(1366,200,function($constraint){
      $constraint->upsize();
    })->save($filename);

    return view('user.edit')->withInfo('Nice you have updated your banner.')->withTitle('Banner Updated');
  }

  public function addPost(Request $request)
  {
    $image = $request->file('photo');

    $this->validate($request,[
        'title' => 'required',
        'description' => 'required',
        'photo' => 'required|image'
    ]);

    Posts::create([
      'title' => $request->title,
      'user_id' => Auth::user()->id,
      'description' => $request->description,
      'category' => $request->category,
      'filename' => $image->getClientOriginalName(),
    ]);

    $image->move('posts/',$image->getClientOriginalName());

    return redirect()->route('user.index')->withInfo('You created a post')->withTitle('Post Uploaded');

  }

  public function deactivateAccount($id)
  {
    User::where('username',$id)->update(['activated' => false ]);

    Auth::logout();
    return redirect()->route('auth.login')->withInfo('Feel free to login to your account if you want to activate your account again. See you soon!')->withTitle('Account Deactivated');
  }


  public function seePost($id)
  {
    $data = Posts::find($id);
    $comment = $data->comments()->paginate(10);
    return view('user.post',['post'=>$data,'reply'=>$comment]);
  }

  public function reply(Request $request,$id)
  {
    $comment = 'comment-'.$id;
    $this->validate($request,[$comment => 'required|max:1000' ], ['required' => 'Comment is required']);

    $post = Posts::findOrFail($id);
    if(!$post){
      return redirect()->route('user.seepost',$id);
    }
    $c = new Comments();
    $c->comment = $request->input($comment);
    $c->user_id = Auth::user()->id;
    $post->comments()->save($c);

    return redirect()->route('user.seepost',$id)->withTitle('Comment Added')->withInfo('Comment has been added');
  }

  public function like($id)
  {
    $post = Posts::findOrFail($id);

    if(Auth::user()->hasLiked($post)){
      $post->likes()->where('user_id',Auth::user()->id)->delete();
      return redirect()->back();
    }

    $like = $post->likes()->create(['user_id' => Auth::user()->id]);
    Auth::user()->likes()->save($like);

    return redirect()->route('user.seepost',$id);
  }

  public function dislike($id)
  {
    $post = Posts::findOrFail($id);

    if(Auth::user()->hasDisliked($post)){
      $post->dislikes()->where('user_id',Auth::user()->id)->delete();
      return redirect()->back();
    }

    $dislike = $post->dislikes()->create(['user_id' => Auth::user()->id]);
    Auth::user()->dislikes()->save($dislike);

    return redirect()->route('user.seepost',$id);
  }

  public function subscribeTo($id)
  {
    $user = User::where('username',$id)->firstOrFail();

    if(Auth::user()->hasSubscribeRequestsPending($user) || $user->hasSubscribeRequestsPending(Auth::user()))
    {

    }
    Auth::user()->subcribeUser($id);

    return redirect()->back();
  }

}
