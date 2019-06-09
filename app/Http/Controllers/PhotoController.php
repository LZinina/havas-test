<?php

namespace Corp\Http\Controllers;

use Illuminate\Http\Request;
use Corp\Repositories\PhotosRepository;

class PhotoController extends SiteController
{
	public function __construct(PhotosRepository $p_rep){

        parent::__construct(new \Corp\Repositories\MenusRepository(new \Corp\Menu),new \Corp\Repositories\PhotosRepository(new \Corp\Photo));
        
        
        $this->p_rep = $p_rep;
                
        $this->template = env('THEME').'.articles';
    }

    public function index()
    {
        //
        $photos = $this->getPhotos();
        $content = view(env('THEME').'.photo_content')->with('photos',$photos)->render();
        $this->vars = array_add($this->vars,'content',$content);
        
        $this->title_head = trans('message.text_Havas_guruhi');
        $this->content_head = trans('message.text_gallery');

        $bar='left';

        $indexBar = view(env('THEME').'.indexBar')->with('photos',$photos)->with('bar',$bar)->render();
        $this->vars = array_add($this->vars,'indexBar',$indexBar);  
        
        return $this->renderOutput();
    }

    public function getPhotos($alias=FALSE){
    	$photos=$this->p_rep->get('*',FALSE,TRUE,FALSE);
    	if($photos){
    		//$photos->load('album');
    	}
    	return $photos;
    }

    //protected function getArticles($alias=FALSE) 
    //{
    //    $articles = $this->a_rep->get('*',FALSE,TRUE);
    
    //    return $articles;
    //}
    //

}
