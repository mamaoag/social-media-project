@extends('templates.useredit')

@section('title')
Settings - Tragala
@endsection


@section('content')
<div class="ui two column grid stackable container">
  <div class="four wide column">
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="ui secondary vertical pointing menu">
      <a href="{{route('account.settings',Auth::user()->username)}}" class="active teal item">
        Account Settings
      </a>
      <a href="{{route('account.privacy',Auth::user()->username)}}" class="item">
        Privacy Settings
      </a>
      <a href="{{route('account.changepass',Auth::user()->username)}}" class="item">
        Change Password
      </a>
    </div>
  </div>
  <div class="wide column">
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
      <div class="ui fluid stackable segment">
        <div class="ui dividing header">Account Settings</div>
        <form action="{{route('account.settings.update',Auth::user()->username)}}" class="ui form large" method="post">
          {{method_field('PUT')}}
          {{csrf_field()}}
          <div class="field{{ $errors->has('uname')? ' error' : '' }}">
            <label for="">Change your username</label>
            <div class="ui left icon input">
              @if($errors->has('uname') )
              <div class="floating ui red left pointing label">{{ $errors->first('uname') }}</div>
              @endif
              <i class="at icon"></i>
              <input type="text" name="uname" id="" placeholder="Username" value="{{Auth::user()->username ?: Request::old('uname')}}">
            </div>
          </div>
          <div class="field{{ $errors->has('email')? ' error' : '' }}">
            <label for="">Change your email</label>
            <div class="ui left icon input">
              @if($errors->has('email') )
              <div class="floating ui red left pointing label">{{ $errors->first('email') }}</div>
              @endif
              <i class="mail icon"></i>
              <input type="email" name="email" id="" placeholder="Email" value="{{Auth::user()->email ?: Request::old('email')}}">
            </div>
          </div>
          <button type="submit" class="ui teal fluid large button">Update Account</button>
        </form>
      </div>
      <div class="ui horizontal divider">OR</div>
      <div class="ui stackable segment">
          <a href="http://" class="ui red large fluid button">Deactivate Your Account</a>
      </div>
    </div>
  </div>
</div>
@endsection
