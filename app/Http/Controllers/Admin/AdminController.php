<?php

namespace Corp\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Corp\Http\Controllers\Controller;
use Auth;
use Corp\User;
use Menu;

use Gate;


class AdminController extends \Corp\Http\Controllers\Controller
{
    protected $p_rep;
    protected $a_rep;
    protected $user;
    protected $template;
    protected $content = FALSE;
    protected $title;
    protected $vars;

    public function __construct() {
    	$this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if(Gate::denies('VIEW_ADMIN_ARTICLES')){
                abort(403);
            }
            return $next($request);
        });
    }

    public function renderOutput(){
    	$this->vars = array_add($this->vars,'title',$this->title);

    	$menu = $this->getMenu(); 

    	$navigation = view(env('THEME').'.admin.navigation')->with('menu',$menu)->render();

    	$this->vars = array_add($this->vars,'navigation',$navigation);

    	if($this->content) {
    		$this->vars = array_add($this->vars,'content',$this->content);
    	};

    	//$footer = view(env('THEME').'.admin.footer')->render();
		//$this->vars = array_add($this->vars,'footer',$footer);

		return view($this->template)->with($this->vars);
    }

    public function getMenu()
    	{
    		return Menu::make('adminMenu', function($menu) {
    			$menu->add('Статьи',array('route' => 'admin.posts.index'));
    			$menu->add('Меню',array('route' => 'admin.posts.index'));
    			$menu->add('Пользователи',array('route' => 'admin.posts.index'));
    			$menu->add('Привилегии',array('route' => 'admin.posts.index'));
    		});
    	}
}
