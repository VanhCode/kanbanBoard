<?php

use App\Http\Controllers\BoardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('authentication')->group(function() {
    Route::get('/list-user', [App\Http\Controllers\ChatController::class, 'chat'])->name('chat');
    Route::post('/post-message', [App\Http\Controllers\ChatController::class, 'sendMessage'])->name('chat.sendMessage');

    Route::get('/board', [BoardController::class, 'board'])->name('board');
    Route::post('/create-group', [BoardController::class, 'createGroup'])->name('createGroup');
    Route::get('/board-group/{groupId}', [BoardController::class, 'boardGroup'])->name('boardGroup');
    Route::post('/board-group/create-member/{boardId}', [BoardController::class, 'createMember'])->name('createMember');
    Route::post('/board-group/create-task/{boardId}', [BoardController::class, 'createTask'])->name('createTask');

    Route::post('/board-group/{boardId}/tasks/{taskId}', [BoardController::class, 'updateTask'])->name('updateTask');
    
    Route::post('/board-group/{boardId}/deleteTask', [BoardController::class, 'deleteTask'])->name('deleteTask');
    
    Route::post('/board-group/{boardId}/updateTask/{taskId}', [BoardController::class, 'updateNewTask'])->name('updateNewTask');
});

