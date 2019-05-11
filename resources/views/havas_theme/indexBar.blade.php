@if ($bar=='right')
  @if ($photos)
      <h3 class=" font-italic border-bottom bg-light p-3 my-3">
        Новое фото
      </h3>
      
        <div class="row justify-content-center px-3">
          @foreach($photos as $photo)
            <div class="pb-3">
              <a href="{{route('photos.show',['id'=>$photo->id])}}">
              <img src="{{asset(env('THEME'))}}/images/photos/{{$photo->image}}" width="100%">
              </a>
            </div>
          @endforeach
     
          <a href="{{route('photos.index')}}">Больше фото  <i class="fas fa-long-arrow-alt-right"></i></a>    
        </div>
  @endif
  @endif     

  @if ($bar=='left')
      
  @endif
  <div class="my-3">
    <h3 class="font-italic border-bottom bg-light p-3 ">Наши страницы</h3>
    <ol class="list-unstyled">
      <li class="border-bottom"><a href="https://www.youtube.com/channel/UCjnUHmzR-uxMlBQGi_PxZUQ" target="_blank">YouTube</a></li>
      <li class="border-bottom"><a href="#">Twitter</a></li>
      <li class="border-bottom"><a href="#">Facebook</a></li>
    </ol>
  </div>
  <div class="my-3">
    <h3 class="font-italic border-bottom bg-light p-3 ">Наш адрес</h3>
    <div class="font-italic border bg-light p-3 ">
      <div class="border-bottom">Ташкент, массив Чилонзор</div>
      <div><i class="fas fa-phone-square fa-flip-horizontal"></i> +998 90 188 30 71</div>
    </div>
  </div>

  @if (Route::has('login'))
    <div class="my-3">
      <h3 class="font-italic border-bottom bg-light p-3 ">Вход на сайт</h3>
      <div class="font-italic border bg-light p-3 ">
      @auth
        <div><a href="{{ url('/') }}">На главную</a></div>
       @else
         <div><a href="{{ route('login') }}">Login</a></div>
       @if (Route::has('register'))
         <div><a href="{{ route('register') }}">Register</a></div>
       @endif
      @endauth
      </div>
    </div>
  @endif
  

