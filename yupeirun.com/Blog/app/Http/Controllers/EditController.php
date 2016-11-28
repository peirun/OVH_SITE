<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Redirect;
use Input;
use Validator;
use Hash;

class EditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
	public function getEdit($id){
		if (Auth::user()->is_admin or Auth::id() == $id) {
        return view('users.edit')->with('user', User::find($id));
    } else {
     //否则跳转至主页
        return Redirect::to('/');
    }
	} 
	
	public function postEdit($id){
	if (Auth::user()->is_admin or (Auth::id() == $id)) {
    $user = user::find($id);
    //验证数据格式
    $rules = array(
      'password' => 'required_with:old_password|min:6|confirmed',
      'old_password' => 'min:6',
    );
    if (!(Input::get('nickname') == $user->nickname))
    {
      $rules['nickname'] = 'required|min:4||unique:users,nickname';
    }
    $validator = Validator::make(Input::all(), $rules);
    if ($validator->passes())
    {
      if (!(Input::get('old_password') == '')) {
        if (!Hash::check(Input::get('old_password'), $user->password)) {
          return Redirect::route('users.home', $id)->with('user', $user)->with('message', array('type' => 'danger', 'content' => 'Old password error'));
        } else {
          $user->password = Hash::make(Input::get('password'));
        }
      }
      $user->nickname = Input::get('nickname');
      $user->save();
      //修改成功返回信息
      return Redirect::route('users.login')->with('message', array('type' => 'success', 'content' => 'Modify successfully, please login'));
    } else {
      //返回错误信息
      return Redirect::route('users.edit', $id)->withInput()->with('user', $user)->withErrors($validator); 
    }
  } else {
    return Redirect::to('/');
  }
		
	}
	
	public function __construct(){
		$this->middleware('auth');
		
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
