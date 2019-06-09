
<h2>{{$content_header}}</h2>
{!! Form::open(['url' => (isset($link->id)) ? route('admin.links.update',['links'=>$link->id]) : route('admin.links.store'),'method'=>'POST','enctype'=>'multipart/form-data']) !!}
    <ul class="list-unstyled">
		<li class="pb-3">
			<span class="label">Название музыкального альбома:</span>
			<br />
			<div>
				{!! Form::select('music_id', $musics, (isset($link)) ? $link->musics()->first()->id : null, ['class'=>'form-control']) !!}

			</div>
		</li>
		
		<li class="pb-3">
			<span class="label">Название ресурса:</span>
			<br />
			<div>
				{!! Form::select('res_name_id', $res_names, (isset($link)) ? $link->res_names()->first()->id : null, ['class'=>'form-control']) !!}

			</div>
		</li>
				
		<li class="pb-3">
			<span class="label">Ссылка:</span>
			<br />
			<div>
			{!! Form::text('link',isset($link->link) ? $link->link  : old('link'), ['class' => 'form-control']) !!}
			 </div>
		 </li>
		
		@if(isset($link->id))
			<input type="hidden" name="_method" value="PUT">		
		
		@endif

		<li class="submit-button"> 
			{!! Form::button('Сохранить', ['class' => 'btn btn-success','type'=>'submit']) !!}			
		</li>
		 
	</ul>
	
{!! Form::close() !!}

