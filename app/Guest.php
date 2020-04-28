<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use NotificationChannels\WebPush\HasPushSubscriptions;

class Guest extends Model
{
    //
    use Notifiable;
    use HasPushSubscriptions;
    protected $fillable = [
        'endpoint',
    ];

}
