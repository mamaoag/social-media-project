@extends('templates.admin')

@section('title')
User Management - Administrator
@endsection

@section('content')
<br><br>
<h3>User Management</h3>
<h5>Discover different users of Tragala.</h5>
<div class="ui cards">
  @if($users->count() < 1)
  <h3>NO USERS FOUND. SORRY :(</h3>
  @else
  @foreach($users as $user)
  <div class="card">
    <div class="content">
      <img class="right floated mini ui image" src="{{asset('images/users')}}/{{$user->avatar}}">
      <div class="header">
        {{$user->first_name}} {{$user->last_name}}
      </div>
      <div class="meta">
      @  {{$user->username}}
      </div>
      <div class="description">
        {{$user->first_name}} is a
        @if($user->usergroup == 1)
        Registered member of Tragala
        @elseif($user->usergroup == 2)
        Verified member of Tragala
        @elseif($user->usergroup == 3)
        Staff of Tragala
        @else
        Head Administrator of Tragala
        @endif
      </div>
    </div>
    <div class="extra content">
      <div class="ui two buttons">
        <a href="{{route('admin.user.edit',$user->id)}}" class="ui basic green button">Edit Profile</a>
        @if($user->banned == false)
        <a href="{{route('admin.user.ban',$user->id)}}" class="ui basic red button">Ban User</a>
        @elseif ($user->banned == true)
        <a href="{{route('admin.user.ban',$user->id)}}" class="ui basic blue button">Lift Ban</a>
        @endif
      </div>
    </div>
  </div>
  @endforeach
  @endif
</div>
@endsection
