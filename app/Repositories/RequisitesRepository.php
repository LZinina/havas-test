<?php
namespace Corp\Repositories;
use Gate;
use Corp\Requisite;

class RequisitesRepository extends Repository {
	
	public function __construct (Requisite $requisites) {
		
		$this->model = $requisites;
	
	}

	public function addRequisites($request) {

		if(Gate::denies('save', new \Corp\Article)) {
			abort(403);
		}
		
		$data = $request->all();
		
		$requisite = $this->model->create([
		    'text_en' => $data['text_en'],
		    'text_uz' => $data['text_uz'],
		    'text_ru' => $data['text_ru'],
		    ]);
		return ['status' => 'Реквизиты добавлены'];                     
	}

	public function deleteRequisite($requisite) {
		
		if (Gate::denies('edit', new \Corp\Article)) {
            abort(403);
        }
		
		if($requisite->delete()) {
			return ['status' => 'Реквизиты удалены'];	
		}
	}
}
?>