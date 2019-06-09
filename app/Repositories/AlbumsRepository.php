<?php
namespace Corp\Repositories;
use Gate;
use Corp\Album;

class AlbumsRepository extends Repository {
	
	public function __construct (Album $album) {
		
		$this->model = $album;
	
	}

	public function addAlbums($request) {

		if(Gate::denies('save', new \Corp\Article)) {
			abort(403);
		}
		
		$data = $request->all();
		if(empty($data)) {
			return array('error' => 'Нет данных');
		}
		$album = $this->model->create([
		    'title' => $data['title'],
		    ]);
		return ['status' => 'Альбом добавлен'];                     
		}
		
	

	public function deleteAlbum($album) {
		
		if (Gate::denies('edit', new \Corp\Article)) {
            abort(403);
        }
		
		if($album->delete()) {
			return ['status' => 'Альбом удален'];	
		}
	}
	
}
?>