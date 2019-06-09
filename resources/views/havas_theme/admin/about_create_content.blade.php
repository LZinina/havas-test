<h2>{{$content_header}}</h2>
{!! Form::open(['url' => (isset($about->id)) ? route('admin.abouts.update',['abouts'=>$about->alias]) : route('admin.abouts.store'),'method'=>'POST','enctype'=>'multipart/form-data']) !!}
    
	<ul class="list-unstyled">
		<li class="text-field pb-3">
			<span class="mb-1">Название статьи:</span>
			<div class="mb-1">
			{!! Form::text('title_en',isset($about->title_en) ? $about->title_en  : old('title_en'), ['class' => 'form-control','placeholder'=>'Введите название статьи на английском']) !!}
			 </div>
			 <div class="mb-1">
			{!! Form::text('title_uz',isset($about->title_uz) ? $about->title_uz  : old('title_uz'), ['class' => 'form-control','placeholder'=>'Введите название статьи на узбекском']) !!}
			 </div>
			 <div class="mb-1">
			{!! Form::text('title_ru',isset($about->title_ru) ? $about->title_ru  : old('title_ru'), ['class' => 'form-control','placeholder'=>'Введите название статьи на русском']) !!}
			 </div>
		 </li>
		<li class="pb-3">
			<span class="label">Текст статьи на английском:</span>
			<br />
			<div>
			{!! Form::textarea('text_en',isset($about->text_en) ? $about->text_en  : old('text_en'), ['id'=>'editor','class' => 'form-control']) !!}
			 </div>
		 </li>
		<li class="pb-3">
			<span class="label">Текст статьи на узбекском:</span>
			<br />
			<div>
			{!! Form::textarea('text_uz',isset($about->text_uz) ? $about->text_uz  : old('text_uz'), ['id'=>'editor2','class' => 'form-control']) !!}
			 </div>
		 </li>
		 <li class="pb-3">
			<span class="label">Текст статьи на русском:</span>
			<br />
			<div>
			{!! Form::textarea('text_ru',isset($about->text_ru) ? $about->text_ru  : old('text_ru'), ['id'=>'editor3','class' => 'form-control']) !!}
			 </div>
		 </li> 
		 <li>
		 <span class="mb-1">Псевдоним:</span>
		 <div class="mb-3">
			{!! Form::text('alias',isset($about->alias) ? $about->alias  : old('alias'), ['class' => 'form-control','placeholder'=>'']) !!}
			 </div>
		 </li>
		 @if(isset($about->img))
			<li class="textarea-field pb-3">
				
				<label>
					 <span class="label">Изображение для статьи:</span>
				</label>
				<br />
				{{ Html::image(asset(env('THEME')).'/images/about/'.$about->img,'',['style'=>'width:400px']) }}
				{!! Form::hidden('old_image',$about->img) !!}
			
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
		@if(isset($about->id))
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