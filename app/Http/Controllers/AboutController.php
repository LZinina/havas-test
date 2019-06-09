<?php

namespace Corp\Http\Controllers;

use Illuminate\Http\Request;
use Corp\Repositories\AboutRepository;
use Corp\Repositories\PhotosRepository;
use Photo;
use Config;
use About;

class AboutController extends SiteController
{
    public function __construct(AboutRepository $ab_rep, PhotosRepository $p_rep){

        parent::__construct(new \Corp\Repositories\MenusRepository(new \Corp\Menu),new \Corp\Repositories\PhotosRepository(new \Corp\Photo));
        
        $this->p_rep = $p_rep;
        $this->ab_rep = $ab_rep;
                
        $this->template = env('THEME').'.articles';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $about = $this->getAbout();

        $content = view(env('THEME').'.about_content')->with('about',$about)->render();
        $this->vars = array_add($this->vars,'content',$content);
        
        $this->keywords = 'Havas.uz';
        $this->meta_desc = 'Havas.uz';
        $this->title_head = trans('message.text_Havas_guruhi');
        $this->content_head = trans('message.text_about_us');
        
        return $this->renderOutput();
    }

    public function getAbout()
    {
        $about=$this->ab_rep->get('*',FALSE,FALSE,FALSE);
        
        return $about;
    }

     public function show($alias=FALSE)
    {
        $about=$this->ab_rep->one($alias);
        
        $content=view(env('THEME').'.one_about_content')->with('about',$about)->render();
        
        $this->vars = array_add($this->vars,'content',$content);
        
        if(isset($about->id)) {
        $this->content_head = $about->title_ru;
        $this->title_head = $about->title_ru;
        }

        
        
        
        
        return $this->renderOutput();
    }
    
   
}
