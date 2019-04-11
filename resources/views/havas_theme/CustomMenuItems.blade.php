@foreach($items as $item)
	<a class="p-2 text-muted" href="{{$item->url()}}"><h6>{{$item->title}}</h6></a>
	@if($item->hasChildren())
		<ul class="sub-menu">
			@include(env('THEME').'.customMenuItems',['items'=>$item->children()])
		</ul>
	@endif
@endforeach
