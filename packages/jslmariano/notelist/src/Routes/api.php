<?php
use Illuminate\Support\Facades\Route;

Route::get('notes', 'NotesController@index');

Route::group(['prefix' => 'note'], function () {
    Route::get('test', 'NotesController@test');
    Route::post('add', 'NotesController@add');
    Route::get('edit/{id}', 'NotesController@edit');
    Route::post('update/{id}', 'NotesController@update');
    Route::delete('delete/{id}', 'NotesController@delete');
});
