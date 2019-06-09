@if($musics)
<h2>Добавленные треки</h2>
<div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
           	  <th>ID</th>
              <th>Название альбома</th>
              <th>Псевдоним</th>
              <th>Ссылка на iTunes</th>
              <th>Категория</th>
              <th>Дата создания</th>
              <th>Действие</th>
            </tr>
          </thead>
          <tbody>
          	@foreach($musics as $item)
            <tr>
              <td>{{$item->id}}</td>
              <td>{!!Html::link(route('admin.musics.edit',['musics'=>$item->alias]),$item->title)!!}</td>
              <td>{{$item->alias}}</td>
              <td>{{$item->path_itunes}}</td>
              <td>{{$item->category->title_ru}}</td>
              <td>{{$item->created_at}}</td>
              <td>{!! Form::open(['url' => route('admin.musics.destroy',['musics'=>$item->alias]),'class'=>'form-horizontal','method'=>'POST']) !!}
												    {{ method_field('DELETE') }}
												    {!! Form::button('Удалить', ['class' => 'btn btn-danger','type'=>'submit']) !!}
												{!! Form::close() !!}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
</div>
@else
<p>Треков нет</p>
@endif
      <div class="mb-3">{!! Html::link(route('admin.musics.create'),'Добавить  материал',['class' => 'btn btn-primary']) !!}</div>

