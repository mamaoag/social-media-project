@extends('templates.base')

@section('title')
Home - Tragala
@endsection

@section('content')
<div class="ui three column centered row stackable grid container">
  <div class="sixteen wide column">
    @if($posts->count() > 0)
    @foreach($posts as $post)
    <a href="{{route('user.seepost',$post->id)}}">
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
    <br>
    </a>
    @endforeach
    {{$posts->links()}}
    @else
      <h3>No Posts Found</h3>
    @endif
    </div>
  </div>
  <div class="four wide column">
  </div>


@endsection
