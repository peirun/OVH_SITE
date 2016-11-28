<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
	
	$articles = App\Article::with('users', 'tags')->orderBy('created_at', 'desc')->paginate(3);    //分页
	$tags = App\Tag::where('count', '>', '0')->orderBy('count', 'desc')->orderBy('updated_at', 'desc')->take(10)->get();
	return view('index')->with('articles', $articles)->with('tags', $tags);
});

Route::get('welcome',function(){
    return view('welcome');
});



Route::get('users/register','RegisterController@getRegister');

Route::post('users/register','RegisterController@postCreate');

Route::get('users/login','RegisterController@getLogin');




/*Route::controller('users', 'RegisterController');

Route::controller('users', 'LoginController');
*/

Route::post('users/login', 'LoginController@postLogin');
Route::post('users/home', 'LoginController@postLogin');
Route::get('users/home','LoginController@getHome');
Route::get('users/{user}/articles', 'UserController@articles');

//edit
Route::get('users/{id}/edit','EditController@getEdit');
Route::post('users/{id}','EditController@postEdit');
Route::post('users/login',['as'=>'users.login','uses'=>'EditController@postEdit']);





Route::group(['prefix' => 'admin', 'middleware' => ['auth','isAdmin']], function()
{
  Route::get('articles', 'AdminController@articles');
  Route::get('tags', 'AdminController@tags');
  //用户列表管理

  Route::get('users', function()
  {
    return view('admin.users.list')->with('users', App\User::all())->with('page', 'users');
  });
});

//路由群组：已登录且为管理员
Route::group(['middleware' => ['auth','isAdmin']], function()
{
  //密码重置
  Route::get('users/{user}/reset', function(App\User $user)
  {
    $user->password = Hash::make('123456');
    $user->save();
    return Redirect::to('admin/users')->with('message', array('type' => 'success', 'content' => 'Reset password successfully'));
  });
    //锁定用户
  Route::get('users/{user}/delete', function(App\User $user)
  {
    $user->block = 1;
    $user->save();
    return Redirect::to('admin/users')->with('message', array('type' => 'success', 'content' => 'Lock user successfully'));
  });
//解锁用户
  Route::get('users/{user}/unblock', function(App\User $user)
  {
    $user->block = 0;
    $user->save();
    return Redirect::to('admin/users')->with('message', array('type' => 'success', 'content' => 'Unlock user successfully'));
  });
});

Route::post('tag/{id}',['middleware' => 'auth','uses' => 'TagController@update']);
Route::get('tag/{id}/articles', 'TagController@articles');
Route::resource('tag', 'TagController');
Route::get('tag/{id}/delete',['middleware' => 'auth','uses'=>'TagController@destroy']);


Route::get('users/{id}/edit', ['middleware' => 'auth', 'as' => 'users.edit', function($id)
{    
  
    if (Auth::user()->is_admin or Auth::id() == $id) {
        return view('users.edit')->with('user', App\User::find($id));
    } else {
     
        return Redirect::to('/');
    }
}]);

Route::post('article/preview', ['middleware' => 'auth', 'uses' => 'ArticleController@preview']);
Route::resource('article', 'ArticleController');

Route::post('articles/{id}/preview', ['middleware' => 'auth', 'uses' => 'ArticleController@preview']);
Route::get('articles/{id}/edit', ['middleware' => ['auth','canOperation'], 'uses' => 'ArticleController@edit']);
Route::post('article/{id}', ['middleware' => ['auth','canOperation'], 'uses' => 'ArticleController@update']);
Route::get('articles/{id}/delete', ['middleware' => ['auth','canOperation'], 'uses' => 'ArticleController@destroy']);


Route::get('logout', ['middleware' => 'auth', function()
{
  Auth::logout();
  return Redirect::to('/');
}]);
