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

Broadcast::channel('message.{toUser}',function($user , $toUser){
    return (int) $user->id === (int) $toUser;
    // return true;
});

Broadcast::channel('privateMessageChannel.{recived_id}',function($user , $recived_id){
    // return (int) $user->id === (int) $recived_id;
    return true;

});

Broadcast::channel('notificationChannel.{userId}',function($user , $userId){
    return (int) $user->id === (int) $userId;
});