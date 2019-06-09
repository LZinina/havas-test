<?php

namespace Corp\Http\Controllers;

use Illuminate\Http\Request;
use Corp\Repositories\ShedulesRepository;
use Corp\Repositories\PhotosRepository;
use Photo;
use Config;
use Shedule;
class ShedulesController extends SiteController
{
    public function __construct(ShedulesRepository $sh_rep, PhotosRepository $p_rep){

        parent::__construct(new \Corp\Repositories\MenusRepository(new \Corp\Menu),new \Corp\Repositories\PhotosRepository(new \Corp\Photo));
        
        $this->sh_rep = $sh_rep;
        $this->p_rep = $p_rep;
                
        $this->template = env('THEME').'.articles';
    }

    public function index()
    {
        $shedules = $this->getShedule();

        $content = view(env('THEME').'.shedule_content')->with('shedules',$shedules)->render();
        $this->vars = array_add($this->vars,'content',$content);
        
        $this->keywords = 'Havas.uz';
        $this->meta_desc = 'Havas.uz';
        $this->title_head = trans('message.text_Havas_guruhi');
        $this->content_head = trans('message.text_concert_schedule');
        
        return $this->renderOutput();
    }

    public function getShedule()
    {
        $shedules=$this->sh_rep->get('*',FALSE,TRUE,FALSE);
        
        return $shedules;
    }

     
}
