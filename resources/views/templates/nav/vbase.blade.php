<div class="ui vertical menu">
  <div class="header item">Check out</div>
  <a class="active teal item">
    Hot
    <div class="ui teal left pointing label">1</div>
  </a>
  <a class="item">
    Trending
    <div class="ui label">51</div>
  </a>
  <a class="item">
    Latest
    <div class="ui label">1</div>
  </a>
  @if(Auth::user()->usergroup >= 3)
  <a href="{{route('admin.index')}}" class="item">
    Goto Admin Panel
    <i class="dashboard icon"></i>
  </a>
  @endif
  <div class="item">
    <div class="ui transparent icon input">
      <input placeholder="Search location..." type="text">
      <i class="search icon"></i>
    </div>
  </div>
</div>
