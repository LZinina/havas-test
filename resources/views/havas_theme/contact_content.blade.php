<div class="blog-post my-3">
@if (count($errors)>0)
	<div class="alert alert-danger" role="alert">
		@foreach ($errors->all() as $error)
			<p>{{$error}}</p>
		@endforeach
	</div>
@endif
@if(session('status'))
	<div class="alert alert-success" role="alert">{{session('status')}}</div>
@endif
<form action="{{route('contacts')}}" method="post">
	<div class="form-group">
	<div class="pb-1">	
    	<input type="name" class="form-control" id="name" placeholder="Имя" name="name">
    </div>
    <div class="pb-1">
    	<input type="email" class="form-control" id="email" placeholder="E-mail" name="email">
    </div>
    <div class="pb-1">
    <textarea class="form-control" id="text" rows="3" placeholder="Сообщение" name="text"></textarea>
    </div>
    {{csrf_field()}}
    <button type="submit" class="btn btn-primary mb-2">ОТПРАВИТЬ</button>
  </div>

</form>
</div>