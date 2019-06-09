<?php

namespace Corp\Http\Controllers\Admin;

use Gate;
use Corp\Slider;
use Corp\Http\Requests;
use Illuminate\Http\Request;
use Corp\Http\Controllers\Controller;
use Corp\Http\Requests\SliderRequest;
use Corp\Repositories\SlidersRepository;

class SlidersController extends AdminController
{
     
     public function __construct(SlidersRepository $sl_rep){
        parent::__construct();
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if(Gate::denies('VIEW_ADMIN_ARTICLES')){
                abort(403);
            }
            return $next($request);
        });

        $this->sl_rep = $sl_rep;


        $this->template = env('THEME').'.admin.admin_template';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = $this->getSliders();

        $this->content = view(env('THEME').'.admin.slider_content')->with('sliders',$sliders)->render();
        
        return $this->renderOutput();
    }
    
    public function getSliders()
    {
        return $this->sl_rep->get();
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
        
        $this->content = view(env('THEME').'.admin.slider_create_content')->with('content_header', $content_header)->render();
        
        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderRequest $request)
    {
         $result = $this->sl_rep->addSlider($request);
        
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
        $slider=$this->sl_rep->one($alias);
                       
        $content_header = 'Редактирование материала - '. $slider->title_ru;
                
        $this->content = view(env('THEME').'.admin.slider_create_content')->with(['slider' => $slider, 'content_header'=>$content_header])->render();
        
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
        $slider=$this->sl_rep->one($alias);
        $result = $this->sl_rep->updateSlider($request,$slider);
        

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
        $slider=$this->sl_rep->one($alias);
        
       $result = $this->sl_rep->deleteSlider($slider);
        
        if(is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }
        
        return redirect('/admin')->with($result);
    }
}
