@extends('templates.admin')

@section('title')
Dashboard - Administrator
@endsection

@section('content')
<h3>Hello there {{Auth::user()->first_name}}! Here are your reports.</h3>
@endsection
