@if($articles)
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
              <th>Автор</th>
              <th>Изображение</th>
              <th>Псевдоним</th>
              <th>Дата создания</th>
              <th>Действие</th>
            </tr>
          </thead>
          <tbody>
          	@foreach($articles as $article)
            <tr>
              <td>{{$article->id}}</td>
              <td>{!!Html::link(route('admin.posts.edit',['articles'=>$article->alias]),$article->title_en)!!}</td>
              <td>{!!Html::link(route('admin.posts.edit',['articles'=>$article->alias]),$article->title_uz)!!}</td>
              <td>{!!Html::link(route('admin.posts.edit',['articles'=>$article->alias]),$article->title_ru)!!}</td>
              <td>{{$article->text_en}}</td>
              <td>{{$article->text_uz}}</td>
              <td>{{$article->text_ru}}</td>
              <td>{{$article->user->email}}</td>
              <td><img src="{{asset(env('THEME'))}}/images/articles/{{$article->img}}" width="100%"></td>
              
              <td>{{$article->alias}}</td>
              <td>{{$article->created_at}}</td>
              <td>{!! Form::open(['url' => route('admin.posts.destroy',['articles'=>$article->alias]),'class'=>'form-horizontal','method'=>'POST']) !!}
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
      <div class="mb-3">{!! Html::link(route('admin.posts.create'),'Добавить  материал',['class' => 'btn btn-primary']) !!}</div>

