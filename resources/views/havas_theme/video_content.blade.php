@if ($videos)
@foreach($videos as $video)
<h3>{{$video->name}}</h3>
<div class="embed-responsive embed-responsive-16by9 mb-5">
{!!$video->filename!!}
</div>
@endforeach
@else
<p></p>
@endif

