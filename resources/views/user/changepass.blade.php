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
      <a href="{{route('account.settings',Auth::user()->username)}}" class="item">
        Account Settings
      </a>
      <a href="{{route('account.privacy',Auth::user()->username)}}" class="item">
        Privacy Settings
      </a>
      <a href="{{route('account.changepass',Auth::user()->username)}}"class="active teal item">
        Change Password
      </a>
      @if(Auth::user()->usergroup > 2)
      <a href="{{route('admin.index')}}" class="item">
        Back to Admin Panel
      </a>
      @endif
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
        <div class="ui dividing header">Change your password</div>
        <form action="{{route('account.changepass.update',Auth::user()->username)}}" class="ui form large" method="post">
          {{method_field('PUT')}}
          {{csrf_field()}}
          <div class="required field{{ $errors->has('password')? ' error' : '' }}">
            <div class="ui left icon input">
              @if($errors->has('old_pass') )
              <div class="floating ui red left pointing label">{{ $errors->first('old_pass') }}</div>
              @endif
              <i class="lock icon"></i>
              <input type="password" name="old_pass" id="" placeholder="Old Password" value="{{old('old_pass')}}">
            </div>
          </div>
          <div class="ui horizontal divider">AND</div>
          <div class="required field{{ $errors->has('password')? ' error' : '' }}">
            <div class="ui left icon input">
              @if($errors->has('password') )
              <div class="floating ui red left pointing label">{{ $errors->first('password') }}</div>
              @endif
              <i class="lock icon"></i>
              <input type="password" name="password" id="" placeholder="Password" value="{{old('password')}}">
            </div>
          </div>
          <div class="required field{{ $errors->has('password_confirmation')? ' error' : '' }}">
            <div class="ui left icon input">
              @if($errors->has('password_confirmation') )            <div class="floating ui red left pointing label">{{ $errors->first('password_confirmation') }}</div>
              @endif
              <i class="lock icon"></i>
              <input type="password" name="password_confirmation" id="" placeholder="Confirm Password" value="{{old('password_confirmation')}}">
            </div>
          </div>
          <button type="submit" class="ui teal fluid large button">Change Your Password</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
