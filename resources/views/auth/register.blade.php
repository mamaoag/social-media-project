@extends('templates.base')

@section('title')
Sign Up - Tragala
@endsection

@section('imports')
<link rel="stylesheet" href="{{ asset('components/checkbox.min.css') }}">
<style>
body>.grid{
  height: 100%
}
.column {
  max-width: 560px;
}
</style>
@endsection

@section('content')
<div class="ui middle aligned center aligned grid">
  <div class="column">
    @include('templates.alert.alert')
    <h2 class="ui teal image header">
      <div class="content">
        Create your account
      </div>
    </h2>
    <form class="ui large form" method="post" action="{{ route('auth.submit') }}">
      {{csrf_field()}}
      <div class="ui stacked segment">
        <div class="two fields">
          <div class="required field{{ $errors->has('fname')? ' error' : '' }}">
            <div class="ui left icon input">
              @if($errors->has('fname') )
              <div class="floating ui red left pointing label">{{ $errors->first('fname') }}</div>
              @endif
              <i class="user icon"></i>
              <input type="text" name="fname" placeholder="First Name" value="{{old('fname')}}">
            </div>
          </div>
          <div class="required field{{ $errors->has('lname')? ' error' : '' }}">
            <div class="ui left icon input">
              @if($errors->has('lname') )
              <div class="floating ui red left pointing label">{{ $errors->first('lname') }}</div>
              @endif
              <i class="user icon"></i>
              <input type="text" name="lname" placeholder="Last Name" value="{{old('lname')}}">
            </div>
          </div>
        </div>
        <div class="required field{{ $errors->has('uname')? ' error' : '' }}">
          <div class="ui left icon input">
            @if($errors->has('uname') )
            <div class="floating ui red left pointing label">{{ $errors->first('uname') }}</div>
            @endif
            <i class="at icon"></i>
            <input type="text" name="uname" id="" placeholder="Username" value="{{old('uname')}}">
          </div>
        </div>
        <div class="required field{{ $errors->has('email')? ' error' : ''}}">
          <div class="ui left icon input">
            @if($errors->has('email') )
            <div class="floating ui red left pointing label">{{ $errors->first('email') }}</div>
            @endif
            <i class="mail icon"></i>
            <input type="email" name="email" id="" placeholder="Email" value="{{old('email')}}">
          </div>
        </div>
        <div class="inline required fields">
          <label for="">Gender:</label>
          <div class="field{{ $errors->has('gender')? ' error' : '' }}"><input type="radio" name="gender" id="" value="male"><label for="">Male</label></div>
          <div class="field{{ $errors->has('gender')? ' error' : '' }}"><input type="radio" name="gender" id="" value="female"><label for="">Female</label></div>
        </div>
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
        <button type="submit" class="ui fluid large teal submit button">Create</button>
      </div>
    </form>
  </div>
</div>

@endsection
