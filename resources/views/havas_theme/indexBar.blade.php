@if ($bar=='right')
  @if ($photos)
      <h3 class=" font-italic border-bottom bg-light p-3 my-3">
        {{__('message.text_new_photo')}}
      </h3>
      
        <div class="row justify-content-center px-3">
          @foreach($photos as $photo)
            <div class="pb-3">
              <a href="{{route('photos.show',['id'=>$photo->id])}}">
              <img src="{{asset(env('THEME'))}}/images/photos/{{$photo->image}}" width="100%">
              </a>
            </div>
          @endforeach
     
          <a href="{{route('photos.index')}}">{{__('message.text_photo_more')}}  <i class="fas fa-long-arrow-alt-right"></i></a>    
        </div>
  @endif
  @endif     

  @if ($bar=='left')
      
  @endif
  <div class="my-3">
    <h3 class="font-italic border-bottom bg-light p-3 ">{{__('message.text_our_pages')}}</h3>
    <ol class="list-unstyled">
      <li class="border-bottom"><a href="https://www.youtube.com/channel/UCjnUHmzR-uxMlBQGi_PxZUQ" target="_blank">YouTube</a></li>
      <li class="border-bottom"><a href="https://www.facebook.com/HAVAS-guruhi-142516083059709/">Facebook</a></li>
      <li class="border-bottom"><a href="https://www.instagram.com/havas_guruhi_official/">Instagram</a></li>
    </ol>
  </div>
  <div class="my-3">
    <h3 class="font-italic border-bottom bg-light p-3 ">{{__('message.text_our_address')}}</h3>
    <div class="font-italic border bg-light p-3 ">
      <div class="border-bottom">{{__('message.text_tashkent')}}</div>
      <div><i class="fas fa-phone-square fa-flip-horizontal"></i> +998 90 188 30 71</div>
    </div>
  </div>
 <!--
  <div class="my-3">
      <h3 class="font-italic border-bottom bg-light p-3 ">{{__('message.text_log_on_to_site')}}</h3>
      <div class="font-italic border bg-light p-3 ">
     
      <ul class="navbar-nav ml-auto">
      @guest
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}">{{__('message.text_login')}}</a>
        </li>
      @if (Route::has('register'))
          <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">{{__('message.text_register')}}</a>
          </li>
      @endif
      @else
          <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>{{ Auth::user()->name }} <span class="caret"></span></a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" >
              @csrf
              </form>
            </div>
          </li>
      @endguest
        </ul>
      
      </div>
    </div>
  -->

