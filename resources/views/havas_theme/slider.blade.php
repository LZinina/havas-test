@if (count($sliders)>0) 

<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    @foreach($sliders as $slider)

    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
      <img src="{{asset(env('THEME'))}}/images/about/{{$slider->img->max}} " class="d-block w-100 pic" alt="{{$slider->title}}">
      <div class="carousel-caption d-none d-md-block">
        <h5>{{$slider->title}}</h5>
      </div>
    </div>
    
    @endforeach
    
  </div>
</div>

@endif
