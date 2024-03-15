@extends('layouts.base')
@section('content')
<div class="row justify-content-center">
  <div class="col-md-8">
    <p class="text-left">
      <a class="btn btn-success" href="/todo/create">ToDoを追加</a>
    </p>
    <div class="card">
      <div class="card-header">
        ToDo一覧
      </div>
      <div class="list-group list-group-flush">
      @foreach ($todos as $todo)
      <!--foreach文を実行している-->
        <div class="d-flex">
          <a href="{{ route('todo.show', $todo->id) }}" class="list-group-item list-group-item-action">
            {{ $todo->content }}
            <!--デベロッパーツールを見ると
            <class= href="http://localhost:8080/todo/1" -> class="list-group-item list-group-item-action">開発環境を構築する</a>になっている。-->
          </a>
        </div>
      @endforeach
      </div>
    </div>
  </div>
</div>
@endsection