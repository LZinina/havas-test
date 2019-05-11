<?php
namespace Corp\Repositories;

use Corp\Music;

class MusicRepository extends Repository {
	
	public function __construct (Music $music) {
		
		$this->model = $music;
	
	}

	
}
?>