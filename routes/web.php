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

Route::auth();

Route::get('/home', 'HomeController@index')->name('home');
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
											'musics' => 'alias']
									  ]);

Route::get('music/cat/{cat_alias?}',['uses'=>'MusicController@index','as'=>'musicsCat'])->where('cat_alias','[\w-]+');   

Route::resource('video','VideosController',[
										'parametres' =>[
											'videos' => 'id']
									  ]);
Route::resource('about','AboutController',[
										'parametres' =>[
											'about' => 'alias']
									  ]);
Route::resource('shedule','ShedulesController',[
										'parametres' =>[
											'shedules' => 'id']
									  ]);
Route::match(['get','post'],'/contacts',['uses'=>'ContactsController@index','as'=>'contacts']);

Route::group(['as' => 'admin.', 'prefix'=>'admin','middleware'=>'auth'],function(){
	//admin
	Route::get('/',['uses' =>'Admin\IndexController@index','as' => 'adminIndex']);
	
	Route::resource('/posts','Admin\PostsController',[
										'parametres' =>['articles' => 'alias']
													 ]);

	Route::resource('/users','Admin\UsersController',[
										'parametres' =>[
											'users' => 'id']
									  ]);
		
	Route::resource('/abouts','Admin\AboutsController',[
										'parametres' =>['abouts' => 'alias']
													 ]);
	
	Route::resource('/shedules','Admin\ShedulesController',[
										'parametres' =>['shedules' => 'alias']
													 ]);

	Route::resource('/musics','Admin\MusicsController',[
										'parametres' =>['musics' => 'alias']
													 ]);

	Route::resource('/sliders','Admin\SlidersController',[
										'parametres' =>[
											'sliders' => 'alias']
									  ]);
	
	Route::resource('/links','Admin\LinksController');

	Route::resource('/permissions','Admin\PermissionsController');
	Route::resource('/photos','Admin\PhotosController');
	Route::resource('/albums','Admin\AlbumsController');
	Route::resource('/videos','Admin\VideosController');
	Route::resource('/requisites','Admin\RequisitesController');
	Route::resource('/categories','Admin\CategoriesController');
	Route::resource('/res_names','Admin\Res_namesController');
});