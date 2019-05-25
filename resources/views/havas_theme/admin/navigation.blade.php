@if($menu)
<nav class="col-md-2 d-none d-md-block bg-light sidebar">
    <div class="sidebar-sticky ml-3">
{!! $menu->asUl(['class'=>'nav flex-column']) !!}
    </div>
</nav>
@endif
