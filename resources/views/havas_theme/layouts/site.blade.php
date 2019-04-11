<!doctype html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Пример на bootstrap 4: Блог - двухколоночный макет блога с пользовательской навигацией, заголовком и содержанием.">

    <title>test - HAVAS GURUHI</title>


    <!-- Bootstrap core CSS -->
<link href="{{asset(env('THEME'))}}/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


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
      .bg-wh {background-color:white;}
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

      h6 {text-transform: uppercase;}

    </style>
    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="blog.css" rel="stylesheet">

  </head>

  <body class="bg-bl">
  <div class="container">
  <header class="blog-header py-3 bg-grad">
    @yield('navigation')
    <img src="{{asset(env('THEME'))}}/images/banner.jpg" class="img-fluid rounded" />
  </header>

  <main role="main" class="container bg-wh rounded">
  <div class="row">
    <div class="col-md-8 blog-main">
      <h3 class="pb-3 mb-4 font-italic border-bottom bg-light p-3 my-3">
        Новости
      </h3>
      @yield('slider')
      @yield('content')
  </div><!-- /.blog-main -->
      @yield('indexBar')
  </div><!-- /.row -->

</main><!-- /.container -->

<footer class="blog-footer justify-content-between d-flex">
 
    <p class="text-white-50">Контактный номер: +998 90 188 30 71</p> 
    <a href="#" class="text-muted">Back to top</a>
 
</footer>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="{{asset(env('THEME'))}}/js/vendor/jquery-slim.min.js"><\/script>')</script><script src="{{asset(env('THEME'))}}/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>

</body>
</html>