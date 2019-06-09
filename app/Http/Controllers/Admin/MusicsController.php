<?php

namespace Corp\Http\Controllers\Admin;

use Gate;
use Corp\Music;
use Corp\Http\Requests;
use Illuminate\Http\Request;
use Corp\Http\Controllers\Controller;
use Corp\Http\Requests\MusicRequest;
use Corp\Repositories\MusicsRepository;
use Corp\Repositories\CategoriesRepository;

class MusicsController extends AdminController
{   protected $cat_rep;
     
     public function __construct(MusicsRepository $mus_rep, CategoriesRepository $cat_rep){
        parent::__construct();
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if(Gate::denies('VIEW_ADMIN_ARTICLES')){
                abort(403);
            }
            return $next($request);
        });

        $this->mus_rep = $mus_rep;
        $this->cat_rep = $cat_rep;

        $this->template = env('THEME').'.admin.admin_template';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $musics = $this->getMusics();

        $this->content = view(env('THEME').'.admin.music_content')->with('musics',$musics)->render();
        
        return $this->renderOutput();
    }
    
    public function getMusics()
    {
        return $this->mus_rep->get();
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
        $categories = $this->getCategories()->reduce(function ($returnCategories, $category) {
            $returnCategories[$category->id] = $category->title;
            
            return $returnCategories;
        }, []);
        
        $content_header = "Добавить новый материал";
        
        $this->content = view(env('THEME').'.admin.music_create_content')->with(['content_header'=> $content_header, 'categories'=> $categories])->render();
        
        return $this->renderOutput();
    }

     public function getCategories() {
        return $this->cat_rep->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MusicRequest $request)
    {
         $result = $this->mus_rep->addMusic($request);
        
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
        $music=$this->mus_rep->one($alias);
                       
        $content_header = 'Редактирование материала - '. $music->title;
                
        $this->content = view(env('THEME').'.admin.music_create_content')->with(['music' => $music, 'content_header'=>$content_header])->render();
        
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
        $music=$this->mus_rep->one($alias);
        $result = $this->mus_rep->updateMusic($request,$music);
        

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
        $music=$this->mus_rep->one($alias);
        
       $result = $this->mus_rep->deleteMusic($music);
        
        if(is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }
        
        return redirect('/admin')->with($result);
    }
}
