<?php

namespace Tragala\Http\Controllers;

use Auth;
use Tragala\User;
use Tragala\Posts;
use Tragala\Likes;
use Tragala\Comments;
use Illuminate\Http\Request;
use Tragala\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
      $data = Posts::orderBy('created_at','asc')->paginate(5);

      return view('index',['posts'=>$data]);
    }

}
