<div class="ui fixed menu">
  <div class="ui container">
    <a href="{{ route('user.index') }}" class="item"><i class="home icon"></i></a>
    <a href="#" class="item"><i class="alarm outline icon"></i></a>
  </div>
  <div class="middle menu"><a href="" class="item"></a></div>
  <div class="right menu">
    <div class="ui simple dropdown item">
      <a href="" class="avatar">
      </a>
      {{Auth::user()->first_name}}
      <i class="dropdown icon"></i>
      <div class="menu">
        <a href="" class="item">View Profile</a>
        <a href="" class="item">Edit Profile</a>
        <a href="" class="item">Settings</a>
        <div class="divider"></div>
        <a href="{{ route('auth.logout') }}" class="item">Logout</a>
      </div>
    </div>
  </div>
</div>
