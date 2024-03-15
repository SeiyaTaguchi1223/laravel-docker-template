<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    //セクション８追加
    protected $table = 'todos';//作成されたモデルクラスに、対応するテーブルを指定

    //セクション８追加-2
    protected $fillable = [
        'content'
    ];//リクエストから取得した値をtodoテーブルに保存する処理
}
