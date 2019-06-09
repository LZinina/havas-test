<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = ['title_en','title_uz','title_ru','alias','img'];

    public function getTitleAttribute()
	{
	$locale = \App::getLocale();
	$column = "title_" . $locale;
	return $this->{$column};
	}
}
