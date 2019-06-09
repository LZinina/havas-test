<h2>{{$content_header}}</h2>
{!! Form::open(['url' => (isset($requisite->id)) ? route('admin.requisites.update',['requisites'=>$requisite->id]) : route('admin.requisites.store'),'method'=>'POST','enctype'=>'multipart/form-data']) !!}
    
	<ul class="list-unstyled">
		<li class="pb-3">
			<span class="label">Реквизиты на английском:</span>
			<br />
			<div>
			{!! Form::textarea('text_en',isset($requisite->text_en) ? $requisite->text_en  : old('text_en'), ['id'=>'editor','class' => 'form-control']) !!}
			 </div>
		 </li>
		<li class="pb-3">
			<span class="label">Реквизиты на узбекском:</span>
			<br />
			<div>
			{!! Form::textarea('text_uz',isset($requisite->text_uz) ? $requisite->text_uz  : old('text_uz'), ['id'=>'editor2','class' => 'form-control']) !!}
			 </div>
		 </li>
		 <li class="pb-3">
			<span class="label">Реквизиты на русском:</span>
			<br />
			<div>
			{!! Form::textarea('text_ru',isset($requisite->text_ru) ? $requisite->text_ru  : old('text_ru'), ['id'=>'editor3','class' => 'form-control']) !!}
			 </div>
		 </li> 
		@if(isset($requisite->id))
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