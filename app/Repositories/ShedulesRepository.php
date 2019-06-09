<?php
namespace Corp\Repositories;

use Gate;
use Image;
use Corp\Shedule;

class ShedulesRepository extends Repository {
	
	public function __construct (Shedule $shedules) {
		
		$this->model = $shedules;
	
	}

	public function one($alias,$attr = array()) {

		$shedule = parent::one($alias,$attr);

		return $shedule;
	}

	public function addShedule($request) {

		if(Gate::denies('save', new \Corp\Article)) {
			abort(403);
		}
		

		$data = $request->except('_token');
		
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
		$shedule = $this->model->create([
		           'title_en' => $data['title_en'],
		           'title_uz' => $data['title_uz'],
		           'title_ru' => $data['title_ru'],
		           'alias' => $data['alias'], 
		           'data' => $data['data'],
		           'time' => $data['time'],
		           'price_en' => $data['price_en'],
		           'price_uz' => $data['price_uz'],
		           'price_ru' => $data['price_ru'],
		           
		           'address_en' => $data['address_en'],
		           'address_uz' => $data['address_uz'],
		           'address_ru' => $data['address_ru'],

		           'text_en' => $data['text_en'],
		           'text_uz' => $data['text_uz'],
		           'text_ru' => $data['text_ru'],
		           
		           
		        ]);
					return ['status' => 'Материал добавлен'];  
	}

	public function updateShedule($request, $shedule) {

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
		
		if(isset($result->id) && ($result->id != $shedule->id)) {
			$request->merge(array('alias' => $data['alias']));
			$request->flash();
			
			return ['error' => 'Данный псевдоним уже успользуется'];
		}
		
		$shedule->fill($data); 
				
		if($shedule->update()) {
			return ['status' => 'Материал обновлен'];
		} 

	}
	
	public function deleteShedule($shedule) {
		
		if (Gate::denies('edit', new \Corp\Article)) {
            abort(403);
        }
		
		if($shedule->delete()) {
			return ['status' => 'Материал удален'];	
		}
	}
}
?>