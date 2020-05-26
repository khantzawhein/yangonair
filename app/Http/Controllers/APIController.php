<?php

namespace App\Http\Controllers;

use App\aqitemp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class APIController extends Controller
{
    public function getLatest() {
        $this->validator();
        $aqitemp = new aqitemp();
        return $aqitemp->latestData();
    }
    public function validator() {
        $validator = Validator::make(request()->all(), [
            'key' => 'required|exists:public_apis,api_key'
        ]);
        if ($validator->fails()) {
            abort(403,'Incorrect API Key');
        }
    }
}
