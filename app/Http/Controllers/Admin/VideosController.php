<?php

namespace Corp\Http\Controllers\Admin;
use Gate;
use Corp\Video;
use Corp\Http\Requests;
use Illuminate\Http\Request;
use Corp\Http\Requests\VideoRequest;
use Corp\Http\Controllers\Controller;
use Corp\Repositories\VideosRepository;


class VideosController extends AdminController
{
    protected $v_rep;
    public function __construct(VideosRepository $v_rep){
        parent::__construct();
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if(Gate::denies('VIEW_ADMIN_ARTICLES')){
                abort(403);
            }
            return $next($request);
        });
        $this->v_rep = $v_rep;
        $this->template = env('THEME').'.admin.admin_template';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos= $this->getVideos();

        $this->content = view(env('THEME').'.admin.videos_content')->with('videos',$videos)->render();
        
        return $this->renderOutput();
    }
    
    public function getVideos()
    {
        return $this->v_rep->get();
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
        
        
        $content_header = "Добавить новое видео";
        
        $this->content = view(env('THEME').'.admin.videos_create_content')->with(['content_header'=> $content_header])->render();
        
        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = $this->v_rep->addVideos($request);
        
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
    public function destroy(Video $video)
    {
        $result = $this->v_rep->deleteVideo($video);
        if(is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }
        return redirect('/admin')->with($result);
    }
}
