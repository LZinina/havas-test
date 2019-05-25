<?php

namespace Corp\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Corp\Http\Requests;
use Corp\Http\Controllers\Controller;

use Gate;
class IndexController extends AdminController
{
    public function __construct(){
    	parent::__construct();
    	$this->middleware('auth');
    	$this->middleware(function ($request, $next) {

    	if(Gate::denies('VIEW_ADMIN')){
    		abort(403);
    	}
    	return $next($request);
    	});

    	$this->template = env('THEME').'.admin.index';
    }

    public function index() {
    	$this->title = 'Панель администратора';

    	return $this->renderOutput();
    }
}
