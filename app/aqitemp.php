<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class aqitemp extends Model
{
    //
    use Notifiable;

    function latestData() {
        return $this->latest()->first();
    }


}
