<?php
namespace Corp\Repositories;
use Gate;
use Corp\Res_name;

class Res_namesRepository extends Repository {
	
	public function __construct (Res_name $res_names) {
		
		$this->model = $res_names;
	
	}

	public function addRes($request) {

		if(Gate::denies('save', new \Corp\Article)) {
			abort(403);
		}
		
		$data = $request->all();

		if(empty($data)) {
			return array('error' => 'Нет данных');
		}

		$res_name = $this->model->create([
		    'title' => $data['title'],
		    ]);   
		return ['status' => 'Ресурс добавлен'];                 
		}
		
	public function deleteRes($res_name) {
		
		if (Gate::denies('edit', new \Corp\Article)) {
            abort(403);
        }
		
		if($res_name->delete()) {
			return ['status' => 'Ресурс удален'];	
		}
	}
	
}
?>