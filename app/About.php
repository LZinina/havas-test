<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = ['title_en','title_uz','title_ru','text_en','text_uz','text_ru','alias','img'];



    public function getTitleAttribute()
	{
	$locale = \App::getLocale();
	$column = "title_" . $locale;
	return $this->{$column};
	}
	public function getTextAttribute()
	{
	$locale = \App::getLocale();
	$column = "text_" . $locale;
	return $this->{$column};
	}
}
