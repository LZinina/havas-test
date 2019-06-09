@if($photos)
<h2>Добавленные фотографии</h2>
<div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
           	  <th>ID</th>
              <th>Название</th>
              <th>Изображение</th>
              <th>Альбом</th>
              <th>Дата создания</th>
              <th>Действие</th>
            </tr>
          </thead>
          <tbody>
          	@foreach($photos as $photo)
            <tr>
              <td>{{$photo->id}}</td>
              <td>{{$photo->title}}</td>
              <td><img src="{{asset(env('THEME'))}}/images/photos/{{$photo->image}}" width="50%"></td>
              <td>{{$photo->album->title}}</td>
              <td>{{$photo->created_at}}</td>
              
              <td>{!! Form::open(['url' => route('admin.photos.destroy',['photos'=>$photo->id]),'class'=>'form-horizontal','method'=>'POST']) !!}
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
      <div class="mb-3">{!! Html::link(route('admin.photos.create'),'Добавить  материал',['class' => 'btn btn-primary']) !!}</div>
