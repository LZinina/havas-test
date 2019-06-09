<h2>{{$content_header}}</h2>

{!! Form::open(['url' => (isset($user->id)) ? route('admin.users.update',['users'=>$user->id]) :route('admin.users.store'),'class'=>'contact-form','method'=>'POST','enctype'=>'multipart/form-data']) !!}

	<ul class="list-unstyled row">
		<div class="form-group col-md-6">
		<li class="pb-3">
			<label>
				<span class="label">Имя:</span>
				<br />
			</label>
			<div>
			{!! Form::text('name',isset($user->name) ? $user->name  : old('name'), ['class'=>'form-control']) !!}
			 </div>
		 </li>
		 
		 
		 
		<li class="pb-3">
			<label>
				<span class="label">Роль:</span>
				<br />
			</label>
			<div>
			{!! Form::select('role_id', $roles, (isset($user)) ? $user->roles()->first()->id : null, ['class'=>'form-control']) !!}
			 </div>
		</li>	
		</div>

		 <div class="form-group col-md-6">
		 <li class="pb-3">
			<label>
				<span class="label">Email:</span>
				<br />
			</label>
			<div>
			{!! Form::text('email',isset($user->email) ? $user->email  : old('email'), ['class'=>'form-control']) !!}
			 </div>
		 </li>
		 <li class="pb-3">
			<label>
				<span class="label">Пароль:</span>
				<br />
			</label>
			<div>
			{!! Form::password('password') !!}
			 </div>
		 </li>
		 
		 <li class="pb-3">
			<label>
				<span class="label">Повтор пароля:</span>
				<br />
			</label>
			<div>
			{!! Form::password('password_confirmation') !!}
			 </div>
		 </li>
		 
		 
		</div> 
			
		@if(isset($user->id))
			<input type="hidden" name="_method" value="PUT">		
		
		@endif

		<li class="submit-button"> 
			{!! Form::button('Сохранить', ['class' => 'btn btn-success','type'=>'submit']) !!}	
		</li>
		 
	</ul>

{!! Form::close() !!}