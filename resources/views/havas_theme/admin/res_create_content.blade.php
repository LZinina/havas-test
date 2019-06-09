
<h2>{{$content_header}}</h2>
{!! Form::open(['url' => (isset($res_name->id)) ? route('admin.res_names.update',['res_names'=>$res_name->id]) : route('admin.res_names.store'),'method'=>'POST','enctype'=>'multipart/form-data']) !!}
    
	<ul class="list-unstyled">
		<li class="pb-3">
			<span class="label">Название ресурса:</span>
			<br />
			<div>
			{!! Form::text('title',isset($res_name->title) ? $res_name->title  : old('title'), ['class' => 'form-control']) !!}
			 </div>
		 </li>
				 
		@if(isset($res_name->id))
			<input type="hidden" name="_method" value="PUT">		
		
		@endif

		<li class="submit-button"> 
			{!! Form::button('Сохранить', ['class' => 'btn btn-success','type'=>'submit']) !!}			
		</li>
		 
	</ul>
	
{!! Form::close() !!}

