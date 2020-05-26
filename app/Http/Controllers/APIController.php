<?php

namespace App\Http\Controllers;

use App\aqitemp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\AppFunctions\PostWriter;
use App\AppFunctions\ImageGenerator;
class APIController extends Controller
{
    public function chatfuelJson($data) {
        $text = PostWriter::write($data->overall);
        return [
            "messages" => [
                ["text" =>"ယခု အချိန်တွင် ရန်ကုန်မြို့ရဲ့ လေထုအရည်အသွေးမှာ {$data->overall} AQI ဖြစ်ပါတယ်။"],
                ["text" => $text],
                ["attachment" =>
                    [
                        "type" => "image",
                        "payload" => [
                            "url" => url('storage/cache/AQIFB.png')
                        ]
                    ]
                ]
        ]
        ];
    }
    public function getLatest() {
//        $this->validator();
        $aqitemp = new aqitemp();
        $data = $aqitemp->latestData();
        $imageGen = new ImageGenerator();
        $imageGen->ImageLoader($data->overall);
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
