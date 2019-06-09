@if($abouts)
<h2>Добавленные статьи</h2>
<div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
           	  <th>ID</th>
              <th>Заголовок en</th>
              <th>Заголовок uz</th>
              <th>Заголовок ru</th>
              <th>Текст en</th>
              <th>Текст uz</th>
              <th>Текст ru</th>
              <th>Псевдоним</th>
              <th>Изображение</th>
              <th>Дата создания</th>
              <th>Действие</th>
            </tr>
          </thead>
          <tbody>
          	@foreach($abouts as $item)
            <tr>
              <td>{{$item->id}}</td>
              <td>{!!Html::link(route('admin.abouts.edit',['abouts'=>$item->alias]),$item->title_en)!!}</td>
              <td>{!!Html::link(route('admin.abouts.edit',['abouts'=>$item->alias]),$item->title_uz)!!}</td>
              <td>{!!Html::link(route('admin.abouts.edit',['abouts'=>$item->alias]),$item->title_ru)!!}</td>
              <td>{{$item->text_en}}</td>
              <td>{{$item->text_uz}}</td>
              <td>{{$item->text_ru}}</td>
              <td>{{$item->alias}}</td>
              <td><img src="{{asset(env('THEME'))}}/images/about/{{$item->img}}" width="100%"></td>
              <td>{{$item->created_at}}</td>
              <td>{!! Form::open(['url' => route('admin.abouts.destroy',['abouts'=>$item->alias]),'class'=>'form-horizontal','method'=>'POST']) !!}
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
      <div class="mb-3">{!! Html::link(route('admin.abouts.create'),'Добавить  материал',['class' => 'btn btn-primary']) !!}</div>

