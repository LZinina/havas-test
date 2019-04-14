<aside class="col-md-4 blog-sidebar">
  
  @if ($photos)
      <h3 class=" font-italic border-bottom bg-light p-3 mt-3">
        Новое фото
      </h3>
      
        <div class="row justify-content-center p-3">
          @foreach($photos as $photo)
            <div class="p-3">
              <a href="{{route('photos.show',['id'=>$photo->id])}}">
              <img src="{{asset(env('THEME'))}}/images/photos/{{$photo->image}}" width="100%">
              </a>

            </div>
          @endforeach
     
          <div class="p-3"><a href="{{route('photos.index')}}">Больше фото  <i class="fas fa-long-arrow-alt-right"></i></a></div>    
        </div>
  @endif
      

      
  <h3 class="font-italic border-bottom bg-light p-3 my-3">Наши страницы</h3>
  <div class="p-3">
  <ol class="list-unstyled">
      <li><a href="https://www.youtube.com/channel/UCjnUHmzR-uxMlBQGi_PxZUQ" target="_blank">YouTube</a></li>
      <li><a href="#">Twitter</a></li>
      <li><a href="#">Facebook</a></li>
  </ol>
  </div>

</aside><!-- /.blog-sidebar -->