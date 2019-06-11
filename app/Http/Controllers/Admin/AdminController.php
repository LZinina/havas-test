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
    protected $ab_rep;
    protected $sh_rep;
    protected $cat_rep;
    protected $sl_rep;
    protected $mus_rep;
    protected $res_rep;
    protected $li_rep;



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

    	$footer = view(env('THEME').'.admin.footer')->render();
		$this->vars = array_add($this->vars,'footer',$footer);

		return view($this->template)->with($this->vars);
    }

    public function getMenu()
    	{
    		return Menu::make('adminMenu', function($menu) {
    			$menu->add('Новости',array('route' => 'admin.posts.index'));

                $menu->add('Музыкальные категории',array('route' => 'admin.categories.index'));
                $menu->add('Музыкальные ресурсы',array('route' => 'admin.res_names.index'));
                $menu->add('Музыка',array('route' => 'admin.musics.index'));
                $menu->add('Музыкальные ссылки',array('route' => 'admin.links.index'));
                $menu->add('Слайдер',array('route' => 'admin.sliders.index'));
    			$menu->add('Альбомы с фото',array('route' => 'admin.albums.index'));
                $menu->add('Фото',array('route' => 'admin.photos.index'));
                $menu->add('Видео',array('route' => 'admin.videos.index'));
                $menu->add('Расписание концертов',array('route' => 'admin.shedules.index'));
                $menu->add('О нас',array('route' => 'admin.abouts.index'));
                $menu->add('Реквизиты',array('route' => 'admin.requisites.index'));
    			$menu->add('Пользователи',array('route' => 'admin.users.index'));
    			$menu->add('Привилегии',array('route' => 'admin.permissions.index'));

    		});
    	}
}
