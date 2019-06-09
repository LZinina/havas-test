<?php

namespace Corp\Http\Controllers;
use Photo;
use Video;
use Config;
use Illuminate\Http\Request;
use Corp\Repositories\VideosRepository;
use Corp\Repositories\PhotosRepository;

class VideosController extends SiteController
{
    public function __construct(VideosRepository $v_rep, PhotosRepository $p_rep){

        parent::__construct(new \Corp\Repositories\MenusRepository(new \Corp\Menu));
        
        $this->v_rep = $v_rep;
        $this->p_rep = $p_rep;
        $this->template = env('THEME').'.articles';

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = $this->getVideos();
        $content = view(env('THEME').'.video_content')->with('videos',$videos)->render();
        
        $this->vars = array_add($this->vars,'content',$content);

        $this->title_head = trans('message.text_Havas_guruhi');
        $this->content_head = trans('message.text_video');
        
        return $this->renderOutput();
    }

    public function getVideos()
    {
        $video=$this->v_rep->get('*',FALSE,TRUE,FALSE);
        
        return $video;
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
