<?php
namespace Corp\Repositories;

use Corp\Photo;

class PhotosRepository extends Repository {
	
	public function __construct (Photo $photo) {
		
		$this->model = $photo;
	
	}

	
}
?>