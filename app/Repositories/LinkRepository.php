<?php
namespace Corp\Repositories;

use Corp\Link;
use Gate;
use Image;


class LinkRepository extends Repository {
	
	
	public function __construct (Link $links) {
		
		$this->model = $links;
	
	}
	
	public function addLinks($request) {

		if(Gate::denies('save', new \Corp\Article)) {
			abort(403);
		}
		
		$data = $request->all();
		
		if(empty($data)) {
			return array('error' => 'Нет данных');
		}
				
				$link = $this->model->create([
		           'link' => $data['link'],
		           'musics_id' => $data['music_id'],
		           'res_names_id' => $data['res_name_id'],
		            
		        ]);
				return ['status' => 'Ссылка добавлена'];                     
			}


	public function deleteLink($link) {
		
		if (Gate::denies('edit', new \Corp\Article)) {
            abort(403);
        }
        if($link->delete()) {
			return ['status' => 'Ссылка удалена'];	
		}
	}
}
?>