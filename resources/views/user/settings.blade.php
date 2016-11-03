@extends('templates.userdit')

@section('title')
Settings - Tragala
@endsection


@section('content')
<div class="ui two column grid stackable container">
  <div class="four wide column">
    <div class="ui secondary vertical pointing menu">
      <a class="active teal item">
        Account Settings
      </a>
      <a class="item">
        Privacy Settings
      </a>
      <a class="item">
        Deactivate Account
      </a>
    </div>
  </div>
  <div class="wide column">
    <div class="row">
      <div class="ui fluid stackable segment">
        <ui class="dividing header"></ui>
        <form action="" class="ui form large" method="post">
          {{method_field('PUT')}}
          {{csrf_token()}}
          <div class="required field{{ $errors->has('uname')? ' error' : '' }}">
            <div class="ui left icon input">
              @if($errors->has('uname') )
              <div class="floating ui red left pointing label">{{ $errors->first('uname') }}</div>
              @endif
              <i class="at icon"></i>
              <input type="text" name="uname" id="" placeholder="Username" value="{{Auth::user()->username ?: Request::old('uname')}}">
            </div>
          </div>
          <div class="required field{{ $errors->has('email')? ' error' : '' }}">
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
    </div>
  </div>
</div>
@endsection
