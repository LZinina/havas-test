<?php
namespace Corp\Repositories;
use Gate;
use Image;
use Corp\Slider;

class SlidersRepository extends Repository {
	
	public function __construct (Slider $slider) {
		
		$this->model = $slider;
	
	}

	public function one($alias,$attr = array()) {

		$slider = parent::one($alias,$attr);

		return $slider;
	}

	public function addSlider($request) {

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
				
				$slider = $this->model->create([
		           'title_en' => $data['title_en'],
		           'title_uz' => $data['title_uz'],
		           'title_ru' => $data['title_ru'],
		           
		           'alias' => $data['alias'], 
		           'img' => $data['img'],
		        ]);
					return ['status' => 'Слайд добавлен'];
				         
			}
		}
	}

	public function updateSlider($request, $slider) {

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
		
		if(isset($result->id) && ($result->id != $slider->id)) {
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
		
		$slider->fill($data); 
			
		if($slider->update()) {
			return ['status' => 'Слайд обновлен'];
		} 

	}
	
	public function deleteSlider($slider) {
		
		if (Gate::denies('edit', new \Corp\Article)) {
            abort(403);
        }
		
		unlink(public_path().'/'.env('THEME').'/images/about/'.$about->img);
		
		
		if($slider->delete()) {
			return ['status' => 'Слайд удален'];	
		}
	}

	
}
?>