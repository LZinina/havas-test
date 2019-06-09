<h2>{{$content_header}}</h2>
{!! Form::open(['url' => (isset($slider->id)) ? route('admin.sliders.update',['sliders'=>$slider->alias]) : route('admin.sliders.store'),'method'=>'POST','enctype'=>'multipart/form-data']) !!}
    
	<ul class="list-unstyled">
		<li class="text-field pb-3">
			<span class="mb-1">Название слайда:</span>
			<div class="mb-1">
			{!! Form::text('title_en',isset($slider->title_en) ? $slider->title_en  : old('title_en'), ['class' => 'form-control','placeholder'=>'Введите название слайда на английском']) !!}
			 </div>
			 <div class="mb-1">
			{!! Form::text('title_uz',isset($slider->title_uz) ? $slider->title_uz  : old('title_uz'), ['class' => 'form-control','placeholder'=>'Введите название слайда на узбекском']) !!}
			 </div>
			 <div class="mb-1">
			{!! Form::text('title_ru',isset($slider->title_ru) ? $slider->title_ru  : old('title_ru'), ['class' => 'form-control','placeholder'=>'Введите название слайда на русском']) !!}
			 </div>
		 </li>
		
		 <li>
		 <span class="mb-1">Псевдоним:</span>
		 <div class="mb-3">
			{!! Form::text('alias',isset($slider->alias) ? $slider->alias  : old('alias'), ['class' => 'form-control','placeholder'=>'']) !!}
			 </div>
		 </li>
		 @if(isset($slider->img))
			<li class="textarea-field pb-3">
				
				<label>
					 <span class="label">Изображение для слайда:</span>
				</label>
				<br />
				{{ Html::image(asset(env('THEME')).'/images/about/'.$slider->img,'',['style'=>'width:400px']) }}
				{!! Form::hidden('old_image',$slider->img) !!}
			
				</li>
		
		@else
		
		<li class="text-field pb-3">
			<label for="name-contact-us">
				<span class="label">Изображение для слайда:</span>
			</label>
			<br />
			<div class="input-prepend">
				{!! Form::file('image', ['class' => 'filestyle','data-buttonText'=>'Выберите изображение','data-buttonName'=>"btn-primary",'data-placeholder'=>"Файла нет"]) !!}
			 </div>
			 
		</li>
		@endif
		@if(isset($slider->id))
			<input type="hidden" name="_method" value="PUT">		
		
		@endif

		<li class="submit-button"> 
			{!! Form::button('Сохранить', ['class' => 'btn btn-success','type'=>'submit']) !!}			
		</li>
		 
	</ul>
	
{!! Form::close() !!}

