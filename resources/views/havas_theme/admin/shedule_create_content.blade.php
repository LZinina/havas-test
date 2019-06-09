
<h2>{{$content_header}}</h2>
{!! Form::open(['url' => (isset($shedule->id)) ? route('admin.shedules.update',['shedules'=>$shedule->alias]) : route('admin.shedules.store'),'method'=>'POST','enctype'=>'multipart/form-data']) !!}
    
	<ul class="list-unstyled">

		<li class="text-field pb-3">
			<span class="mb-1">Название концерта:</span>
			<div class="mb-1">
			{!! Form::text('title_en',isset($shedule->title_en) ? $shedule->title_en  : old('title_en'), ['class' => 'form-control','placeholder'=>'Введите название статьи на английском']) !!}
			 </div>
			 <div class="mb-1">
			{!! Form::text('title_uz',isset($shedule->title_uz) ? $shedule->title_uz  : old('title_uz'), ['class' => 'form-control','placeholder'=>'Введите название статьи на узбекском']) !!}
			 </div>
			 <div class="mb-1">
			{!! Form::text('title_ru',isset($shedule->title_ru) ? $shedule->title_ru  : old('title_ru'), ['class' => 'form-control','placeholder'=>'Введите название статьи на русском']) !!}
			 </div>
		 </li>
		 <li class="text-field pb-3">
			<span class="mb-1">Псевдоним:</span>
			<div class="mb-1">
			{!! Form::text('alias', isset($shedule->alias) ? $shedule->alias  : old('alias'), ['class' => 'form-control','placeholder'=>'Введите псевдоним статьи']) !!}
			 </div>
		 </li>
		 <li class="text-field pb-3">
			<span class="mb-1">Дата концерта:</span>
			<div class="mb-1">
			{!! Form::text('data', isset($shedule->data) ? $shedule->data  : old('data'), ['class' => 'form-control','placeholder'=>'Введите дату концерта']) !!}
			 </div>
		 </li>
		 <li class="text-field pb-3">
			<span class="mb-1">Время начала концерта:</span>
			<div class="mb-1">
			{!! Form::text('time', isset($shedule->time) ? $shedule->time  : old('time'), ['class' => 'form-control','placeholder'=>'Введите время начала концерта']) !!}
			 </div>
		 </li>
		 <li class="text-field pb-3">
			<span class="mb-1">Цена билета:</span>
			<div class="mb-1">
			{!! Form::text('price_en',isset($shedule->price_en) ? $shedule->price_en  : old('price_en'), ['class' => 'form-control','placeholder'=>'Введите цену в долларах']) !!}
			 </div>
			 <div class="mb-1">
			{!! Form::text('price_uz',isset($shedule->price_uz) ? $shedule->price_uz  : old('price_uz'), ['class' => 'form-control','placeholder'=>'Введите цену в сумах']) !!}
			 </div>
			 <div class="mb-1">
			{!! Form::text('price_ru',isset($shedule->price_ru) ? $shedule->price_ru  : old('price_ru'), ['class' => 'form-control','placeholder'=>'Введите цену в рублях']) !!}
			 </div>
		 </li>

		 <li class="text-field pb-3">
			<span class="mb-1">Место проведения концерта:</span>
			<div class="mb-1">
			{!! Form::text('address_en',isset($shedule->address_en) ? $shedule->address_en  : old('address_en'), ['class' => 'form-control','placeholder'=>'Введите место проведения en']) !!}
			 </div>
			 <div class="mb-1">
			{!! Form::text('address_uz',isset($shedule->address_uz) ? $shedule->address_uz  : old('address_uz'), ['class' => 'form-control','placeholder'=>'Введите место проведения uz']) !!}
			 </div>
			 <div class="mb-1">
			{!! Form::text('address_ru',isset($shedule->address_ru) ? $shedule->address_ru  : old('address_ru'), ['class' => 'form-control','placeholder'=>'Введите место проведения ru']) !!}
			 </div>
		 </li>
				 
		<li class="pb-3">
			<span class="mb-1">Текст статьи на английском:</span>
			<div class="mb-1">
			{!! Form::textarea('text_en', isset($shedule->text_en) ? $shedule->text_en  : old('text_en'), ['id'=>'editor','class' => 'form-control','placeholder'=>'Введите текст статьи на английском']) !!}
			</div>
			<div class="msg-error"></div>
		</li>

		<li class="pb-3">
			<span class="mb-1">Текст статьи на узбекском:</span>
			<div class="mb-1">
			{!! Form::textarea('text_uz', isset($shedule->text_uz) ? $shedule->text_uz  : old('text_uz'), ['id'=>'editor2','class' => 'form-control','placeholder'=>'Введите текст статьи на узбекском']) !!}
			</div>
			<div class="msg-error"></div>
		</li>

		<li class="pb-3">
			<span class="mb-1">Текст статьи на русском:</span>
			<div class="mb-1">
			{!! Form::textarea('text_ru', isset($shedule->text_ru) ? $shedule->text_ru  : old('text_ru'), ['id'=>'editor3','class' => 'form-control','placeholder'=>'Введите текст статьи на русском']) !!}
			</div>
			<div class="msg-error"></div>
		</li>
		
		@if(isset($shedule->id))
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
