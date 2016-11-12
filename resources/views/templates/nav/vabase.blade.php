<div class="ui secondary pointing vertical menu">
  <div class="header item">Panels</div>
  <a href="{{route('admin.index')}}" class="@if(Route::is('admin.index')) active teal @endif item">
    Dashboard
  </a>
  <a href="{{route('admin.user.index')}}" class="@if(Route::is('admin.user.index')) active teal @endif item">
    User Management
    @if($users->count() > 0)
    <div class="ui @if(Route::is('admin.user.index')) teal left pointing @endif label">{{$users->count()}}</div>
    @endif
  </a>
  <a class="@if(Route::is('admin.location.index')) active teal @endif item">
    Locations
    @if($users->count() == 200)
    <div class="ui @if(Route::is('admin.user.index')) teal left pointing @endif label">{{$users->count()}}</div>
    @endif
  </a>
  <a href="{{route('account.settings',Auth::user()->username)}}" class="item">
    Account Settings
  </a>
  <a href="{{route('user.index')}}" class="item">
    Back to Tragala
    <i class="dashboard icon"></i>
  </a>
  <div class="item">
    <div class="ui transparent icon input">
      <input placeholder="Search location..." type="text">
      <i class="search icon"></i>
    </div>
  </div>
</div>
