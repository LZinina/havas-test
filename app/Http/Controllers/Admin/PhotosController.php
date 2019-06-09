<?php

namespace Corp\Http\Controllers\Admin;
use Gate;
use Corp\Photo;

use Corp\Http\Requests;
use Illuminate\Http\Request;
use Corp\Http\Controllers\Controller;
use Corp\Http\Requests\PhotoRequest;
use Corp\Repositories\PhotosRepository;
use Corp\Repositories\AlbumsRepository;

class PhotosController extends AdminController
{
    protected $al_rep;
    public function __construct(PhotosRepository $p_rep, AlbumsRepository $al_rep){
        parent::__construct();
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if(Gate::denies('VIEW_ADMIN_ARTICLES')){
                abort(403);
            }
            return $next($request);
        });

        $this->p_rep = $p_rep;
        $this->al_rep = $al_rep;
        $this->template = env('THEME').'.admin.admin_template';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos = $this->getPhotos();

        $this->content = view(env('THEME').'.admin.photos_content')->with('photos',$photos)->render();
        
        return $this->renderOutput();
    }

    public function getPhotos()
    {
        return $this->p_rep->get();
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
        
        
        $albums = $this->getAlbums()->reduce(function ($returnAlbums, $album) {
            $returnAlbums[$album->id] = $album->title;
            
            return $returnAlbums;
        }, []);
        
        $content_header = "Добавить новое фото";
        
        $this->content = view(env('THEME').'.admin.photos_create_content')->with(['content_header'=> $content_header, 'albums'=> $albums])->render();
        
        return $this->renderOutput();
    }

    public function getAlbums() {
        return $this->al_rep->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PhotoRequest $request)
    {
        $result = $this->p_rep->addPhotos($request);
        
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
    public function destroy(Photo $photo)
    {
        $result = $this->p_rep->deletePhoto($photo);
        if(is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }
        return redirect('/admin')->with($result);
    }
}
