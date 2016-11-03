@if(Session::has('info'))
<div class="ui icon message">
  <i class="inbox icon"></i>
  <div class="content">
    <div class="header">
      {{Session::get('title')}}
    </div>
    <p>{{Session::get('info')}}</p>
  </div>
</div>
@endif
