<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    
    protected $fillable = ['title','image','album_id'];

    public function album() {
    	return $this->belongsTo('Corp\Album');
    }
}
