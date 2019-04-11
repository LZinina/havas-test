<?php

namespace Corp\Http\Controllers;

use Illuminate\Http\Request;

//use Corp\Http\Requests;

use Corp\Repositories\MenusRepository;

use Menu;

class SiteController extends Controller
{
    //

    protected $p_rep; //photos
	protected $s_rep;//slider
	protected $a_rep;//articles
	protected $m_rep;//menus

	protected $template;

	protected $vars = array();

	protected $contentRightBar = FALSE;
	
	protected $contentLeftBar = FALSE;


	protected $bar = FALSE;
    
    public function __construct(MenusRepository $m_rep) {

    	$this->m_rep = $m_rep;

    }
    
    protected function renderOutput(){

    	$menu = $this->getMenu();

    	$navigation = view(env('THEME').'.navigation')->with('menu',$menu)->render();
    	
    	$this->vars = array_add($this->vars,'navigation',$navigation);

    	$photos=FALSE;
    	$indexBar = view(env('THEME').'.indexBar')->with('photos',$photos)->render();
    	$this->vars = array_add($this->vars,'indexBar',$indexBar);	
    	
    	
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

}