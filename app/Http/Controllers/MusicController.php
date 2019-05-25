<?php

namespace Corp\Http\Controllers;

use Photo;
use Config;
use Illuminate\Http\Request;
use Corp\Repositories\MusicRepository;
use Corp\Repositories\PhotosRepository;

class MusicController extends SiteController
{
    //
    public function __construct(MusicRepository $mus_rep){

        parent::__construct(new \Corp\Repositories\MenusRepository(new \Corp\Menu),new \Corp\Repositories\PhotosRepository(new \Corp\Photo));
        $this->mus_rep = $mus_rep;
        $this->template = env('THEME').'.musics';
    }

    public function index()
    {
        //
        $musics = $this->getMusics();
        $content = view(env('THEME').'.music_content')->with('musics',$musics)->render();
        $this->vars = array_add($this->vars,'content',$content);

        $bar='right';
        $photos=$this->getPhotos();
        $indexBar = view(env('THEME').'.indexBar')->with('photos',$photos)->with('bar',$bar)->render();
        $this->vars = array_add($this->vars,'indexBar',$indexBar); 
                
        $this->title_head = 'Музыка';
        $this->content_head = 'Музыка';
        
        return $this->renderOutput();
    }

    public function getMusics()
    {
    	$musics=$this->mus_rep->get('*',FALSE,FALSE);
    	
    	return $musics;
    }

    protected function getPhotos() 
    {
        $photo = $this->p_rep->get(['image','title','created_at'],Config::get('settings.home_photo_count'));

        return $photo;

    }
}
