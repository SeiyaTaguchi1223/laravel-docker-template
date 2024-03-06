<?php

namespace App\Http\Controllers;

use App\Todo;//セクション８追加
use Illuminate\Http\Request;

class TodoController extends Controller
{
    //セクション８追加
    private $todo;
    
    public function __construct(Todo $todo)
    {
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

    //追加・セクション７
    public function create()
    {
        return view('todo.create');
    }

    public function store(Request $request)
    /*Requestは、リクエスト情報を扱うLaravelのクラス。
    引数でこのように指定することによって、Requestクラスをインスタンス化したものが$requestに代入される。
    この引数を利用したインスタンス化機能は「メソッドインジェクション」と呼ぶ。
    Controllerに定義するメソッドは自動的にこの機能を使える。*/
    {
        //dd($reqest->all());←セクション７の内容
        /*dd()はLaravel専用のヘルパ関数（※）で、var_dumpと似ている。
        大きく異なるのはこの関数が実行された時点で処理が止まるという点で、
        exit()を書かずに済み、出力結果もより見やすいものになっている。*/
        $inputs = $request->all();
        $this->todo->fill($inputs);
        $this->todo->save();//saveで登録処理

        /*saveメソッドは、 呼び出し元インスタンスに保存されているデータを元にINSERT文を実行。
        「引数に何も渡していないのに、なぜsaveメソッドは『contentが焼肉』なのか？
        $this->todoに「contentが焼肉である」という情報が保存されていたからなのです。
        その情報を保存したのがfillメソッド
        fill()の引数に['カラム名' => '保存したい値']という連想配列を渡すと、その情報を$this->todoに保存してくれる。
         */
    }
}
