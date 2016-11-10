@extends('templates.user')

@section('title')
{{ $user->first_name }} {{$user->last_name}}'s profile
@endsection

@section('header')
<div class="ui header">
  <img src="{{asset('images/users/banner/')}}/{{$user->banner}}" alt="" class="ui fluid image">
</div>
@endsection

@section('profile')
<h2 class="ui header">
  <img src="{{asset('images/users')}}/{{$user->avatar}}" alt="" class="ui circular image">
  <div class="content">
    {{$user->first_name}} {{$user->last_name}} @if($user->usergroup > 1) <i class="check circle blue icon"></i> @endif
      <div class="ui sub header">@ {{$user->username}}</div>
  </div>
</h2>
<br>
@if($user->id == Auth::user()->id)
<a href="{{route('user.edit',Auth::user()->username)}}" class="right ui teal button">Edit Profile</a>
@elseif($user->id = Auth::user()->hasSubscribeRequestsPending($user))
<a class="right ui teal button">Following User</a>
@else
<a href="{{route('user.sub',$user->username)}}" class="right ui teal button">Follow</a>
@endif
@endsection


@section('content')
<div class="ui divider horizontal">Posts</div>
<div class="ui three link cards">
@foreach($posts as $post)
<a href="{{route('user.seepost',$post->id)}}">
  <div class="ui card">
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
      <a  class="ui red corner label"><i class="ban icon"></i></a>
      <div class="header">
         <br>
         {{$post->title}}</div>
      <div class="meta">
        <span class="time">Posted {{$post->created_at->diffForHumans()}}</span>
        <br>
      </div>
      <div class="description">
      <img src="{{asset('posts')}}/{{$post->filename}}" alt="" class="ui fluid image"><br>
        <p><br>{{$post->description}}</p>
      </div>
    </div>
    <div class="extra content">
      <div class="left floated author">
        <a href="{{route('user.like',$post->id)}}"><i class="thumbs up outline icon"></i>
          @if(Auth::user()->hasLiked($post) && $post->likes->count() > 1)
          You and {{$post->likes->count() - 1}} {{str_plural('other',$post->likes->count())}}have liked this
          @elseif(Auth::user()->hasLiked($post))
          You have liked this
          @elseif($post->likes->count() < 1)
          Like
          @else
          {{$post->likes->count()}} {{str_plural('Like',$post->likes->count())}}
          @endif
          &nbsp;</a>
        <a href="{{route('user.dislike',$post->id)}}"><i class="thumbs down outline icon"></i>
          @if(Auth::user()->hasDisliked($post) && $post->dislikes->count() > 1)
          You and {{$post->dislikes->count() - 1}} {{str_plural('other',$post->dislikes->count())}}have disliked this
          @elseif(Auth::user()->hasDisliked($post))
          You have disliked this
          @elseif($post->dislikes->count() < 1)
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
  </a>
  @endforeach
</div>
@endsection
