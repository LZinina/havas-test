<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

class Requisite extends Model
{
    protected $fillable = ['text_en','text_uz', 'text_ru'];


    
	public function getTextAttribute()
	{
	$locale = \App::getLocale();
	$column = "text_" . $locale;
	return $this->{$column};
	}
}
