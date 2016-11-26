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

class PostsController extends Controller
{
  /* Add Post */
  public function addPost(Request $request)
  {
    $image = $request->file('photo');

    $this->validate($request,[
        'title' => 'required',
        'description' => 'required',
        'photo' => 'required|image',
        'category' => 'required',
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

  /* See Post */
  public function seePost($id)
  {
    $data = Posts::find($id);
    $comment = $data->comments()->paginate(10);
    return view('user.post',['post'=>$data,'reply'=>$comment]);
  }

  /* Comment Post */
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

  /* Like Post */
  public function like($id)
  {
    $post = Posts::findOrFail($id);

    if(Auth::user()->hasLiked($post) || Auth::user()->hasDisliked($post)){
      $post->dislikes()->where('user_id',Auth::user()->id)->delete();
    }

    if(Auth::user()->hasLiked($post)){
      $post->likes()->where('user_id',Auth::user()->id)->delete();
      return redirect()->back();
    }

    $like = $post->likes()->create(['user_id' => Auth::user()->id]);
    Auth::user()->likes()->save($like);

    return redirect()->back();//route('user.seepost',$id);
  }

  /* Dislike Post */
  public function dislike($id)
  {
    $post = Posts::findOrFail($id);

    if(Auth::user()->hasLiked($post) || Auth::user()->hasDisliked($post)){
      $post->likes()->where('user_id',Auth::user()->id)->delete();
    }

    if(Auth::user()->hasDisliked($post)){
      $post->dislikes()->where('user_id',Auth::user()->id)->delete();
      return redirect()->back();
    }

    $dislike = $post->dislikes()->create(['user_id' => Auth::user()->id]);
    Auth::user()->dislikes()->save($dislike);

    return redirect()->back();//route('user.seepost',$id);
  }
}
