@if ($about && count($about)>0)

@foreach ($about as $item)
    <div class="card my-3">
      <img src="{{asset(env('THEME'))}}/images/about/{{$item->img}}" class="card-img-top" alt="{{$item->title_ru}}" width="100%">
      <div class="card-body">
        <div class="border-bottom">
            <h5 class="card-title"><a href="{{route('about.show',['alias' => $item->alias])}}" >{{$item->title}}</a></h5>
        </div>
        <p class="blog-post-meta"></p>
        <p class="card-text">{!!str_limit($item->text,100)!!}</p>
      </div>
    </div>
@endforeach

@else
<p>Статей нет</p>


@endif