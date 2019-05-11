<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    public function photos() {
        return $this->hasMany('Corp\Photo');
    }
}
