@if($menu)
<div class="nav-scroller m-0 p-0">
    <nav class="navbar  navbar-expand-lg navbar-dark px-0">
    	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    	<span class="navbar-toggler-icon"></span>
 		</button>
		<div class="collapse navbar-collapse my-0 py-0" id="navbarTogglerDemo02">
		<div class="container-fluid d-flex  justify-content-between m-0 p-0 ">	
			@include(env('THEME').'.CustomMenuItems',['items'=>$menu->roots()])
			
     	</div>
     	</div>
    </nav>
</div>

@endif

