@if($shedules)
<h2>Добавленные расписания:</h2>
<div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>ID</th>
              <th>Название концерта en</th>
              <th>Название концерта uz</th>
              <th>Название концерта ru</th>
              <th>Псевдоним</th>
              <th>Дата</th>
              <th>Время</th>
              <th>Цена билета en</th>
              <th>Цена билета uz</th>
              <th>Цена билета ru</th>
              <th>Место проведения en</th>
              <th>Место проведения на uz</th>
              <th>Место проведения на ru</th>
              <th>Текст en</th>
              <th>Текст uz</th>
              <th>Текст ru</th>
              <th>Действие</th>
            </tr>
          </thead>
          <tbody>
            @foreach($shedules as $shedule)
            <tr>
              <td>{{$shedule->id}}</td>
              <td>{!!Html::link(route('admin.shedules.edit',['shedules'=>$shedule->alias]),$shedule->title_en)!!}</td>
              <td>{!!Html::link(route('admin.shedules.edit',['shedules'=>$shedule->alias]),$shedule->title_uz)!!}</td>
              <td>{!!Html::link(route('admin.shedules.edit',['shedules'=>$shedule->alias]),$shedule->title_ru)!!}</td>
              <td>{{$shedule->alias}}</td>
              <td>{{$shedule->data}}</td>
              <td>{{$shedule->time}}</td>
              <td>{{$shedule->price_en}}</td>
              <td>{{$shedule->price_uz}}</td>
              <td>{{$shedule->price_ru}}</td>
              <td>{{$shedule->address_en}}</td>
              <td>{{$shedule->address_uz}}</td>
              <td>{{$shedule->address_ru}}</td>
              <td>{{$shedule->text_en}}</td>
              <td>{{$shedule->text_uz}}</td>
              <td>{{$shedule->text_ru}}</td>
              <td>{!! Form::open(['url' => route('admin.shedules.destroy',['shedules'=>$shedule->alias]),'class'=>'form-horizontal','method'=>'POST']) !!}
                            {{ method_field('DELETE') }}
                            {!! Form::button('Удалить', ['class' => 'btn btn-danger','type'=>'submit']) !!}
                        {!! Form::close() !!}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
</div>
@else
<p>Статей нет</p>
@endif
      <div class="mb-3">{!! Html::link(route('admin.shedules.create'),'Добавить  материал',['class' => 'btn btn-primary']) !!}</div>

