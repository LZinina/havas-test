@if($videos)
<h2>Добавленные видео</h2>
<div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
           	  <th>ID</th>
              <th>Название</th>
              <th>Адрес видео на YouTube</th>
              <th>Дата создания</th>
              <th>Действие</th>
            </tr>
          </thead>
          <tbody>
          	@foreach($videos as $video)
            <tr>
              <td>{{$video->id}}</td>
              <td>{{$video->name}}</td>
              <td>{{$video->filename}}</td>
              <td>{{$video->created_at}}</td>
              
              <td>{!! Form::open(['url' => route('admin.videos.destroy',['videos'=>$video->id]),'class'=>'form-horizontal','method'=>'POST']) !!}
												    {{ method_field('DELETE') }}
												    {!! Form::button('Удалить', ['class' => 'btn btn-danger','type'=>'submit']) !!}
												{!! Form::close() !!}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
</div>
@endif
      <div class="mb-3">{!! Html::link(route('admin.videos.create'),'Добавить  материал',['class' => 'btn btn-primary']) !!}</div>

