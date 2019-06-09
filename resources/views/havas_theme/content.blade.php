
@if ($articles && count($articles)>0)
<div class="card-deck py-3">
@foreach ($articles as $item)
    <div class="card">
      <img src="{{asset(env('THEME'))}}/images/articles/{{$item->img}}" class="card-img-top" alt="{{$item->title}}" width="100%">
      <div class="card-body ">
        <div class="border-bottom">
            <h5 class="card-title">{{$item->title}}</h5>
        </div>
        <p class="blog-post-meta"></p>
        <p class="card-text">{!!str_limit($item->text,100)!!}</p>
        
        <div class="row justify-content-between px-3">
        <a href="{{route('articles.show',['alias' => $item->alias])}}" >{{__('message.text_read_more')}}...</a>
        <a href="{{route('articles.show',['alias'=>$item->alias])}}" ><i class="far fa-comment-dots"></i> {{count($item->comments) ? count($item->comments) : '0'}} {{__('message.text_comments')}}</a>
        </div>
      </div>
      <div class="card-footer">
      <small class="text-muted">{{__('message.text_created')}}: {{$item->created_at->format('F d, Y')}} {{__('message.text_by')}} {{$item->user->name}}</small>
      </div>
    </div>
@endforeach
</div>
<nav aria-label="Page navigation example">
  @if ($articles->lastPage()>1)
  <ul class="pagination justify-content-center">
  @if($articles->currentPage()!==1)
    <li class="page-item ">
    <a href="{{$articles->url($articles->currentPage()-1)}}" class="page-link"><span aria-hidden="true">&laquo;</span></a>
    </li>
  @endif
  @for($i=1;$i<=$articles->lastPage();$i++)
  @if($articles->currentPage()==$i)
    <li class="page-item active disabled"><a class="page-link" href="#">{{$i}}</a></li>
  @else
    <li class="page-item"><a class="page-link " href="{{$articles->url($i)}}">{{$i}}</a></li>
  @endif
  @endfor
    @if($articles->currentPage()!==$articles->lastPage())
    <li class="page-item ">
    <a href="{{$articles->url($articles->currentPage()+1)}}" class="page-link"><span aria-hidden="true">&raquo;</span></a>
    </li>
    @endif
  </ul>
  @endif
</nav>
@else
<p>{{__('message.text_no_news')}}</p>


@endif
    

      

    