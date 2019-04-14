<?php

namespace Corp\Http\Controllers;
use Corp\Repositories\ArticlesRepository;
use Illuminate\Http\Request;

class ArticlesController extends SiteController
{
    public function __construct(ArticlesRepository $a_rep){

        parent::__construct(new \Corp\Repositories\MenusRepository(new \Corp\Menu),new \Corp\Repositories\PhotosRepository(new \Corp\Photo));
        
        
        $this->a_rep = $a_rep;
        
        $this->template = env('THEME').'.articles';
    }

     public function index()
    {
        //
        
        $articles = $this->getArticles();
        $content = view(env('THEME').'.articles_content')->with('articles',$articles)->render();
        $this->vars = array_add($this->vars,'content',$content);

        $this->content_head = 'Новости';
        return $this->renderOutput();
    }

    protected function getArticles($alias=FALSE) {
        $articles = $this->a_rep->get('*',FALSE,TRUE);
        if($articles) {
        	//$articles->load('user','category','comments');
        }

        return $articles;

    }

    public function show($id)
    {}

}
