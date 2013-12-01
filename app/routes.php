<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('cristalab', function()
{
	return View::make('cristalab');
});

Route::get('hello/{usuario}', function($usuario)
{
	return "Hello $usuario";
});

Route::get('tags/{tag}', function($tag)
{
	return "Your are browsing $tag tag";
});

Route::get('user/edit/{id}', function($id){
	return "You are editing the user with the ID #$id";
})
->where('id','[0-9]+');

Route::get('pasta-with-meatballs/{id_table}, {type}', array('as' => 'pasta_meatballs', 'uses' => 'ItalianController@pastaWithMeatBalls'))->where('id_table', '[0-9]+');

Route::get('table/{id}', array('as' => 'table', 'uses' => ' tableController@index'))->where('id', '[0-9]+');

Route::get('menu', function(){
	return View::make('menu');
});

Route::get('template', function(){
	return View::make('template');
});

Route::get('template/{name}', function($name){
	$name = ucwords(str_replace('-', ' ', $name));
	return View::make('template')->with('name',$name);
});

Route::resource('admin/users', 'Admin_UsersController');