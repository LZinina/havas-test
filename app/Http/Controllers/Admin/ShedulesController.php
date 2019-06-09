<?php

namespace Corp\Http\Controllers\Admin;

use Gate;
use Corp\Shedule;

use Corp\Http\Requests;
use Illuminate\Http\Request;
use Corp\Http\Controllers\Controller;
use Corp\Http\Requests\SheduleRequest;
use Corp\Repositories\ShedulesRepository;

class ShedulesController extends AdminController
{
    public function __construct(ShedulesRepository $sh_rep){
        parent::__construct();
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if(Gate::denies('VIEW_ADMIN_ARTICLES')){
                abort(403);
            }
            return $next($request);
        });

        $this->sh_rep = $sh_rep;

        $this->template = env('THEME').'.admin.admin_template';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shedules = $this->getShedules();

        $this->content = view(env('THEME').'.admin.shedule_content')->with('shedules',$shedules)->render();
        
        return $this->renderOutput();
    }
    public function getShedules()
    {
        return $this->sh_rep->get();
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
        
        $content_header = "Добавить новое расписание";
        
        $this->content = view(env('THEME').'.admin.shedule_create_content')->with('content_header', $content_header)->render();
        
        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SheduleRequest $request)
    {
        $result = $this->sh_rep->addShedule($request);
        
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
        $shedule=$this->sh_rep->one($alias);
        
               
        $content_header = 'Редактирование расписания - '. $shedule->title_ru;
        
        
        $this->content = view(env('THEME').'.admin.shedule_create_content')->with(['shedule' => $shedule, 'content_header'=>$content_header])->render();
        
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
        $shedule=$this->sh_rep->one($alias);
        $result = $this->sh_rep->updateShedule($request,$shedule);
        
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
        $shedule=$this->sh_rep->one($alias);
        
       $result = $this->sh_rep->deleteShedule($shedule);
        
        if(is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }
        
        return redirect('/admin')->with($result);
    }
}
