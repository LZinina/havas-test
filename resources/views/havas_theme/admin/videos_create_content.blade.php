<h2>{{$content_header}}</h2>
{!! Form::open(['url' => (isset($videos->id)) ? route('admin.videos.update',['videos'=>$video->id]) : route('admin.videos.store'),'method'=>'POST','enctype'=>'multipart/form-data']) !!}
    
	<ul class="list-unstyled">
		<li class="pb-3">
			<span class="label">Название видео:</span>
			<br />
			<div>
			{!! Form::text('name',isset($video->name) ? $video->name  : old('name'), ['class' => 'form-control']) !!}
			 </div>
		 </li>
		 <li class="pb-3">
			<span class="label">Адрес видео на YouTube:</span>
			<br />
			<div>
			{!! Form::text('filename',isset($video->filename) ? $video->filename  : old('filename'), ['class' => 'form-control']) !!}
			 </div>
		 </li>
		@if(isset($video->id))
			<input type="hidden" name="_method" value="PUT">		
		
		@endif

		<li class="submit-button"> 
			{!! Form::button('Сохранить', ['class' => 'btn btn-success','type'=>'submit']) !!}			
		</li>
		 
	</ul>
	
{!! Form::close() !!}