<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable = ['link','music_id','res_names_id'];

public function musics() {
    	return $this->belongsTo('Corp\Music');
    }

public function res_names() {
    	return $this->belongsTo('Corp\Res_name');
    }

}
