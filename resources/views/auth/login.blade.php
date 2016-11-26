@extends('templates.base')

@section('title')
Login - Tragala
@endsection

@section('imports')
<link rel="stylesheet" href="{{ asset('components/button.min.css') }}">
<style>
body>.grid{
  height: 80%
}
.column {
      max-width: 450px;
}
</style>
@endsection

@section('content')
<br>
<br>
<br>
<div class="ui middle aligned center aligned grid">
  <div class="column">
    <h2 class="ui teal image header">
      <div class="content">
        Log-in to your account
      </div>
    </h2>
    <form class="ui large form" method="post" action="{{ route('auth.check') }}">
      {{csrf_field()}}
      <div class="ui stacked segment">
        <div class="field{{$errors->has('user')? ' error': ''}}">
          <div class="ui left icon input">
            <i class="at icon"></i>
            <input type="text" name="user" placeholder="Username">
          </div>
        </div>
        <div class="field{{$errors->has('pass')? ' error' : ''}}">
          <div class="ui left icon input">
            <i class="lock icon"></i>
            <input type="password" name="pass" placeholder="Password">
          </div>
        </div>
        <button type="submit" class="ui fluid large teal submit button">Login</button>
      </div>

      <div class="ui error message"></div>

    </form>

    <div class="ui message">
      New to us? <a href="{{ route('auth.signup') }}">Sign Up</a>
    </div>
  </div>
</div>
@endsection
