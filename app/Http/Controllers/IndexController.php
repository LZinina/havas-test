<?php

namespace Corp\Http\Controllers;

use Corp\Http\Requests;
use Illuminate\Http\Request;
use Corp\Repositories\SlidersRepository;
use Corp\Repositories\ArticlesRepository;
use Corp\Repositories\PhotosRepository;
use Photo;
use Config;
use Auth;


class IndexController extends SiteController
{


    public function __construct(SlidersRepository $s_rep, ArticlesRepository $a_rep,PhotosRepository $p_rep)
    {
        parent::__construct(new \Corp\Repositories\MenusRepository(new \Corp\Menu),new \Corp\Repositories\PhotosRepository(new \Corp\Photo));
        $this->p_rep = $p_rep;
        $this->s_rep = $s_rep;
        $this->a_rep = $a_rep;
        
        $this->template = env('THEME').'.index';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        $articles = $this->getArticles();

        



        $content = view(env('THEME').'.content')->with('articles',$articles)->render();
        $this->vars = array_add($this->vars,'content',$content);
        
        $sliderItems = $this->getSliders();

        $sliders = view(env('THEME').'.slider')->with('sliders',$sliderItems)->render();
        
        $this->vars = array_add($this->vars,'sliders',$sliders);

        $this->keywords = 'Havas.uz';
        $this->meta_desc = 'Havas.uz';
        $this->title_head = trans('message.text_Havas_guruhi');
        $this->content_head = trans('message.text_news');
        
        return $this->renderOutput();
    }

    protected function getArticles($alias=FALSE) 
    {
        $articles = $this->a_rep->get('*',FALSE,TRUE,FALSE);
        
       
        return $articles;
    }

   
    

     public function getSliders()
    {
        $sliders = $this->s_rep->get();

        return $sliders;
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
