<?php
namespace Corp\Repositories;

use Gate;
use Image;
use Corp\Article;

class ArticlesRepository extends Repository {
	
	public function __construct (Article $articles) {
		
		$this->model = $articles;
	
	}

	public function one($alias,$attr = array()) {

		$article = parent::one($alias,$attr);

		if($article && !empty($attr)) {

			$article->load('comments');
			$article->comments->load('user');
		}
	
		return $article;
	}

	public function addArticle($request) {

		if(Gate::denies('save', $this->model)) {
			abort(403);
		}
		
		$data = $request->except('_token','image');
		
		if(empty($data)) {
			return array('error' => 'Нет данных');
		}
		
		if(empty($data['alias'])) {
			$data['alias'] = $this->transliterate($data['title_ru']);
		}
		
		if($this->one($data['alias'],FALSE)) {
			$request->merge(array('alias' => $data['alias']));
			$request->flash();
			
			return ['error' => 'Данный псевдоним уже используется'];
		}

		if($request->hasFile('image')) {
			$image = $request->file('image');
			if($image->isValid()) {
				$str = str_random(8);
				
				$obj = $str.'.jpg';
				
				$img = Image::make($image);
				
				$img->save(public_path().'/'.env('THEME').'/images/articles/'.$obj);
				
				$data['img'] = $obj;  
				
				$this->model->fill($data);  
				
				if($request->user()->articles()->save($this->model)) {
					return ['status' => 'Материал добавлен'];
				}                          
			}
		}

			          
	
	}

	public function updateArticle($request, $article) {

		if(Gate::denies('edit', $this->model)) {
			abort(403);
		}
		
		$data = $request->except('_token','image','_method');
		
		if(empty($data)) {
			return array('error' => 'Нет данных');
		}
		
		if(empty($data['alias'])) {
			$data['alias'] = $this->transliterate($data['title_ru']);
		}
		
		$result = $this->one($data['alias'],FALSE);
		
		if(isset($result->id) && ($result->id != $article->id)) {
			$request->merge(array('alias' => $data['alias']));
			$request->flash();
			
			return ['error' => 'Данный псевдоним уже успользуется'];
		}
		
		if($request->hasFile('image')) {
			$image = $request->file('image');
			
			if($image->isValid()) {
				
				$str = str_random(8);
				
				$obj = $str.'.jpg';
				
				$img = Image::make($image);
				
				$img->save(public_path().'/'.env('THEME').'/images/articles/'.$obj);
				
				$data['img'] = $obj;  
			}         
				
			}
			
		$article->fill($data); 
				
		if($article->update()) {
			return ['status' => 'Материал обновлен'];
		} 

	}
	
	public function deleteArticle($article) {
		
		if(Gate::denies('destroy', $article)) {
			abort(403);
		}
		
		$article->comments()->delete();
		unlink(public_path().'/'.env('THEME').'/images/articles/'.$article->img);
		
		if($article->delete()) {
			return ['status' => 'Материал удален'];
		}
		
	}
}
?>