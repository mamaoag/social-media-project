<div class="ui fixed pointing menu">
  <div class="ui container">
    @if(Auth::check())
    <a href="{{ route('user.index') }}" class="item @yield('index')"><i class="home icon"></i>Home</a>
    <a href="#" class="item @yield('notifications')"><i class="alarm outline icon"></i>Notification</a>
    <a href="#" class="item @yield('request')"><i class="user outline icon"></i>Follow Requests</a>
    @else
    <a href="{{ route('index') }}" class="item"><h3>Tragala</h3></a>
    @endif
  </div>
  <div class="right menu">
    @if(Auth::check())
    <div class="ui simple dropdown item">
      <a href="" class="">
          <img src="{{asset('images/users/')}}/{{Auth::user()->avatar}}" alt="" class="ui circular avatar image">
      </a>
      {{Auth::user()->first_name}}
      <i class="dropdown icon"></i>
      <div class="menu">
        <a href="{{route('user.see',Auth::user()->username)}}" class="item">View Profile</a>
        <a href="{{route('user.edit',Auth::user()->username)}}" class="item">Edit Profile</a>
        <a href="" class="item">Settings</a>
        <div class="divider"></div>
        <a href="{{ route('auth.logout') }}" class="item">Logout</a>
      </div>
    </div>
  @else
  <a href="" class="item">Sign Up</a>
  <div class="item"><a href="" class="item ui button teal">Login</a></div>
  @endif
  </div>
</div>
