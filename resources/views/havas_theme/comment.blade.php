@foreach ($items as $item)
<li id="li-comment-{{$item->id}}" class="comment my-3">
<div id="comment-{{$item->id}}" class="card ">
  <div class="card-body row">
    
    <div class="px-3 border-right">
    	@php
        	$hash = isset($item->email) ? bcrypt($item->email) : bcrypt($item->user->email);
      @endphp 
    	<img src="https://www.gravatar.com/avatar/{{$hash}} ? d=mm&s=75" height="75" width="75">
    	<p>{{$item->name}}</p>
    </div>

    <div class="px-3 col comment-meta commentmetadata">
     <div class=" px-3  commentDate row justify-content-between">
      <p class="text-black-50">{{$item->created_at->format('F d, Y')}}</p>
      <div class="commentNumber"><span># </span></div>  
     </div>
     <p>{{$item->text}}</p>

  	 <div class="reply group">
        	<a class="comment-reply-link" href="#respond" onclick="return addComment.moveForm(&quot;comment-{{$item->id}}&quot;, &quot;{{$item->id}}&quot;, &quot;respond&quot;, &quot;{{$item->article_id}}&quot;)">Ответить</a>
     </div>
	  </div>
   
    
  </div>
</div>
@if(isset($com[$item->id]))
     <ul class="children list-unstyled ml-5 mt-3" >
        @include(env('THEME').'.comment', ['items' => $com[$item->id]])
     </ul>
 @endif
</li>
@endforeach