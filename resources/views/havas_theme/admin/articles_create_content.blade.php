
<h2>{{$content_header}}</h2>
{!! Form::open(['url' => (isset($article->id)) ? route('admin.posts.update',['articles'=>$article->alias]) : route('admin.posts.store'),'method'=>'POST','enctype'=>'multipart/form-data']) !!}
    
	<ul class="list-unstyled">
		<li class="text-field pb-3">
			<label for="name-contact-us">
				<span class="label">Название статьи:</span>
				<br />
			</label>
			<div class="input-prepend">
			{!! Form::text('title',isset($article->title) ? $article->title  : old('title'), ['class' => 'form-control','placeholder'=>'Введите название статьи']) !!}
			 </div>
		 </li>
		 
		<li class="text-field pb-3">
			<label for="name-contact-us">
				<span class="label">Псевдоним статьи:</span>
				<br />
				
			</label>
			<div class="input-prepend">
			{!! Form::text('alias', isset($article->alias) ? $article->alias  : old('alias'), ['class' => 'form-control','placeholder'=>'Введите псевдоним статьи']) !!}
			 </div>
		 </li>
		 
		 <li class="textarea-field pb-3">
			<label for="message-contact-us">
				 <span class="label">Краткое описание статьи:</span>
			</label>
			<div class="input-prepend">
			{!! Form::textarea('desc', isset($article->desc) ? $article->desc  : old('desc'), ['id'=>'editor','class' => 'form-control','placeholder'=>'Введите кракое описание статьи']) !!}
			</div>
			<div class="msg-error"></div>
		</li>
		
		<li class="textarea-field pb-3">
			<label for="message-contact-us">
				 <span class="label">Текст статьи:</span>
			</label>
			<div class="input-prepend">
			{!! Form::textarea('text', isset($article->text) ? $article->text  : old('text'), ['id'=>'editor2','class' => 'form-control','placeholder'=>'Введите текст статьи']) !!}
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
     CKEDITOR.replace( 'editor' );
     CKEDITOR.replace( 'editor2' );
</script>
