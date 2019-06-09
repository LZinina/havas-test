@if($categories)
<h2>Добавленные категории</h2>
<div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
           	  <th>ID</th>
              <th>Название en</th>
              <th>Название uz</th>
              <th>Название ru</th>
              <th>Псевдоним</th>       
              <th>Дата создания</th>
              <th>Действие</th>
            </tr>
          </thead>
          <tbody>
          	@foreach($categories as $category)
            <tr>
              <td>{{$category->id}}</td>
              <td>{{$category->title_en}}</td>
              <td>{{$category->title_uz}}</td>
              <td>{{$category->title_ru}}</td>
              <td>{{$category->alias}}</td>
              <td>{{$category->created_at}}</td>
              
              <td>{!! Form::open(['url' => route('admin.categories.destroy',['categories'=>$category->id]),'class'=>'form-horizontal','method'=>'POST']) !!}
												    {{ method_field('DELETE') }}
												    {!! Form::button('Удалить', ['class' => 'btn btn-danger','type'=>'submit']) !!}
												{!! Form::close() !!}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
</div>
@else
<p>Категорий нет</p>
@endif
      <div class="mb-3">{!! Html::link(route('admin.categories.create'),'Добавить категорию',['class' => 'btn btn-primary']) !!}</div>