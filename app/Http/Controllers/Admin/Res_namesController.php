<?php

namespace Corp\Http\Controllers\Admin;
use Gate;
use Corp\Res_name;
use Corp\Http\Requests;
use Illuminate\Http\Request;
use Corp\Http\Requests\Res_nameRequest;
use Corp\Http\Controllers\Controller;
use Corp\Repositories\Res_namesRepository;


class Res_namesController extends AdminController
{
    public function __construct(Res_namesRepository $res_rep){
        parent::__construct();
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if(Gate::denies('VIEW_ADMIN_ARTICLES')){
                abort(403);
            }
            return $next($request);
        });

        $this->res_rep = $res_rep;
        $this->template = env('THEME').'.admin.admin_template';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res_names = $this->getRes();

        $this->content = view(env('THEME').'.admin.res_content')->with('res_names',$res_names)->render();
        
        return $this->renderOutput();
    }

    public function getRes()
    {
       return $this->res_rep->get();
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
        
        
        $content_header = "Добавить ресурс";
        
        $this->content = view(env('THEME').'.admin.res_create_content')->with(['content_header'=> $content_header])->render();
        
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
        $result = $this->res_rep->addRes($request);
        
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Res_name $res_name)
    {
        $result = $this->res_rep->deleteRes($res_name);
        if(is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }
        return redirect('/admin')->with($result);
    }
}
