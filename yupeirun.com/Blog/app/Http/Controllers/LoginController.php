<?php

namespace App\Http\Controllers;

use Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Redirect;
use App\User;
use Validator;
use App\Article;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
	public function postLogin(){
		
	 $rules = array(
        'email'       => 'required|email',
        'password'    => 'required|min:6',
        'remember_me' => 'boolean',
      );
      $validator = Validator::make(Request::all(), $rules);
      //验证通过
      if ($validator->passes())
      {
        if (Auth::attempt([
          'email'    => Request::input('email'),
          'password' => Request::input('password'),
          'block'    => 0], 
          (boolean) Request::input('remember_me')))
        {
          return Redirect::to('users/home');
        } 
        //账号或密码错误
        else {
          return Redirect::to('users/login')->withInput()->with('message', array('type' => 'danger', 'content' => 'E-mail or password error'));
        }
      } 
      //数据格式错误
      else {
        return Redirect::to('users/login')->withInput()->withErrors($validator);
      }
    }
	public function getHome(){
    if (Auth::check()) {
        return view('users.home')->with('user', Auth::user())->with('articles', Article::with('tags')->where('user_id', '=', Auth::id())->orderBy('created_at', 'desc')->get());
    }else{
    return Redirect::to('users/login');
   }
		}
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
