<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/todo/create', 'TodoController@create')->name('todo.create');
Route::post('/todo', 'TodoController@store')->name('todo.store');
Route::get('/todo', 'TodoController@index')->name('todo.index');//一覧表示用
Route::get('/todo/{id}', 'TodoController@show')->name('todo.show');//詳細表示用{id}はURLの値
Route::get('/todo/{id}/edit', 'TodoController@edit')->name('todo.edit');//編集用
Route::put('/todo/{id}', 'TodoController@update')->name('todo.update');//更新用
Route::delete('/todo/{id}', 'TodoController@delete')->name('todo.delete');//削除用

/*Laravelにおけるルートとは「このリクエストが来たら、この処理をする。」という定義
第一引数ではURIを指定しており、ドメイン「http://localhost:8080/」 以降のパスを表しており、
第二引数ではそれに対応するアクションを紐づけている（AAA＠BBBはAAAクラス内のBBBメソッドを呼び出す）。
GETリクエストは、リソースを取得するために使用され、ウェブページの表示やデータの取得に使用される。
POSTリクエストは、新しいデータを作成するために使用され、フォームデータの送信やリソースの作成に使用されます。
PUTリクエストは、既存のリソースを更新するために使用され、リソースの全体を更新する場合に使用されます。
アロー演算子以降はそのルートの名前を記載しており、開発途中でURLの記載を変更しなければならない場合に、
この部分だけ直せばOKにできるので作業効率の向上に繋がる*/

?>