@if($about)
<div class="blog-post my-3">
        <img src="{{asset(env('THEME'))}}/images/about/{{$about->img}}" width="100%">
              
        <hr>
        <p>{!!$about->text!!}</p>
</div><!-- /.blog-post -->
@endif