<?php

namespace Tragala\Http\Controllers\JSON;

use Tragala\User
use Illuminate\Http\Request;
use Tragala\Http\Controllers\Controller;

class UserController extends Controller
{
    public function data()
    {
        $data = User::all();
        return response()->json($data);
    }
}
