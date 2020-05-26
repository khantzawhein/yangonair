<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\AppFunctions\helper;

class aqitemp extends Model
{
    //
    use Notifiable;

    function latestData() {
        return $this->latest()->first();
    }
    function getCategory() {
        return collect(helper::getCategory($this->overall));
    }

}
