<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('media.{mediaId}', function ($user, $mediaId) {
    return \App\Models\Media::where('id', $mediaId)
        ->where('user_id', $user->id)
        ->exists();
});
