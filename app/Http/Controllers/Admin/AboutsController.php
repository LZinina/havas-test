<?php

namespace Corp\Http\Controllers\Admin;

use Gate;
use Corp\About;
use Corp\Http\Requests;
use Illuminate\Http\Request;
use Corp\Http\Controllers\Controller;
use Corp\Http\Requests\ArticleRequest;
use Corp\Repositories\AboutRepository;

class AboutsController extends AdminController
{
     
     public function __construct(AboutRepository $ab_rep){
        parent::__construct();
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if(Gate::denies('VIEW_ADMIN_ARTICLES')){
                abort(403);
            }
            return $next($request);
        });

        $this->ab_rep = $ab_rep;


        $this->template = env('THEME').'.admin.admin_template';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $abouts = $this->getAbout();

        $this->content = view(env('THEME').'.admin.about_content')->with('abouts',$abouts)->render();
        
        return $this->renderOutput();
    }
    
    public function getAbout()
    {
        return $this->ab_rep->get();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::denies('save', new \Corp\Article)) {
            abort(403);
        }
        
        $content_header = "Добавить новый материал";
        
        $this->content = view(env('THEME').'.admin.about_create_content')->with('content_header', $content_header)->render();
        
        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
         $result = $this->ab_rep->addAbout($request);
        
        if(is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }
        
        return redirect('/admin')->with($result);
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
    public function edit($alias=FALSE)
    {
        if(Gate::denies('edit', new \Corp\Article)) {
            abort(403);
        }
        $about=$this->ab_rep->one($alias);
                       
        $content_header = 'Редактирование материала - '. $about->title_ru;
                
        $this->content = view(env('THEME').'.admin.about_create_content')->with(['about' => $about, 'content_header'=>$content_header])->render();
        
        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$alias=FALSE)
    {
        $about=$this->ab_rep->one($alias);
        $result = $this->ab_rep->updateAbout($request,$about);
        

        if(is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }
        
        return redirect('/admin')->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($alias=FALSE)
    {
        $about=$this->ab_rep->one($alias);
        
       $result = $this->ab_rep->deleteAbout($about);
        
        if(is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }
        
        return redirect('/admin')->with($result);
    }
}
