<?php

namespace Tragala\Http\Controllers\Admin;

use Auth;
use Tragala\User;
use Illuminate\Http\Request;
use Tragala\Http\Controllers\Controller;

class AdminController extends Controller
{

    public function __construct()
    {
      $this->middleware('admin');
    }

    public function index()
    {
      $data = User::all();
      return view('admin.dashboard',['users' => $data ]);
    }
}
