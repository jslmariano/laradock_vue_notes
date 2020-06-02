<?php
use Illuminate\Support\Facades\Route;

Route::get('notes', 'NotesController@index')->name('notes');

Route::group(['prefix' => 'note'], function () {
    Route::get('test', 'NotesController@test')->name('notes.test');
    Route::post('store', 'NotesController@store')->name('notes.store');
    Route::get('edit/{id}', 'NotesController@edit')->name('notes.edit');
    Route::put('update/{id}', 'NotesController@update')->name('notes.update');
    Route::delete('delete/{id}', 'NotesController@delete')->name('notes.delete');
});
