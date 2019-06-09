
<h2>{{$content_header}}</h2>
{!! Form::open(['url' => (isset($article->id)) ? route('admin.posts.update',['articles'=>$article->alias]) : route('admin.posts.store'),'method'=>'POST','enctype'=>'multipart/form-data']) !!}
    
	<ul class="list-unstyled">
		<li class="text-field pb-3">
			<span class="mb-1">Название статьи:</span>
			<div class="mb-1">
			{!! Form::text('title_en',isset($article->title_en) ? $article->title_en  : old('title_en'), ['class' => 'form-control','placeholder'=>'Введите название статьи на английском']) !!}
			 </div>
			 <div class="mb-1">
			{!! Form::text('title_uz',isset($article->title_uz) ? $article->title_uz  : old('title_uz'), ['class' => 'form-control','placeholder'=>'Введите название статьи на узбекском']) !!}
			 </div>
			 <div class="mb-1">
			{!! Form::text('title_ru',isset($article->title_ru) ? $article->title_ru  : old('title_ru'), ['class' => 'form-control','placeholder'=>'Введите название статьи на русском']) !!}
			 </div>
		 </li>
		 
		<li class="text-field pb-3">
			<span class="mb-1">Псевдоним статьи:</span>
			<div class="mb-1">
			{!! Form::text('alias', isset($article->alias) ? $article->alias  : old('alias'), ['class' => 'form-control','placeholder'=>'Введите псевдоним статьи']) !!}
			 </div>
		 </li>
		 
		<li class="pb-3">
			<span class="mb-1">Текст статьи на английском:</span>
			<div class="mb-1">
			{!! Form::textarea('text_en', isset($article->text_en) ? $article->text_en  : old('text_en'), ['id'=>'editor','class' => 'form-control','placeholder'=>'Введите текст статьи на английском']) !!}
			</div>
			<div class="msg-error"></div>
		</li>

		<li class="pb-3">
			<span class="mb-1">Текст статьи на узбекском:</span>
			<div class="mb-1">
			{!! Form::textarea('text_uz', isset($article->text_uz) ? $article->text_uz  : old('text_uz'), ['id'=>'editor2','class' => 'form-control','placeholder'=>'Введите текст статьи на узбекском']) !!}
			</div>
			<div class="msg-error"></div>
		</li>

		<li class="pb-3">
			<span class="mb-1">Текст статьи на русском:</span>
			<div class="mb-1">
			{!! Form::textarea('text_ru', isset($article->text_ru) ? $article->text_ru  : old('text_ru'), ['id'=>'editor3','class' => 'form-control','placeholder'=>'Введите текст статьи на русском']) !!}
			</div>
			<div class="msg-error"></div>
		</li>
		
		@if(isset($article->img))
			<li class="textarea-field pb-3">
				
				<label>
					 <span class="label">Изображение для статьи:</span>
				</label>
				<br />
				{{ Html::image(asset(env('THEME')).'/images/articles/'.$article->img,'',['style'=>'width:400px']) }}
				{!! Form::hidden('old_image',$article->img) !!}
			
				</li>
		
		@else
		
		<li class="text-field pb-3">
			<label for="name-contact-us">
				<span class="label">Изображение для статьи:</span>
			</label>
			<br />
			<div class="input-prepend">
				{!! Form::file('image', ['class' => 'filestyle','data-buttonText'=>'Выберите изображение','data-buttonName'=>"btn-primary",'data-placeholder'=>"Файла нет"]) !!}
			 </div>
			 
		</li>
		@endif
		
		
		@if(isset($article->id))
			<input type="hidden" name="_method" value="PUT">		
		
		@endif

		<li class="submit-button"> 
			{!! Form::button('Сохранить', ['class' => 'btn btn-success','type'=>'submit']) !!}			
		</li>
		 
	</ul>
	
{!! Form::close() !!}
<script src="{{asset('vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>

 <script>
     CKEDITOR.replace( 'editor');      
     CKEDITOR.replace( 'editor2');      
     CKEDITOR.replace( 'editor3');      
</script>
