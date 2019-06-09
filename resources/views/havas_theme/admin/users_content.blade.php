<h2>Пользователи</h2>
<div class="table-responsive">
	<table class="table table-striped table-sm">
          		
	<thead>
		<th>ID</th>
		<th>Name</th>
		<th>Email</th>
		<th>Role</th>
		<th>Удалить</th>
	</thead>
	@if($users)
		
		
		@foreach($users as $user)
		<tr>
			<td>{{ $user->id }}</td>
			<td>{!! Html::link(route('admin.users.edit',['users' => $user->id]),$user->name) !!}</td>
			<td>{{ $user->email }}</td>
			<td>{{ $user->roles->implode('name', ', ') }}</td>
			<td>
			{!! Form::open(['url' => route('admin.users.destroy',['users'=> $user->id]),'class'=>'form-horizontal','method'=>'POST']) !!}
												    {{ method_field('DELETE') }}
												    {!! Form::button('Удалить', ['class' => 'btn btn-danger','type'=>'submit']) !!}
												{!! Form::close() !!}
			</td>
		</tr>										
		@endforeach
		
	@endif
	</table>
	</div>
	{!! Html::link(route('admin.users.create'),'Добавить  пользователя',['class' => 'btn btn-primary']) !!}