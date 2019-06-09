<h2>{{$content_header}}</h2>
{!! Form::open(['url' => (isset($category->id)) ? route('admin.categories.update',['categories'=>$category->alias]) : route('admin.categories.store'),'method'=>'POST','enctype'=>'multipart/form-data']) !!}
    
	<ul class="list-unstyled">
		<li class="text-field pb-3">
			<span class="mb-1">Название категории:</span>
			<div class="mb-1">
			{!! Form::text('title_en',isset($category->title_en) ? $category->title_en  : old('title_en'), ['class' => 'form-control','placeholder'=>'Введите название категории на английском']) !!}
			 </div>
			 <div class="mb-1">
			{!! Form::text('title_uz',isset($category->title_uz) ? $category->title_uz  : old('title_uz'), ['class' => 'form-control','placeholder'=>'Введите название категории на узбекском']) !!}
			 </div>
			 <div class="mb-1">
			{!! Form::text('title_ru',isset($category->title_ru) ? $category->title_ru  : old('title_ru'), ['class' => 'form-control','placeholder'=>'Введите название категории на русском']) !!}
			 </div>
		 </li>
		
		<li>
		 <span class="mb-1">Псевдоним:</span>
		 <div class="mb-3">
			{!! Form::text('alias',isset($category->alias) ? $category->alias  : old('alias'), ['class' => 'form-control','placeholder'=>'']) !!}
			 </div>
		 </li>
		 
		@if(isset($category->id))
			<input type="hidden" name="_method" value="PUT">		
		
		@endif

		<li class="submit-button"> 
			{!! Form::button('Сохранить', ['class' => 'btn btn-success','type'=>'submit']) !!}			
		</li>
		 
	</ul>
	
{!! Form::close() !!}

