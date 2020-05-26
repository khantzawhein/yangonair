<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PublicApi extends Model
{
    protected $fillable = ['api_key'];
    public function generate() {
        $key = Str::random(32);
        $this->create([
            'api_key' => $key
        ]);
    }
}
