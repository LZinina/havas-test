@if($res_names)
<h2>Добавленные категории</h2>
<div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>ID</th>
              <th>Название</th>
              
              <th>Дата создания</th>
              <th>Действие</th>
            </tr>
          </thead>
          <tbody>
            @foreach($res_names as $res_name)
            <tr>
              <td>{{$res_name->id}}</td>
              <td>{{$res_name->title}}</td>
              
              
              <td>{{$res_name->created_at}}</td>
              
              <td>{!! Form::open(['url' => route('admin.res_names.destroy',['res_names'=>$res_name->id]),'class'=>'form-horizontal','method'=>'POST']) !!}
                            {{ method_field('DELETE') }}
                            {!! Form::button('Удалить', ['class' => 'btn btn-danger','type'=>'submit']) !!}
                        {!! Form::close() !!}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
</div>
@else
<p>Ресурсов нет</p>
@endif
      <div class="mb-3">{!! Html::link(route('admin.res_names.create'),'Добавить ресурс',['class' => 'btn btn-primary']) !!}</div>