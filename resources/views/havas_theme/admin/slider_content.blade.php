@if($sliders)
<h2>Добавленные слайды</h2>
<div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
           	  <th>ID</th>
              <th>Название en</th>
              <th>Название uz</th>
              <th>Название ru</th>
              <th>Псевдоним</th>
              <th>Фото</th>
              <th>Дата создания</th>
              <th>Действие</th>
            </tr>
          </thead>
          <tbody>
          	@foreach($sliders as $slider)
            <tr>
              <td>{{$slider->id}}</td>
              <td>{!!Html::link(route('admin.sliders.edit',['sliders'=>$slider->alias]),$slider->title_en)!!}</td>
              <td>{!!Html::link(route('admin.sliders.edit',['sliders'=>$slider->alias]),$slider->title_uz)!!}</td>
              <td>{!!Html::link(route('admin.sliders.edit',['sliders'=>$slider->alias]),$slider->title_ru)!!}</td>
              <td>{{$slider->alias}}</td>
              <td>{{$slider->img}}</td>
              <td>{{$slider->created_at}}</td>
              
              <td>{!! Form::open(['url' => route('admin.sliders.destroy',['sliders'=>$slider->id]),'class'=>'form-horizontal','method'=>'POST']) !!}
												    {{ method_field('DELETE') }}
												    {!! Form::button('Удалить', ['class' => 'btn btn-danger','type'=>'submit']) !!}
												{!! Form::close() !!}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
</div>
@else
<p>Слайдов нет</p>
@endif
      <div class="mb-3">{!! Html::link(route('admin.sliders.create'),'Добавить  слайд',['class' => 'btn btn-primary']) !!}</div>