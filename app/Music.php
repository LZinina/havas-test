<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    protected $fillable = ['title','alias','path_itunes','category_id'];
    
    

	public function user() {
    	return $this->belongsTo('Corp\User');
    }

    public function category() {
    	return $this->belongsTo('Corp\Category');
    }


    
	
}
