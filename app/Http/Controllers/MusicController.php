<?php

namespace Corp\Http\Controllers;
use Link;
use Photo;
use Config;
use Illuminate\Http\Request;
use Corp\Repositories\MusicsRepository;
use Corp\Repositories\PhotosRepository;
use Corp\Repositories\LinkRepository;
use Corp\Repositories\CategoriesRepository;
use Corp\Http\Requests;
use Corp\Category;

class MusicController extends SiteController
{
    //
    public function __construct(MusicsRepository $mus_rep, PhotosRepository $p_rep, LinkRepository $li_rep,CategoriesRepository $cat_rep){

        parent::__construct(new \Corp\Repositories\MenusRepository(new \Corp\Menu));
        $this->mus_rep = $mus_rep;
        $this->p_rep = $p_rep;
        $this->li_rep = $li_rep;
        $this->cat_rep = $cat_rep;
        $this->template = env('THEME').'.articles';

    }

    public function index($cat_alias = FALSE)
    {
        $musics = $this->getMusics($cat_alias);
        $links = $this->getLinks();
        $categories = $this->getCategories();

        $content = view(env('THEME').'.music_content')->with(['musics'=>$musics, 'links'=>$links, 'categories'=>$categories])->render();
        $this->vars = array_add($this->vars,'content',$content);
               
        $this->title_head = trans('message.text_Havas_guruhi');
        $this->content_head = trans('message.text_music');
        
        return $this->renderOutput();
    }

    public function getMusics($alias=False)
    {
        $where = FALSE;
        if($alias) {
            $id = Category::select('id')->where('alias',$alias)->first()->id;
            $where = ['category_id',$id];
        } 
    	$musics=$this->mus_rep->get('*',FALSE,TRUE,$where);

        if($musics) {
            $musics->load('category');
        }

    	return $musics;
    }

    public function getLinks()
        {
            $links = $this->li_rep->get('*',FALSE,FALSE,FALSE);
            return $links;
        }

    public function getCategories()
    {
        $categories = $this->cat_rep->get('*',FALSE,FALSE,FALSE);
        return $categories;
    }
}
