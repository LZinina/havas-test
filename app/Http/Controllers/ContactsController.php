<?php

namespace Corp\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Config;



class ContactsController extends SiteController
{
    //
    public function __construct(){

        parent::__construct(new \Corp\Repositories\MenusRepository(new \Corp\Menu));
        
        $this->template = env('THEME').'.contacts';
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
        $this->title_head = 'Контакты';
        $this->content_head = 'Контакты';
        
        $content = view(env('THEME').'.contact_content')->render();
        $this->vars = array_add($this->vars,'content',$content);

        $bar='left';
        $indexBar = view(env('THEME').'.indexBar')->with('bar',$bar)->render();
        $this->vars = array_add($this->vars,'indexBar',$indexBar);  

        return $this->renderOutput();
    }
}
