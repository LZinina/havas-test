<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
	protected $fillable = ['title'];
    public function photos() {
        return $this->hasMany('Corp\Photo');
    }
}
