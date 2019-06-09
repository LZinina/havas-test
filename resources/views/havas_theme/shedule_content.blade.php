@if ($shedules)
@foreach ($shedules as $item)
<div class="card border-info mb-3">
  <div class="card-header text-center text-uppercase">
    <h3>{!!$item->title!!}</h3>
  </div>
  <div class="card-body">
    <h5 class="card-subtitle mb-2 text-muted">{{__('message.text_con_addr')}}: {!!$item->address!!}</h5>
    <p class="card-text">{!!$item->text!!}</p>
    
  </div>
  <div class="card-footer text-center">
    <div class="row justify-content-between">
      <div>
        <span class="text-info">{{__('message.text_con_date')}}:</span>
        {!!$item->data!!} / 
        {!!$item->time!!}
      </div>
      <div>
        <span class="text-info">{{__('message.text_con_price')}}:</span>
        {!!$item->price!!}
      </div>
    </div>
  </div>
</div>
@endforeach
@endif