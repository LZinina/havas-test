@if($articles)
@foreach($articles as $article)

  <div class="blog-post p-3 my-3">
        <h3 class="blog-post-title">{{$article->title}}</h3>
        <img src="{{asset(env('THEME'))}}/images/articles/{{$article->img}}" width="100%">
        <div class=" px-3 row justify-content-between">
            <p class="blog-post-meta">{{$article->created_at->format('F d, Y')}} by <a href="#">{{$article->user->name}}</a></p>
            <a href="{{route('articles.show',['alias'=>$article->alias])}}" ><i class="far fa-comment-dots"></i> {{count($article->comments) ? count($article->comments) : '0'}} comments</a>
        </div>
        <p>{{$article->desc}}</p>
        <hr>
        <p>{{$article->text}}</p>
        <a href="{{route('articles.show',['alias'=>$article->alias])}}" >Читать далее <i class="fas fa-long-arrow-alt-right"></i></a>

      </div><!-- /.blog-post -->
@endforeach
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
<h2> Новостей нет</h2>
@endif