<?php


namespace App\AppFunctions;
use Carbon\Carbon;
use App\FbPostTemplate;
class PostWriter
{
    public static function write($overall) {
        $category = helper::getCategory($overall);
        $timeMM = Carbon::now()->locale('my_MM')->isoFormat('A Oh:Om');
        $timeEN = Carbon::now()->locale('en')->isoFormat('h:mm A');
        if ($category['level'] == 0) {
            $DB = FbPostTemplate::where('category', "Good")->where('is_default', true)->first();
            $templateEN = $DB->template_en;
            $templateMM = $DB->template_my_MM;
        }
        else if ($category['level'] == 1) {
            $DB = FbPostTemplate::where('category', "Moderate")->where('is_default', true)->first();
            $templateEN = $DB->template_en;
            $templateMM = $DB->template_my_MM;
        }
        else if ($category['level'] == 2) {
            $DB = FbPostTemplate::where('category', "UnhealthyForSensitiveGroups")->where('is_default', true)->first();
            $templateEN = $DB->template_en;
            $templateMM = $DB->template_my_MM;
        }
        else if ($category['level'] == 3) {
            $DB = FbPostTemplate::where('category', "Unhealthy")->where('is_default', true)->first();
            $templateEN = $DB->template_en;
            $templateMM = $DB->template_my_MM;
        }
        else if ($category['level'] == 4) {
            $DB = FbPostTemplate::where('category', "VeryUnhealthy")->where('is_default', true)->first();
            $templateEN = $DB->template_en;
            $templateMM = $DB->template_my_MM;
        }
        else if ($category['level'] == 5) {
            $DB = FbPostTemplate::where('category', "Hazardous")->where('is_default', true)->first();
            $templateEN = $DB->template_en;
            $templateMM = $DB->template_my_MM;
        }
        $templateEN = str_replace([':timeEN', ':aqivalue'], [$timeEN, $overall], $templateEN);
        $templateMM = str_replace([':timeMM', ':aqivalue'], [$timeMM, $overall], $templateMM);
        return $templateMM . "\r\n\r\n" . $templateEN;
    }
}
