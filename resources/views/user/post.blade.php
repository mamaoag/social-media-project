@extends('templates.base')

@section('title')
{{ $post->title }} - Tragala
@endsection

@section('content')
<div class="row">
  <div class="ui raised link fluid card">
    <div class="content">
      <span href="" class="ui
      @if($post->category == 'experience')
      red
      @elseif ($post->category == 'travel')
      blue
      @elseif ($post->category == 'food')
      teal
      @elseif ($post->category == 'announcement')
      yellow
      @endif
      ribbon label"><i class="
      @if($post->category == 'experience')
      plane
      @elseif ($post->category == 'travel')
      travel
      @elseif ($post->category == 'food')
      food
      @elseif ($post->category == 'announcement')
      announcement
      @endif
      icon"></i>{{ucfirst($post->category)}}</span>
      <a href="#" class="ui red corner label"><i class="ban icon"></i></a>
      <div class="header">
         <br>
         {{$post->title}}</div>
      <div class="meta">
        <span class="category">Posted {{$post->created_at->diffForHumans()}}</span>
      </div>
      <div class="description">
        <img src="{{asset('posts')}}/{{$post->filename}}" alt="" class="ui fluid image"><br>
        <p><br>{{$post->description}}</p>
      </div>
    </div>
    <div class="extra content">
      <div class="extra content">
        <div class="left floated author">
          <a href="{{route('user.like',$post->id)}}"><i class="thumbs up outline icon"></i>
            @if($post->likes->count() < 1)
            Like
            @else
            {{$post->likes->count()}} {{str_plural('Like',$post->likes->count())}}
            @endif
            &nbsp;</a>
          <a href="{{route('user.dislike',$post->id)}}"><i class="thumbs down outline icon"></i>
            @if($post->dislikes->count() < 1)
            Dislike
            @else
            {{$post->dislikes->count()}} {{str_plural('Dislike',$post->dislikes->count())}}
            @endif
          </a>
          <a href="{{route('user.seepost',$post->id)}}#comments"><i class="comments outline icon"></i>
            @if($post->comments->count() < 1)
            Comments
            @else
            {{$post->comments->count()}} {{str_plural('Comment',$post->comments->count())}}
            @endif
          </a>
        </div>
      <div class="right floated author">
        <img class="ui avatar image" src="{{asset('images/users/')}}/{{$post->user->avatar}}"> {{$post->user->username}}
      </div>
    </div>
  </div>
</div>
{{-- Comment --}}
<div class="row" id="comments">
  <br>
  <div class="ui comments">
    <h3 class="ui dividing header">Comments</h3>
    <br>
    @if($post->comments->count() < 1)
    No comments for this post
    @else
    @foreach($reply as $comment)
    <div class="comment">
      <a class="avatar">
        <img src="{{asset('images/users')}}/{{$comment->user->avatar}}">
      </a>
      <div class="content">
        <a href="{{route('user.see',$comment->user->username)}}" class="author">{{$comment->user->first_name}} {{$comment->user->last_name}}</a>
        <div class="metadata">
          <div class="date">{{$comment->created_at->diffForHumans()}}</div>
          <div class="rating">
            @if($comment->user->usergroup == 4)
              <i class="check circle blue icon"></i>
              Founder - Tragala
            @elseif($comment->user->usergroup == 3)
              <i class="check circle blue icon"></i>
              Tragala Staff
            @elseif($comment->user->usergroup == 2)
              <i class="check circle blue icon"></i>
              Verified User
            @else
              User
            @endif
          </div>
        </div>
        <div class="text">
          {{$comment->comment}}
        </div>
      </div>
    </div>
    @endforeach
    <br>
    {{$reply->links('vendor.pagination.default')}}
    @endif
  </div>
  <div class="ui horizontal divider">
   Or
  </div>
  <form method="post" action="{{route('user.reply',$post->id)}}" class="ui reply form">
    {{csrf_field()}}
    <div class="field{{$errors->has('comment-{$post->id}')? ' error' : ''}}">
      <textarea type="comment" name="comment-{{$post->id}}" placeholder="Comment here..."></textarea>
    </div>
    <button type="submit" class="ui primary submit labeled icon button">
      <i class="icon edit"></i> Add Comment
    </button>
  </form>
</div>
@endsection
