<?php
namespace Corp\Repositories;

use Gate;
use Image;
use Corp\About;

class AboutRepository extends Repository {
	
	public function __construct (About $abouts) {
		
		$this->model = $abouts;
	
	}

	public function one($alias,$attr = array()) {

		$about = parent::one($alias,$attr);

		return $about;
	}

	public function addAbout($request) {

		if(Gate::denies('save', new \Corp\Article)) {
			abort(403);
		}
		
		$data = $request->except('_token','image');
		
		if(empty($data)) {
			return array('error' => 'Нет данных');
		}
		
		if(empty($data['alias'])) {
			$data['alias'] = $this->transliterate($data['title_ru']);
		}

		if($this->one($data['alias'],FALSE)) {
			$request->merge(array('alias' => $data['alias']));
			$request->flash();
			
			return ['error' => 'Данный псевдоним уже используется'];
		}

		if($request->hasFile('image')) {
			$image = $request->file('image');
			if($image->isValid()) {
				$str = str_random(8);
				
				$obj = $str.'.jpg';
				
				$img = Image::make($image);
				
				$img->save(public_path().'/'.env('THEME').'/images/about/'.$obj);
				
				$data['img'] = $obj;  
				
				$about = $this->model->create([
		           'title_en' => $data['title_en'],
		           'title_uz' => $data['title_uz'],
		           'title_ru' => $data['title_ru'],
		           'text_en' => $data['text_en'],
		           'text_uz' => $data['text_uz'],
		           'text_ru' => $data['text_ru'],
		           'alias' => $data['alias'], 
		           'img' => $data['img'],
		        ]);
					return ['status' => 'Материал добавлен'];
				         
			}
		}
	}

	public function updateAbout($request, $about) {

		if(Gate::denies('edit', new \Corp\Article)) {
			abort(403);
		}
		
		$data = $request->except('_token','image','_method');
		
		if(empty($data)) {
			return array('error' => 'Нет данных');
		}
		
		if(empty($data['alias'])) {
			$data['alias'] = $this->transliterate($data['title_ru']);
		}
		
		$result = $this->one($data['alias'],FALSE);
		
		if(isset($result->id) && ($result->id != $about->id)) {
			$request->merge(array('alias' => $data['alias']));
			$request->flash();
			
			return ['error' => 'Данный псевдоним уже успользуется'];
		}
		
		if($request->hasFile('image')) {
			$image = $request->file('image');
			
			if($image->isValid()) {
				
				$str = str_random(8);
				
				$obj = $str.'.jpg';
				
				$img = Image::make($image);
				
				$img->save(public_path().'/'.env('THEME').'/images/about/'.$obj);
				
				$data['img'] = $obj;  
			}         
				
			}
		
		$about->fill($data); 
			
		if($about->update()) {
			return ['status' => 'Материал обновлен'];
		} 

	}
	
	public function deleteAbout($about) {
		
		if (Gate::denies('edit', new \Corp\Article)) {
            abort(403);
        }
		
		unlink(public_path().'/'.env('THEME').'/images/about/'.$about->img);
		
		
		if($about->delete()) {
			return ['status' => 'Материал удален'];	
		}
	}
}
?>