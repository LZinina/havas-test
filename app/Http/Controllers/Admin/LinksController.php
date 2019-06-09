<?php

namespace Corp\Http\Controllers\Admin;

use Gate;
use Corp\Link;
use Corp\Http\Requests;
use Illuminate\Http\Request;
use Corp\Http\Controllers\Controller;
use Corp\Http\Requests\LinkRequest;
use Corp\Repositories\LinkRepository;
use Corp\Repositories\MusicsRepository;
use Corp\Repositories\Res_namesRepository;


class LinksController extends AdminController
{
	public function __construct(LinkRepository $li_rep, MusicsRepository $mus_rep, Res_namesRepository $res_rep){
        parent::__construct();
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if(Gate::denies('VIEW_ADMIN_ARTICLES')){
                abort(403);
            }
            return $next($request);
        });

        $this->li_rep = $li_rep;
        $this->mus_rep = $mus_rep;
        $this->res_rep = $res_rep;
        
        $this->template = env('THEME').'.admin.admin_template';
    }
     public function index()
    {
        $links = $this->getLinks();

        $this->content = view(env('THEME').'.admin.link_content')->with('links',$links)->render();
        
        return $this->renderOutput();
    }

    public function getLinks()
    {
        return $this->li_rep->get();
    }

    public function create()
    {
        if(Gate::denies('save', new \Corp\Article)) {
            abort(403);
        }
        
        
        $musics = $this->getMusics()->reduce(function ($returnMusics, $music) {
            $returnMusics[$music->id] = $music->title;
            
            return $returnMusics;
        }, []);
        $res_names = $this->getRes_names()->reduce(function ($returnRes_names, $res_name) {
            $returnRes_names[$res_name->id] = $res_name->title;
            
            return $returnRes_names;
        }, []);
        $content_header = "Добавить новую ссылку";
        
        $this->content = view(env('THEME').'.admin.link_create_content')->with(['content_header'=> $content_header, 'musics'=> $musics, 'res_names'=>$res_names])->render();
        
        return $this->renderOutput();
    }

    public function getMusics() {
        return $this->mus_rep->get();
    }

    public function getRes_names() {
        return $this->res_rep->get();
    }

	public function store(Request $request)
    {
        $result = $this->li_rep->addLinks($request);
        
        if(is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }
        
        return redirect('/admin')->with($result);
    }

    public function destroy(Link $link)
    {
        $result = $this->li_rep->deleteLink($link);
        if(is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }
        return redirect('/admin')->with($result);
    }
}
