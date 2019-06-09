<h2>Привилегии</h2>
	
	<form action="{{ route('admin.permissions.store') }}" method="POST">
		{{ csrf_field() }}
		
		<div class="table-responsive">
		
			<table class="table table-striped table-sm">
          		
          		<thead>
					
					<th>Привилегии</th>
					@if(!$roles->isEmpty())
					
						@foreach($roles as $item)
							<th>{{ $item->name}}</th>
						@endforeach
					
					@endif
					
				</thead>
				<tbody>
					
					@if(!$priv->isEmpty())
					
						@foreach($priv as $val)
							<tr>
								
								<td>{{ $val->name }}</td>
									@foreach($roles as $role)
										<td>
											@if($role->hasPermission($val->name))
												<input checked name="{{ $role->id }}[]"  type="checkbox" value="{{ $val->id }}">
											@else
												<input name="{{ $role->id }}[]"  type="checkbox" value="{{ $val->id }}">
											@endif	
										</td>
									@endforeach
							</tr>
						@endforeach
					
					@endif

				</tbody>
				
				
			</table>
			
			
		</div>
		
		<input class="btn btn-primary" type="submit" value="Обновить" />

		
	</form>