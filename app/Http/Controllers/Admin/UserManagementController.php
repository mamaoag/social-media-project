<?php

namespace Tragala\Http\Controllers\Admin;

use Auth;
use Tragala\User;
use Illuminate\Http\Request;
use Tragala\Http\Controllers\Controller;
class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {
         $data = User::paginate(10);
         return view('admin.user.index',['users' => $data]);
     }

     /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function show($id)
     {
         $data = User::findOrFail($id);
         return view('admin.user.see',['user' => $data]);
     }

     /**
      * Show the form for editing the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function edit($id)
     {
         $data = User::findOrFail($id);
         return view('admin.user.edit',['user' => $data]);
     }

     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function update(Request $request, $id)
     {
         $this->validate($request,[
           'fname' => 'min:2',
           'lname' => 'min:2',
           'uname' => 'min:3|unique:users,username',
           'email' => 'email|unique:users,email',
           'password' => 'confirmed'
         ]);

         User::find($id)->update([
           'first_name' => $request->fname,
           'last_name' => $request->lname,
           'username' => $request->uname,
           'location' => $request->location,
           'email' => $request->email,
           'password' => $request->pass,
         ]);

         return view('admin.user.index')->withTitle('Account Updated')->withInfo($request->first_name.'s profile updated');
     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function changeStatus($id)
     {
       $data = User::findOrFail($id);
       if (Auth::user()->activated == 1){

       }
       else{
         if($data->activated == 1){
           $data->update('activated', 0);
         }
         else{
           $data->update('activated',1);
         }
       }
     }

}
