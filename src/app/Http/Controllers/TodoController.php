<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Todo;

class TodoController extends Controller
{
    private $todo;
    
    public function __construct(Todo $todo)
    {
        //dd($this->todo);nullになった
        $this->todo = $todo;
    }

    /*
    public function __construct()
    {
    　$todo = new Todo();
      $this->todo = $todo;
    }
    と同義
    */

    public function index()
    {
        $todos = $this->todo->all();
        /*dd($todos);をすると
        Illuminate\Database\Eloquent\Collection（クラス） {#273 ▼
            #items: array:5 [▼
              0 => App\Todo←ここに注目 {#274 ▶}
              1 => App\Todo {#275 ▶}
              2 => App\Todo {#276 ▶}
              3 => App\Todo {#277 ▶}
              4 => App\Todo {#278 ▶}
            ]
          }になる。
          /*ToDoモデルインスタンス
        */
        return view('todo.index', ['todos' => $todos]);
        //view配下のtodo.index.blade.phpを表示させる
    }

    public function create()
    {
        return view('todo.create');//viewsディレクトリ配下
        //todo.createを表示するリターン文
    }

    public function store(TodoRequest $request)//バリーテーションを実行して問題がなければクラスをインスタンス化する
    {
        $inputs = $request->all();
        //dd($request->all());を実行すると、配列contentキーに入力したToDoが受け取られている
        //dd($this->todo);table=todos、array型
        $this->todo->fill($inputs);
        $this->todo->save();
        /*
        saveメソッドは、 呼び出し元インスタンスに保存されているデータを元にINSERT文を実行
        「引数に何も渡していないのに、なぜsaveメソッドは『contentが焼肉』？」
        その答えは、$this->todoに「contentが焼肉である」という情報が保存されていた。
        そして、その情報を保存したのがfillメソッドで、fill()の引数に['カラム名' => '保存したい値']という連想配列を渡すと、
        その情報を$this->todoに保存してくれる。
        fill()前後の相違点:
        connctionがnull→mysql、
        wasRecentlyCreated:がfalseからtrueに、
        attributes: array:1→4に、
        original: にarray:4が入っている
        ['カラム名' => '保存したい値'] という連想配列を作り出すために $request->all() が必要*/
        return redirect()->route('todo.index');
    }

    public function show($id)
    {
        //dd($id);→todosテーブルのidカラムの値が受け取られている
        $todo = $this->todo->find($id);
        /*dd($todo);をやると
        取得したデータの情報が事細かに記載されている,条件句はwhere*/
        return view('todo.show', ['todo' => $todo]);//show.blade.phpを表示
    }

    public function edit($id)
    {
        //dd($id);は選択したデータのidが表示される
        $todo = $this->todo->find($id);
        //dd($todo);もshow関数と同じ
        return view('todo.edit', ['todo' => $todo]);
    }

    public function update(TodoRequest $request, $id)
    {
        $inputs = $request->all();
        $todo = $this->todo->find($id);//対象のデータの有無でupdateかinsert文かが分かれる
        $todo->fill($inputs);
        $todo->save();
        //dd($this->todo->id, $todo->id); 左はidがnull、右はidが２だった
        return redirect()->route('todo.show', $todo->id);
    }

    public function delete($id)
    {
        $todo = $this->todo->find($id);//idに入っているデータ型はstring型で値は選んだデータのid、$todoはオブジェクト型。
        $todo->delete();//var_dump、ddしたらnullが出た。deleteメソッドのリターンがboll型かnullで返すから、SoftDeleteクラスを作成したらtrueが返ってきた。
        return redirect()->route('todo.index');
    }

    public function complete($id)
    {
        $todo = $this->todo->find($id);//complete()の引数で受け取った$idをもとに、対象のレコードを1件取得
        $todo->is_completed = !$todo->is_completed;
        /*右辺の記述の!で$todo->is_completedの結果を否定するようにする。
        もともと$todo->is_completedがtrue（完了状態）であれば、false（未完了状態）になり、
        false（未完了状態）であれば、true（完了状態）になる*/
        $todo->save();//save()を用いてUPDATE文を実行してレコードの内容を更新
        return response()->json(['is_completed' => $todo->is_completed]);
        //上記で実装したToDoの完了時のレスポンスは"is_completed": trueで返される。
    }
}