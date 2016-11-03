@extends('templates.user')

@section('title')
Oops! - Tragala
@endsection

@section('imports')
<style>
  #error{
    margin-top: 100px;
    margin-left: 400px;
  }
</style>
@endsection

@section('content')
<div id="error" class="ui centered row">
    <br>
    <br>
    <h1>Page not found</h1>
    <h3 class="text-center">Mate, are you trying to access something?</h3>
</div>
@endsection
