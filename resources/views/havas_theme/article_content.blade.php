
@if($article)
<div class="blog-post my-3">
        
        <img src="{{asset(env('THEME'))}}/images/articles/{{$article->img}}" width="100%">
        <div class=" px-3 row justify-content-between">
            <p class="blog-post-meta">{{$article->created_at->format('F d, Y')}} {{__('message.text_by')}} <a href="#">{{$article->user->name}}</a></p>
            <a href="#comments" ><i class="far fa-comment-dots"></i> {{count($article->comments) ? count($article->comments) : '0'}} {{__('message.text_comments')}}</a>
        </div>
        
        <hr>
        <p>{!!$article->text_ru!!}</p>
</div><!-- /.blog-post -->

<div id="comments" class="">
      <h4 class="blog-post-title">{{count($article->comments)}} {{__('message.text_comments')}}</h4>
</div>
      @if (count($article->comments) > 0)
      @php
        $com = $article->comments->groupBy('parent_id');
      @endphp 

      <ol class="list-unstyled commentlist group">
        @foreach($com as $k=>$comments)
          @if($k !== 0)
            @break
          @endif
          @include(env('THEME').'.comment',['items' => $comments])
        @endforeach
      </ol>
      @endif

<div id="respond" class="border p-3 rounded bg-light">
    <h5 id="reply-title">{{__('message.text_add_comment')}}</h5>
    <a rel="nofollow" id="cancel-comment-reply-link" href="#respond" style="display:none;">{{__('message.text_cancel_answer')}}</a>
    <form action="{{route('comment.store')}}" method="post" id="commentform" class="form-group">
      @if(!Auth::check())
      <div class="row justify-content-between px-3">
      <div class="comment-form-author">
        <div><label for="name">{{__('message.text_name')}}</label></div> 
        <div><input id="name" name="name" type="text" value=""  aria-required="true" /></div>
      </div>
      <div class="comment-form-email">
        <div><label for="email">Email</label></div> 
        <div><input id="email" name="email" type="text" value=""  aria-required="true" /></div>
      </div>
      <div class="comment-form-site">
        <div><label for="site">{{__('message.text_site')}}</label></div> 
        <div><input id="site" name="site" type="text" value=""  aria-required="true" /></div>
      </div>
      </div>
      @endif
      
      <div class="comment-form-comment">
        <div><label for="comment">{{__('message.text_your_comment')}}</label></div>
        <div><textarea id="comment" name="text" class="form-control"></textarea></div>
      </div>

      {{ csrf_field()}}

      <p class="form-submit">
        <input type="hidden" id="comment_post_ID" name="comment_post_ID" value="{{$article->id}}" />
        <input type="hidden" id="comment_parent" name="comment_parent" value="0" />
        <input name="submit"  type="submit" class="mt-2" id="submit" value="{{__('message.text_send')}}" />
      </p>
    
    </form>

</div>
@endif
