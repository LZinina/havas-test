@if($articles)
<h2>Добавленные статьи</h2>
<div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
           	  <th>ID</th>
              <th>Заголовок</th>
              <th>Текст</th>
              <th>Изображение</th>
              <th>Описание</th>
              <th>Псевдоним</th>
              <th>Категория</th>
              <th>Действие</th>
            </tr>
          </thead>
          <tbody>
          	@foreach($articles as $article)
            <tr>
              <td>{{$article->id}}</td>
              <td>{!!Html::link(route('admin.posts.edit',['articles'=>$article->alias]),$article->title)!!}</td>
              <td>{{str_limit($article->text,1000)}}</td>
              <td><img src="{{asset(env('THEME'))}}/images/articles/{{$article->img}}" width="100%"></td>
              <td>{{$article->desc}}</td>
              <td>{{$article->alias}}</td>
              <td>{{$article->category->title}}</td>
              <td>{!! Form::open(['url' => route('admin.posts.destroy',['articles'=>$article->alias]),'class'=>'form-horizontal','method'=>'POST']) !!}
												    {{ method_field('DELETE') }}
												    {!! Form::button('Удалить', ['class' => 'btn btn-danger','type'=>'submit']) !!}
												{!! Form::close() !!}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
</div>
      <div class="mb-3">{!! HTML::link(route('admin.posts.create'),'Добавить  материал',['class' => 'btn btn-primary']) !!}</div>
@endif
