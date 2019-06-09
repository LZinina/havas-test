
<h2>{{$content_header}}</h2>
{!! Form::open(['url' => (isset($photo->id)) ? route('admin.photos.update',['photos'=>$photo->id]) : route('admin.photos.store'),'method'=>'POST','enctype'=>'multipart/form-data']) !!}
    
	<ul class="list-unstyled">
		<li class="pb-3">
			<span class="label">Название фото:</span>
			<br />
			<div>
			{!! Form::text('title',isset($photo->title) ? $photo->title  : old('title'), ['class' => 'form-control']) !!}
			 </div>
		 </li>
		 
		<li class="pb-3">
			<span class="label">Альбом:</span>
			<br />
			<div>
				{!! Form::select('album_id', $albums, (isset($photo)) ? $photo->albums()->first()->id : null, ['class'=>'form-control']) !!}

			</div>
		</li>
		 
		@if(isset($photo->image))
			<li class="pb-3">
				<span class="label">Фото:</span>
				<br />
				{{ Html::image(asset(env('THEME')).'/images/photos/'.$photo->image,'',['style'=>'width:50%']) }}
				{!! Form::hidden('old_image',$photo->image) !!}
			
				</li>
		
		@else
		
		<li class="pb-3">
			<span class="label">Фото:</span>
			<br />
			<div class="">
				{!! Form::file('image', ['class' => 'filestyle','data-buttonText'=>'Выберите изображение','data-buttonName'=>"btn-primary",'data-placeholder'=>"Файла нет"]) !!}
			</div>
			 
		</li>
		@endif
		
		
		@if(isset($photo->id))
			<input type="hidden" name="_method" value="PUT">		
		
		@endif

		<li class="submit-button"> 
			{!! Form::button('Сохранить', ['class' => 'btn btn-success','type'=>'submit']) !!}			
		</li>
		 
	</ul>
	
{!! Form::close() !!}

