<?php

namespace Corp\Http\Controllers;

use Illuminate\Http\Request;

//use Corp\Http\Requests;

use Corp\Repositories\MenusRepository;
use Corp\Repositories\PhotosRepository;
use Photo;
use Menu;
use Config;


class SiteController extends Controller
{
    //

    protected $p_rep; //photos
	protected $s_rep;//slider
	protected $a_rep;//articles
	protected $m_rep;//menus
    protected $c_rep; //photos
    protected $mus_rep;//musics
    protected $v_rep;//video
    protected $req_rep;//requisits
    protected $ab_rep;//about
    protected $sh_rep;//shedule

	protected $keywords; 
	protected $meta_desc;
	protected $title_head;
	protected $content_head;
    protected $bar;

	protected $template;

	protected $vars = array();

	public function __construct(MenusRepository $m_rep) 
    {
    	$this->m_rep = $m_rep;
    }
    
    protected function renderOutput()
    {

    	$menu = $this->getMenu();
        
        $bar='right';
        $photos=$this->getPhotos();
        $indexBar = view(env('THEME').'.indexBar')->with('photos',$photos)->with('bar',$bar)->render();
        $this->vars = array_add($this->vars,'indexBar',$indexBar); 


    	$navigation = view(env('THEME').'.navigation')->with('menu',$menu)->render();
    	$this->vars = array_add($this->vars,'navigation',$navigation);

    	$footer = view(env('THEME').'.footer')->render();
    	$this->vars = array_add($this->vars,'footer',$footer);	
    	
        $this->vars = array_add($this->vars,'keywords',$this->keywords);	    	
		$this->vars = array_add($this->vars,'meta_desc',$this->meta_desc);	
		$this->vars = array_add($this->vars,'title_head',$this->title_head);
		$this->vars = array_add($this->vars,'content_head',$this->content_head);
        $this->vars = array_add($this->vars,'bar',$this->bar);

    	return view($this->template)->with($this->vars);
    }

    
    
    protected function getMenu() {

    	$menu = $this->m_rep->get();

    	$mBuilder = Menu::make('MyNav', function($m) use($menu){
    		foreach ($menu as $item) {
				if($item->parent ==0) {
					$m->add($item->title,$item->path)->id($item->id);
				}
				else {
					if($m->find($item->parent)) {
						$m->find($item->parent)->add($item->title,$item->path)->id($item->id);
					}
				}
    		}
    	});
    	
    	
    	return $mBuilder;
    }

    protected function getPhotos() 
{
        $photo = $this->p_rep->get(['image','title','created_at'],Config::get('settings.home_photo_count'));

        return $photo;

    }
    

}
