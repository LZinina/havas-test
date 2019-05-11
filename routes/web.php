<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/','IndexController',[
										'only'=>['index'],
									  	'names'=>['index'=>'home']
									  ]);

Route::resource('articles','ArticlesController',[
										'parametres' =>[
											'articles' => 'alias']
									  ]);

Route::resource('photos','PhotoController',[
										'parametres' =>[
											'photos' => 'id']
									  ]);
Route::resource('comment','CommentController',['only'=>['store']]);

Route::resource('music','MusicController',[
										'parametres' =>[
											'musics' => 'id']
									  ]);
Route::match(['get','post'],'/contacts',['uses'=>'ContactsController@index','as'=>'contacts']);

Route::group(['prefix'=>'admin','middleware'=>'auth'],function(){
	//admin
	Route::get('/',['uses' =>'Admin\IndexController@index','as' => 'adminIndex']);
	
	Route::resource('/articles','Admin\ArticlesController');
});