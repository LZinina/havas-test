<?php
namespace Corp\Repositories;
use Gate;
use Corp\Category;

class CategoriesRepository extends Repository {
	
	public function __construct (Category $category) {
		
		$this->model = $category;
	
	}

	public function addCategory($request) {

		if(Gate::denies('save', new \Corp\Article)) {
			abort(403);
		}
		
		$data = $request->all();
		
		$category = $this->model->create([
		    'title_en' => $data['title_en'],
		    'title_uz' => $data['title_uz'],
		    'title_ru' => $data['title_ru'],
		    'alias' => $data['alias'],
		    ]);
		return ['status' => 'Категория добавлена'];                     
		}
		
	public function deleteCategory($category) {
		
		if (Gate::denies('edit', new \Corp\Article)) {
            abort(403);
        }
		
		if($category->delete()) {
			return ['status' => 'Категория удалена'];	
		}
	}
	
}
?>