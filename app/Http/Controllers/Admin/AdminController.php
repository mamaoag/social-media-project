<?php

namespace Tragala\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use Tragala\Http\Controllers\Controller;
class AdminController extends Controller
{
    public function index()
    {
      return view('admin.index');
    }
}
