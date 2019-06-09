<?php
namespace Corp\Repositories;

use Corp\Photo;
use Gate;
use Image;


class PhotosRepository extends Repository {
	
	
	public function __construct (Photo $photo) {
		
		$this->model = $photo;
	
	}
	
	public function addPhotos($request) {

		if(Gate::denies('save', new \Corp\Article)) {
			abort(403);
		}
		
		$data = $request->except('image');
		
		if($request->hasFile('image')) {
			$image = $request->file('image');
			if($image->isValid()) {
				$str = str_random(8);
				
				$obj = $str.'.jpg';
				
				$img = Image::make($image);
				
				$img->save(public_path().'/'.env('THEME').'/images/photos/'.$obj);
				
				$data['image'] = $obj;  
				
				$photo = $this->model->create([
		           'title' => $data['title'],
		           'image' => $data['image'],
		           'album_id' => $data['album_id'],
		            
		        ]);
				return ['status' => 'Фото добавлено'];                     
			}
		}
	}

	public function deletePhoto($photo) {
		
		if (Gate::denies('edit', new \Corp\Article)) {
            abort(403);
        }
        unlink(public_path().'/'.env('THEME').'/images/photos/'.$photo->image);
		if($photo->delete()) {
			return ['status' => 'Фото удалено'];	
		}
	}
}
?>