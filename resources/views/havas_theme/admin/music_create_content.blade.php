<h2>{{$content_header}}</h2>
{!! Form::open(['url' => (isset($music->id)) ? route('admin.musics.update',['musics'=>$music->alias]) : route('admin.musics.store'),'method'=>'POST','enctype'=>'multipart/form-data']) !!}
    
	<ul class="list-unstyled">
		<li class="text-field pb-3">
			<span class="mb-1">Название трека:</span>
			<div class="mb-1">
			{!! Form::text('title',isset($music->title) ? $music->title  : old('title'), ['class' => 'form-control','placeholder'=>'Введите название трека']) !!}
			 </div>
		</li>

		<li>
		 <span class="mb-1">Псевдоним:</span>
		 <div class="mb-3">
			{!! Form::text('alias',isset($music->alias) ? $music->alias  : old('alias'), ['class' => 'form-control','placeholder'=>'']) !!}
			 </div>
		</li>

		<li>
		 <span class="mb-1">Ссылка на iTunes:</span>
		 <div class="mb-3">

			{!! Form::textarea('path_itunes',isset($music->path_itunes) ? $music->path_itunes  : old('path_itunes'), ['class' => 'form-control','placeholder'=>'']) !!}
			 </div>
		 </li>

		<li class="pb-3">
			<span class="label">Категория:</span>
			<br />
			<div>
				{!! Form::select('category_id', $categories, (isset($music)) ? $music->categories()->first()->id : null, ['class'=>'form-control']) !!}

			</div>
		</li>
		 
		@if(isset($music->id))
			<input type="hidden" name="_method" value="PUT">		
		
		@endif

		<li class="submit-button"> 
			{!! Form::button('Сохранить', ['class' => 'btn btn-success','type'=>'submit']) !!}			
		</li>
		 
	</ul>
	
{!! Form::close() !!}

