<?php

namespace App\Http\Controllers;

use Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Redirect;
use Hash;
use App\User;
use Validator;

class RegisterController extends Controller
{
   
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	
	public function getRegister(){
		  return view('users.register');
	}
    public function show($id)
    {
      
    }
	
	public function postCreate(Request $request){
	$rules = [
    'email' => 'required|email|unique:users,email',
    'nickname' => 'required|min:4|unique:users,nickname',
    'password' => 'required|min:6|confirmed',
  ];
  $validator = Validator::make(Request::all(), $rules);
  if ($validator->passes())
  {
    $user = new user();
    $user->email = Request::input('email');
    $user->nickname = Request::input('nickname');
    $user->password = Hash::make(Request::input('password'));
    if ($user->save())
    {
      return Redirect::to('users/login')->with('message', array('type' => 'success', 'content' => 'Register successfully, please login'));
    } else {
      return Redirect::to('users/register')->withInput()->with('message', array('type' => 'danger', 'content' => 'Register failed'));
    }
  } else {
    return Redirect::to('users/register')->withInput()->withErrors($validator);
  }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function getLogin(){
    return view('users.login');
		}
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
