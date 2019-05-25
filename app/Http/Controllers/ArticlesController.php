<?php

namespace Corp\Http\Controllers;

use Illuminate\Http\Request;

use Corp\Repositories\ArticlesRepository;
use Corp\Repositories\CommentsRepository;
use Corp\Repositories\PhotosRepository;
use Photo;
use Config;

class ArticlesController extends SiteController
{
    public function __construct(ArticlesRepository $a_rep, CommentsRepository $c_rep,PhotosRepository $p_rep){

        parent::__construct(new \Corp\Repositories\MenusRepository(new \Corp\Menu),new \Corp\Repositories\PhotosRepository(new \Corp\Photo));
        
        $this->p_rep = $p_rep;
        $this->a_rep = $a_rep;
        $this->c_rep = $c_rep;
        
        $this->template = env('THEME').'.articles';
    }

     public function index()
    {
        //
        
        //$articles = $this->getArticles();
        //$content = view(env('THEME').'.articles_content')->with('articles',$articles)->render();
        //$this->vars = array_add($this->vars,'content',$content);
        
        //$comments = $this->getComments(config('settings.recent_comments'));

        //$this->content_head = 'Новости';
        //return $this->renderOutput();
    }

    //protected function getArticles($alias=FALSE) 
    //{
    //    $articles = $this->a_rep->get('*',FALSE,TRUE);
    
    //    return $articles;
    //}

    public function getComments($take) 
    {
       	$comments = $this->c_rep->get('*',$take);
    	
    	return $comments;
    }

    public function show($alias=FALSE)
    {
    	$article=$this->a_rep->one($alias,['comments'=>TRUE]);
        
    	$content=view(env('THEME').'.article_content')->with('article',$article)->render();
		
		$this->vars = array_add($this->vars,'content',$content);
    	
    	$this->content_head = $article->title;
        $this->title_head = $article->title;
        
        $bar='right';
        $photos=$this->getPhotos();
        
        $indexBar = view(env('THEME').'.indexBar')->with('photos',$photos)->with('bar',$bar)->render();
        $this->vars = array_add($this->vars,'indexBar',$indexBar);  
        
        
        
        return $this->renderOutput();
    }
    protected function getPhotos() 
{
        $photo = $this->p_rep->get(['image','title','created_at'],Config::get('settings.home_photo_count'));

        return $photo;

    }

}
