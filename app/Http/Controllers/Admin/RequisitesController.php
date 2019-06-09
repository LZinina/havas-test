<?php

namespace Corp\Http\Controllers\Admin;

use Gate;
use Corp\Requisite;
use Corp\Http\Requests;
use Illuminate\Http\Request;
use Corp\Http\Requests\AlbumRequest;
use Corp\Http\Controllers\Controller;
use Corp\Repositories\RequisitesRepository;

class RequisitesController extends AdminController
{
    protected $req_rep;
    public function __construct(RequisitesRepository $req_rep){
        parent::__construct();
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if(Gate::denies('VIEW_ADMIN_ARTICLES')){
                abort(403);
            }
            return $next($request);
        });

        $this->req_rep = $req_rep;
        $this->template = env('THEME').'.admin.admin_template';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requisites = $this->getRequisites();

        $this->content = view(env('THEME').'.admin.requisites_content')->with('requisites',$requisites)->render();
        
        return $this->renderOutput();
    }

    public function getRequisites()
    {
       return $this->req_rep->get();
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
        
        
        $content_header = "Добавить новые реквизиты";
        
        $this->content = view(env('THEME').'.admin.requisites_create_content')->with(['content_header'=> $content_header])->render();
        
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
        $result = $this->req_rep->addRequisites($request);
        
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
    public function destroy(Requisite $requisite)
    {
         $result = $this->req_rep->deleteRequisite($requisite);
        if(is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }
        return redirect('/admin')->with($result);
    }
}
