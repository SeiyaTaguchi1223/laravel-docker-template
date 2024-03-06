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

/*Route::get('/', function () {
    return view('welcome');
});//GETでhttp://localhost:8080/にリクエストされたら、welcomeを表示するという意味

Route::get('/test',function() {//Route::get()の第一引数ではURLを指定しており、ドメイン以降のパスを表している
    echo 'Hello World!';
});*/

/*Route::get('/todo/create',function() {
    return view('todo.create');
})->name('todo.create');*///24行目はこのルートに名付けたニックネームのようなもの

Route::get('/todo/create', 'TodoController@create')->name('todo.create');

Route::post('/todo', 'TodoController@store')->name('todo.store');
/*登録用の値を送信するためHTTPメソッドはPOST・Laravelのルートにおいて、
HTTPメソッドはこのようにRoute::HTTPメソッド名で表現できる*/

?>