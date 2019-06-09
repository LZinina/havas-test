@if($albums)
<h2>Добавленные альбомы</h2>
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
          	@foreach($albums as $album)
            <tr>
              <td>{{$album->id}}</td>
              <td>{{$album->title}}</td>
              
              <td>{{$album->created_at}}</td>
              
              <td>{!! Form::open(['url' => route('admin.albums.destroy',['albums'=>$album->id]),'class'=>'form-horizontal','method'=>'POST']) !!}
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
      <div class="mb-3">{!! Html::link(route('admin.albums.create'),'Добавить  материал',['class' => 'btn btn-primary']) !!}</div>

