<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TodoController extends Controller
{
    //追加・セクション７
    public function create()
    {
        return view('todo.create');
    }

    public function store(Request $reqest)
    /*Requestは、リクエスト情報を扱うLaravelのクラス。
    引数でこのように指定することによって、Requestクラスをインスタンス化したものが$requestに代入される。
    この引数を利用したインスタンス化機能は「メソッドインジェクション」と呼ぶ。
    Controllerに定義するメソッドは自動的にこの機能を使える。*/
    {
        dd($reqest->all());
        /*dd()はLaravel専用のヘルパ関数（※）で、var_dumpと似ている。
        大きく異なるのはこの関数が実行された時点で処理が止まるという点で、
        exit()を書かずに済み、出力結果もより見やすいものになっている。*/
    }
}
