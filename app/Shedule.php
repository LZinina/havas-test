<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

class Shedule extends Model
{
    protected $fillable = ['title_en','title_uz','title_ru','alias','data','time','price_en','price_uz','price_ru','address_en','address_uz','address_ru','text_en','text_uz','text_ru'];


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

	public function getPriceAttribute()
	{
	$locale = \App::getLocale();
	$column = "price_" . $locale;
	return $this->{$column};
	}
	public function getAddressAttribute()
	{
	$locale = \App::getLocale();
	$column = "address_" . $locale;
	return $this->{$column};
	}
}
