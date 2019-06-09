<!doctype html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{(isset($meta_desc)) ? $meta_desc : ''}}">
    <meta name="keywords" content="{{(isset($meta_desc)) ? $keywords : ''}}">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title_head }}</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset(env('THEME'))}}/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="{{asset(env('THEME'))}}/css/prettyPhoto.css" rel="stylesheet">
    <link href="{{asset(env('THEME'))}}/css/album.css" rel="stylesheet">
    



    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .bg-bl {background-color:black;}
      
      .bg-grad {background: radial-gradient(at bottom, gray, black)}
      .carousel-caption {
              left: 0%;
              width: 100%;
              bottom:0%;
              text-align: left;
              background-color: black;
              opacity: .5;
              padding:5px;
          }
      .bg-com {background-color:#C0C0C0}
      h6 {text-transform: uppercase;}
      .wrap_result {
        background-color: #f0f2f0;
        border: 2px solid #2C8DB8;
        border-radius: 10px;
        padding: 20px;
        position: fixed;
        left: 35%;
        top:40%;
        width:300px;
        /*height: 80px;*/
        text-align: center;
        display: none;
        z-index: 5005;
      }
      .borGreen {
        border: 2px solid green !important;
      }
      .commentlist .new_comment{
        background-color: #DFF3EF;
        list-style-type: none; 
      }


    </style>
    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="blog.css" rel="stylesheet">
    <link href="{{asset(env('THEME'))}}/css/audio-player.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    
</head>

  <body class="bg-bl">
  <div class="container">
  <header class="blog-header py-3 bg-grad">
    @include('locales.locale')
    @yield('navigation')
    <img src="{{asset(env('THEME'))}}/images/banner.jpg" class="img-fluid rounded" width="100%"/>
  </header>

  <main role="main" class="container bg-white rounded">
  <div class="row">
    <div class="col-md-8 blog-main px-3">
      
      <h3 class="font-italic border-bottom bg-light p-3 my-3">
        {{ $content_head }}
      </h3>
      @yield('slider')
      <div class="wrap_result"></div>
      @yield('content')
  </div><!-- /.blog-main -->
  <aside class="col-md-4 blog-sidebar">
      @yield('indexBar')
  </aside>
  </div><!-- /.row -->

</main><!-- /.container -->

@yield('footer')

<script
        src="https://code.jquery.com/jquery-3.4.0.min.js"
        integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg="
        crossorigin="anonymous">
</script>
<script >window.jQuery || document.write('<script src="{{asset(env('THEME'))}}/js/vendor/jquery-slim.min.js"><\/script>')
</script>
<script src="{{asset(env('THEME'))}}/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous">
</script>
<script src="{{ asset(env('THEME'))}}/js/app.js) }}"></script>
<script src="{{asset(env('THEME'))}}/js/comment-reply.js"></script>
<script src="{{asset(env('THEME'))}}/js/myscripts.js" ></script>

<script src="{{asset(env('THEME'))}}/js/photojs/popper.min.js"></script>
<script src="{{asset(env('THEME'))}}/js/photojs/mauGallery.min.js"></script>
<script src="{{asset(env('THEME'))}}/js/photojs/scripts.js"></script>


</div>
</body>
</html>