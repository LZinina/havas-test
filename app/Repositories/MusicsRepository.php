<?php
namespace Corp\Repositories;

use Gate;
use Corp\Music;



class MusicsRepository extends Repository {
	
	public function __construct (Music $music) {
		
		$this->model = $music;
	
	}

	public function one($alias,$attr = array()) {

		$music = parent::one($alias,$attr);

		return $music;
	}

	public function addMusic($request) {

		if(Gate::denies('save', new \Corp\Article)) {
			abort(403);
		}
		
		$data = $request->except('_token');
		
		if(empty($data)) {
			return array('error' => 'Нет данных');
		}
		
		if(empty($data['alias'])) {
			$data['alias'] = $this->transliterate($data['title']);
		}

		if($this->one($data['alias'],FALSE)) {
			$request->merge(array('alias' => $data['alias']));
			$request->flash();
			
			return ['error' => 'Данный псевдоним уже используется'];
		}

			$music = $this->model->create([
		           'title' => $data['title'],
		           'alias' => $data['alias'],
		           'path_itunes' => $data['path_itunes'],
		           'category_id' => $data['category_id'], 
		           
		        ]);
					return ['status' => 'Трек добавлен'];
				         
			
		
	}

	public function updateMusic($request, $music) {

		if(Gate::denies('edit', new \Corp\Article)) {
			abort(403);
		}
		
		$data = $request->except('_token','_method');
		
		if(empty($data)) {
			return array('error' => 'Нет данных');
		}
		
		if(empty($data['alias'])) {
			$data['alias'] = $this->transliterate($data['title']);
		}
		
		$result = $this->one($data['alias'],FALSE);
		
		if(isset($result->id) && ($result->id != $music->id)) {
			$request->merge(array('alias' => $data['alias']));
			$request->flash();
			
			return ['error' => 'Данный псевдоним уже успользуется'];
		}
		
		$music->fill($data); 
			
		if($music->update()) {
			return ['status' => 'Трек обновлен'];
		} 

	}
	
	public function deleteMusic($music) {
		
		if (Gate::denies('edit', new \Corp\Article)) {
            abort(403);
        }
		
		if($music->delete()) {
			return ['status' => 'Трек удален'];	
		}
	}
}
?>