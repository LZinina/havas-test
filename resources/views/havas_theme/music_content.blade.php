<div class="m-0 p-0">
@if($categories)
<div class="row justify-content-between m-3">
    @foreach($categories as $category) 
      <h6><a href="{{url(Klisl\Locale\LocaleMiddleware::getLocale() .'/music/cat/'.$category->title_en)}}" >{{$category->title}}</a></h6>
    @endforeach
</div>
@else
<p></p>
@endif
@if ($musics && count($musics)>0)
  <div class="table-responsive p-0 m-0">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th></th>
              <th></th>
            </tr>
          </thead>
          <tbody>
  @foreach($musics as $music)
  <tr>
    <td>
      <a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">{{$music->title}}</a>
      <div class="embed-responsive embed-responsive-16by9 mb-5 collapse" id="collapseExample">
        {!!$music->path_itunes!!}
      </div>
    </td>
    <td>
      <ul class="list-unstyled">
      @foreach($links as $link)
      @if ($music->id == $link->musics->id)
        <li><a href="{{$link->link}}">{{$link->res_names->title}}</a></li>
      @endif
      @endforeach
    </ul>
    </td>
  </tr>
  @endforeach
</tbody>
</table>
</div>

  <nav aria-label="Page navigation example">
    @if ($musics->lastPage()>1)
      <ul class="pagination justify-content-center">
        @if($musics->currentPage()!==1)
          <li class="page-item ">
            <a href="{{$musics->url($musics->currentPage()-1)}}" class="page-link"><span aria-hidden="true">&laquo;</span></a>
          </li>
        @endif
        @for($i=1;$i<=$musics->lastPage();$i++)
          @if($musics->currentPage()==$i)
            <li class="page-item active disabled"><a class="page-link" href="#">{{$i}}</a></li>
          @else
            <li class="page-item"><a class="page-link " href="{{$musics->url($i)}}">{{$i}}</a></li>
          @endif
        @endfor
        @if($musics->currentPage()!==$musics->lastPage())
          <li class="page-item ">
          <a href="{{$musics->url($musics->currentPage()+1)}}" class="page-link"><span aria-hidden="true">&raquo;</span></a>
          </li>
        @endif
      </ul>
    @endif
  </nav>
@else
<p>{{__('message.text_no_news')}}</p>
@endif

</div>