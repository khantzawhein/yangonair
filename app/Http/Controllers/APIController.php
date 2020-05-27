<?php

namespace App\Http\Controllers;

use App\aqitemp;
use App\Imagefilenames;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\AppFunctions\PostWriter;
use App\AppFunctions\ImageGenerator;
class APIController extends Controller
{
    public function chatfuelJson($data) {
        $text = PostWriter::write($data->overall);
        $image_db = Imagefilenames::select('filename')->first();
        return [
            "messages" => [
                ["text" => $text],
                ["attachment" =>
                    [
                        "type" => "image",
                        "payload" => [
                            "url" => url("storage/cache/{$image_db->filename}.png")
                        ]
                    ]
                ]
        ]
        ];
    }
    public function getLatest() {
        $this->validator();
        $aqitemp = new aqitemp();
        $data = $aqitemp->latestData();
        return $this->chatfuelJson($data);

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
