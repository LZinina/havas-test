
<h2>{{$content_header}}</h2>
{!! Form::open(['url' => (isset($album->id)) ? route('admin.albums.update',['albums'=>$album->id]) : route('admin.albums.store'),'method'=>'POST','enctype'=>'multipart/form-data']) !!}
    
	<ul class="list-unstyled">
		<li class="pb-3">
			<span class="label">Название альбома:</span>
			<br />
			<div>
			{!! Form::text('title',isset($album->title) ? $album->title  : old('title'), ['class' => 'form-control']) !!}
			 </div>
		 </li>
		 
		@if(isset($album->id))
			<input type="hidden" name="_method" value="PUT">		
		
		@endif

		<li class="submit-button"> 
			{!! Form::button('Сохранить', ['class' => 'btn btn-success','type'=>'submit']) !!}			
		</li>
		 
	</ul>
	
{!! Form::close() !!}

