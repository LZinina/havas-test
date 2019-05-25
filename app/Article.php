<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    protected $fillable = ['title','text','img','alias','desc','category_id'];
    
    public function category() {
    	return $this->belongsTo('Corp\Category','category_id','id');
    }

	public function user() {
    	return $this->belongsTo('Corp\User','user_id','id');
    }

    public function comments() {
    	return $this->hasMany('Corp\Comment');
    }

}
