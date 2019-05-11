 @if ($musics)
  
  
    <div class="example">

        <div class="player">
            <div class="pl"></div>
            <div class="title"></div>
            <div class="artist"></div>
            <div class="cover"></div>
            <div class="controls">
                <div class="play"></div>
                <div class="pause"></div>
                <div class="rew"></div>
                <div class="fwd"></div>
            </div>
            <div class="volume"></div>
            <div class="tracker"></div>
        </div>
        
        <ul class="playlist hidden">
        @foreach ($musics as $music)
            <li audiourl="{{asset(env('THEME'))}}/music/{{$music->filename}}" cover="" artist="{{$music->length}}">{{$music->name}}</li>
        @endforeach
        </ul>
    </div>
     

@endif
