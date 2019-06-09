<?php

namespace Corp\Http\Controllers;

use Illuminate\Http\Request;
use Corp\Repositories\PhotosRepository;
use Mail;
use Config;
use Photo;
use Requisite;
use Corp\Repositories\RequisitesRepository;


class ContactsController extends SiteController
{
    //
    public function __construct(PhotosRepository $p_rep, RequisitesRepository $req_rep){

        parent::__construct(new \Corp\Repositories\MenusRepository(new \Corp\Menu),new \Corp\Repositories\PhotosRepository(new \Corp\Photo), new \Corp\Repositories\RequisitesRepository(new \Corp\Requisite));
        $this->p_rep = $p_rep;
        $this->req_rep = $req_rep;
        $this->template = env('THEME').'.articles';
    }

    public function index(Request $request)
    {
    	if ($request->isMethod('post')) {
    		$messages = [
    			'required' => "Поле :attribute обязательно к заполнению",
    			'email' => "Поле :attribute должно содержать правильный адрес"
    		];

    		$this->validate($request,[
    			'name' => 'required|max:255',
    			'email' => 'email|email',
    			'text' => 'required'
    		],$messages);

    		$data = $request->all();

    		$result = Mail::send(env('THEME').'.email',['data'=>$data], function($message) use ($data){
				//$mail_admin = env('MAIL_ADMIN');
                
				$message->from($data['email'],$data['name']);
				$message->to(env('MAIL_USERNAME'))->subject('Question');
    		});

    		if($result) {
                //Session::flash('status','Email is send');
    			return redirect()->route('contacts')->with('status','Email is send');
    		}
    	}
    	
        $this->keywords = 'Havas.uz';
        $this->meta_desc = 'Havas.uz';
        $this->title_head = trans('message.text_Havas_guruhi');
        $this->content_head = trans('message.text_contacts');
        
        $requisites = $this->getRequisites();

        $content = view(env('THEME').'.contact_content')->with('requisites',$requisites)->render();
        $this->vars = array_add($this->vars,'content',$content);

        return $this->renderOutput();
    }

    public function getRequisites()
    {
        $requisites=$this->req_rep->get('*',FALSE,FALSE,FALSE);
        
        return $requisites;
    }
}
