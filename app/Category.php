<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

	protected $fillable = ['title_en','title_uz','title_ru','alias'];

    public function musics() {
        return $this->hasMany('Corp\Music');
    }

    public function getTitleAttribute()
	{
	$locale = \App::getLocale();
	$column = "title_" . $locale;
	return $this->{$column};
	}
}
