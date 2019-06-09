
<div class="gallery" style="display:none;">
  @if ($photos)
  <!--<div class="card-deck">-->
  @foreach ($photos as $photo)
    <!--<div class="card" >-->
      <img data-gallery-tag="{{$photo->album->title}}" class="gallery-item img-thumbnail" src="{{asset(env('THEME'))}}/images/photos/{{$photo->image}}" />
      
  @endforeach
@else
<p></p>
@endif
</div>

  
