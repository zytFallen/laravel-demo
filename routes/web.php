<?php

//后台路由
Route::get('/admin/login','Admin\Index@login');
Route::post('/admin/dologin','Admin\Index@dologin');
Route::namespace('Admin')->prefix('admin')->middleware('admin')->group(function (){
    Route::get('/','Index@index');
    Route::get('/logout','Index@logout');
    Route::get('/welcome','Index@welcome');
    Route::resources(['cate'=>'Category']);
});

