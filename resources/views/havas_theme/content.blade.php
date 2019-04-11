@if ($articles && count($articles)>0)
<div class="card-deck py-3">
@foreach ($articles as $item)
  
    <div class="card">
      <img src="{{asset(env('THEME'))}}/images/{{$item->img->mini}}" class="card-img-top" alt="{{$item->title}}">
      <div class="card-body">
        <h5 class="card-title">{{$item->title}}</h5>
        <p class="blog-post-meta"></p>
        <p class="card-text">{{str_limit($item->text,100)}}</p>
        <a href="{{route('articles.show',['alias' => $item->alias])}}" >Читать дальше</a>
      </div>
      <div class="card-footer">
      <small class="text-muted">Создано: {{$item->created_at}}</small>
    </div>
    </div>
@endforeach
</div>
@else
<p>Новостей нет</p>

@endif
      

      

    