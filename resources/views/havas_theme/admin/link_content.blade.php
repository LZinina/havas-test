@if($links && count($links)>0)
<h2>Добавленные ссылки</h2>
<div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
           	  <th>ID</th>
              <th>Название альбома</th>
              <th>Нзавание ресурса</th>
              <th>Ссылка на альбом</th>
              <th>Дата создания</th>
              <th>Действие</th>
            </tr>
          </thead>
          <tbody>
          	@foreach($links as $link)
            <tr>
              <td>{{$link->id}}</td>
              <td>{{$link->musics->title}}</td>
              <td>{{$link->res_names->title}}</td>
              
              <td>{{$link->link}}</td>
              <td>{{$link->created_at}}</td>
              
              <td>{!! Form::open(['url' => route('admin.links.destroy',['links'=>$link->id]),'class'=>'form-horizontal','method'=>'POST']) !!}
												    {{ method_field('DELETE') }}
												    {!! Form::button('Удалить', ['class' => 'btn btn-danger','type'=>'submit']) !!}
												{!! Form::close() !!}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
</div>
@else
<p>Ссылок нет</p>
@endif
      <div class="mb-3">{!! Html::link(route('admin.links.create'),'Добавить ссылку',['class' => 'btn btn-primary']) !!}</div>
