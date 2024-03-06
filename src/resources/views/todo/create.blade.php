
        @extends('layouts.base')
        @section('content')
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">ToDo作成</div>
              <div class="card-body">
                <form method="POST" action="{{ route('todo.store') }}">
                  <!--action属性に埋め込むURLを生成
                  'todo.store'は、ルートに定義したname()メソッドの引数を表している(web.phpの28行目)
                  開発中にURLを変更しなければならなくなった場合。
                  例）「/todo」を全部「/task」に変えると。
                  もしコードの至る所にURLを記述していた場合、その全ての箇所が修正対象になるが、
                  この時ルートネームを利用していれば、
                  web.php にて、ルートネームの定義はそのままにURLだけ変更するだけで済む-->
                  @csrf
                  <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">ToDo入力</label>
                    <div class="col-md-6">
                      <input type="text" class="form-control" name="content" value="">
                    </div>
                  </div>
                  <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                      <button type="submit" class="btn btn-primary">作成</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        @endsection
