<div class="ui card">
  <div class="image">
    <img src="{{asset('images/users')}}/{{Auth::user()->avatar}}">
  </div>
  <div class="content">
    <a href="{{route('user.see',Auth::user()->username)}}" class="header">{{Auth::user()->username}}
      @if(Auth::user()->usergroup > 1)
      <span><i class="check circle blue icon"></i></span>
      @endif
    </a>
    <div class="meta">
      <span class="date">Joined in {{date_format(Auth::user()->created_at,'M Y')}}</span>
    </div>
    <div class="description">
      {{Auth::user()->location}}
    </div>
  </div>
  <div class="extra content">
    <a href="">
      <i class="user icon"></i>
      {{Auth::user()->subscribeRequestsPending()->count()}} Following
    </a>
    <a>
      <i class="user icon"></i>
      {{Auth::user()->subscribeRequests()->count()}} Followers
    </a>
  </div>
</div>
