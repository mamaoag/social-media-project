@extends('templates.useredit')

@section('title')
Edit {{Auth::user()->first_name}} {{Auth::user()->last_name}}'s Profile - Tragala
@endsection

@section('content')
<div class="ui two column stackable grid ">
  <div class="seven wide column">
    <br>
    <br>
    <br>
    <br>
    <br><br><br>
    <h3>Edit Profile</h3>
    <div class="ui centered stackable segment">
      <form class="ui large form" method="post" action="{{route('user.update', Auth::user()->username) }}">
        {{method_field('PUT')}}
        {{csrf_field()}}
        <div class="ui stacked segment">
          <div class="two fields">
            <div class="required field{{ $errors->has('fname')? ' error' : '' }}">
              <div class="ui left icon input">
                @if($errors->has('fname') )
                <div class="floating ui red left pointing label">{{ $errors->first('fname') }}</div>
                @endif
                <i class="user icon"></i>
                <input type="text" name="fname" placeholder="First Name" value="{{Auth::user()->first_name ?: Request::old('fname')}}">
              </div>
            </div>
            <div class="required field{{ $errors->has('lname')? ' error' : '' }}">
              <div class="ui left icon input">
                @if($errors->has('lname') )
                <div class="floating ui red left pointing label">{{ $errors->first('lname') }}</div>
                @endif
                <i class="user icon"></i>
                <input type="text" name="lname" placeholder="Last Name" value="{{Auth::user()->last_name ?: Request::old('lname')}}">
              </div>
            </div>
          </div>
          <div class="required field{{ $errors->has('uname')? ' error' : '' }}">
            <div class="ui left icon input">
              @if($errors->has('uname') )
              <div class="floating ui red left pointing label">{{ $errors->first('uname') }}</div>
              @endif
              <i class="at icon"></i>
              <input type="text" name="uname" id="" placeholder="Username" value="{{Auth::user()->username ?: Request::old('uname')}}">
            </div>
          </div>
          <div class="required field{{ $errors->has('lname')? ' error' : '' }}">
            <div class="ui left icon input">
              @if($errors->has('location') )
              <div class="floating ui red left pointing label">{{ $errors->first('location') }}</div>
              @endif
              <i class="map icon"></i>
              <input type="text" name="location" placeholder="Location" value="{{Auth::user()->location ?:old('location')}}">
            </div>
          </div>
          <div class="inline required fields">
            <label for="">Gender:</label>

            <div class="field{{ $errors->has('gender')? ' error' : '' }}"><input type="radio" name="gender" id="" value="male" @if(Auth::user()->gender == 'male') checked="checked" @endif><label for="">Male</label></div>
            <div class="field{{ $errors->has('gender')? ' error' : '' }}"><input type="radio" name="gender" id="" value="female" @if(Auth::user()->gender == 'female') checked="checked" @endif><label for="">Female</label></div>
          </div>
          <button type="submit" class="ui fluid large teal submit button">Update Profile</button>
        </div>
      </form>
    </div>
  </div>
  <div class="wide column">
    <div class="row">
      <br>
      <div class="ui dividing header">Avatar</div>
      <div class="ui stackable segment">
        <img src="{{asset('images/users/')}}/{{Auth::user()->avatar}}" alt="" class="ui medium centered circular fluid image"> <br>
        <form action="{{route('user.update.avatar', Auth::user()->username) }}" method="post" class="ui form container" enctype="multipart/form-data">
          {{method_field('PUT')}}
          {{csrf_field()}}
          <div class="field">
            <input type="file" name="avatar" id="">
          </div>
          <div class="field">
            <button type="submit" class="ui fluid large teal button"><i class="cloud upload icon"></i>Upload Avatar</button>
          </div>
        </form>
      </div>
    </div>
    <div class="column ui horizontal divider">OR</div>
    <div class="row">
      <div class="ui dividing header">Banner</div>
      <div class="ui stackable segment">
        <form action="{{route('user.update.banner', Auth::user()->username) }}" method="post" class="ui form container" enctype="multipart/form-data">
          {{method_field('PUT')}}
          {{csrf_field()}}
          <div class="field">
            <input type="file" name="banner" id="">
          </div>
            <button type="submit" class="ui fluid large teal button"><i class="cloud upload icon"></i>Upload Banner</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
