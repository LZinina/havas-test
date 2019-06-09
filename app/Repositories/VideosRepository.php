<?php
namespace Corp\Repositories;
use Gate;
use Corp\Video;

class VideosRepository extends Repository {
	
	public function __construct (Video $video) {
		
		$this->model = $video;
	
	}

	public function addVideos($request) {

		if(Gate::denies('save', new \Corp\Article)) {
			abort(403);
		}
		
		$data = $request->all();
		
		$video = $this->model->create([
		    'name' => $data['name'],
		    'filename' => $data['filename'],
		    ]);
		return ['status' => 'Видео добавлено'];                     
	}

	public function deleteVideo($video) {
		
		if (Gate::denies('edit', new \Corp\Article)) {
            abort(403);
        }
		
		if($video->delete()) {
			return ['status' => 'Видео удалено'];	
		}
	}
}
?>