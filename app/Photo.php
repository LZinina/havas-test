<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //
    public function album() {
    	return $this->belongsTo('Corp\Album');
    }
}
