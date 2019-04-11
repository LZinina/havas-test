<?php

namespace Corp\Http\Controllers;

use Corp\Http\Requests;
use Illuminate\Http\Request;
use Corp\Repositories\SlidersRepository;
use Corp\Repositories\ArticlesRepository;
use Config;


class IndexController extends SiteController
{

    public function __construct(SlidersRepository $s_rep, ArticlesRepository $a_rep){

        parent::__construct(new \Corp\Repositories\MenusRepository(new \Corp\Menu));
        
        $this->s_rep = $s_rep;
        $this->a_rep = $a_rep;
        $this->bar='right';
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

        return $this->renderOutput();
    }

    protected function getArticles() {
        $article = $this->a_rep->get('*',Config::get('settings.home_port_count'));

        return $article;

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
