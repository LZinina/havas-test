@if($requisites)
<h2>Реквизиты</h2>
<div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
           	  <th>ID</th>
              <th>Текст en</th>
              <th>Текст uz</th>
              <th>Текст ru</th>
              <th>Дата создания</th>
              <th>Действие</th>
            </tr>
          </thead>
          <tbody>
          	@foreach($requisites as $requisite)
            <tr>
              <td>{{$requisite->id}}</td>
              <td>{{$requisite->text_en}}</td>
              <td>{{$requisite->text_uz}}</td>
              <td>{{$requisite->text_ru}}</td>
              
              <td>{{$requisite->created_at}}</td>
              
              <td>{!! Form::open(['url' => route('admin.requisites.destroy',['requisites'=>$requisite->id]),'class'=>'form-horizontal','method'=>'POST']) !!}
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
      <div class="mb-3">{!! Html::link(route('admin.requisites.create'),'Добавить  материал',['class' => 'btn btn-primary']) !!}</div>
