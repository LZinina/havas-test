<?php

namespace Corp\Http\Controllers\Admin;

use Gate;
use Corp\Category;
use Corp\Http\Requests;
use Illuminate\Http\Request;
use Corp\Http\Requests\CategoryRequest;
use Corp\Http\Controllers\Controller;
use Corp\Repositories\CategoriesRepository;

class CategoriesController extends AdminController
{

    public function __construct(CategoriesRepository $cat_rep){
        parent::__construct();
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if(Gate::denies('VIEW_ADMIN_ARTICLES')){
                abort(403);
            }
            return $next($request);
        });

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
        $categories = $this->getCategories();

        $this->content = view(env('THEME').'.admin.category_content')->with('categories',$categories)->render();
        
        return $this->renderOutput();
    }

    public function getCategories()
    {
       return $this->cat_rep->get();
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
        
        
        $content_header = "Добавить категорию";
        
        $this->content = view(env('THEME').'.admin.category_create_content')->with(['content_header'=> $content_header])->render();
        
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
        $result = $this->cat_rep->addCategory($request);
        
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
    public function edit()
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
    public function destroy(Category $category)
    {
        $result = $this->cat_rep->deleteCategory($category);
        if(is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }
        return redirect('/admin')->with($result);
    }
}
