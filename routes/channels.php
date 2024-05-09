<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('notification', function($user) {
    return $user != null;
});

Broadcast::channel('chat', function($user) {
    if($user != null) {
        return ['id' => $user->id, 'name' => $user->name];
    } 
    return false;
});

Broadcast::channel('user.{userId}', function($user) {
    if($user) {
        return true;
    } 
    return false;
});

Broadcast::channel('members.{groupId}', function($user) {
    if($user) {
        return true;
    } 
    return false;
});

Broadcast::channel('task.{groupId}', function($user) {
    if($user) {
        return true;
    } 
    return false;
});

Broadcast::channel('tasks.{groupId}', function($user) {
    if($user) {
        return true;
    } 
    return false;
});

Broadcast::channel('deleteTasks.{groupId}', function($user) {
    if($user) {
        return true;
    } 
    return false;
});