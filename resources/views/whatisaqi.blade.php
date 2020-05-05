@extends('layouts.layout')
@section('title', 'What is AQI?')
@section('head')
<link rel="stylesheet" href="{{ asset('css/whatisaqi.styles.css') }}">
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
@endsection
@section('content')
<div class="row pt-3 whatis-container">
    <div class="col-sm-6 border-two-col">
        <h4 class="eng bold whatis-title">AQI? PM2.5?</h4>
        <p class="eng-1">An air quality index (AQI) is used by government agencies to communicate to the public how polluted the air currently is or how polluted it is forecast to become. Public health risks increase as the AQI rises. </p>
    </div>
    <div class="col-sm-6">
        <h4 class="burmese bold whatis-title">AQI, PM2.5 ဆိုတာဘာလဲ?</h4>
        <p class="burmese whitespace">AQI ရဲ့အရှည်ကတော့ Air Quality Index(လေထုအရည်အသွေးညွှန်းကိန်း) ကိုပြောတာဖြစ်ပါတယ်။ AQI အညွှန်းကိန်းတွေကို အစိုးရအေဂျင်စီပိုင်းတွေက လေထုအရည်အသွေးး လက်ရှိမှာဘယ်လောက်ရှိနေတယ်ဆိုတာကိုပြောချင်တဲ့အခါ၊ ဒါမှမဟုတ် လေထုအရည်အသွေးခန့်မှန်းချက်မျိုးထုတ်ချင်တဲ့အခါမှာ ပြည်သူလူထုအလွယ်တကူ နားလည်စေဖို့အတွက် အသုံးပြုကြပါတယ်။ AQI အညွှန်းကိန်းမြင့်တက်လာတာနဲ့အမျှ ပြည်သူတွေမှာ ရောဂါဖြစ်နိုင်ချေလည်း ပိုများလာတာပါပဲ။ </p>
    </div>
    <div class="col-sm-6 border-two-col">
        <h4 class="eng bold whatis-title">How does the AQI work?</h4>
        <p class="eng-1">Think of the AQI as a yardstick that runs from 0 to 500. The higher the AQI value, the greater the level of air pollution and the greater the health concern. For example, an AQI value of 50 or below represents good air quality, while an AQI value over 300 represents hazardous air quality.
            An AQI value of 100 generally corresponds to an ambient air concentration that equals the level of the short-term national ambient air quality standard for protection of public health. AQI values at or below 100 are generally thought of as satisfactory. When AQI values are above 100, air quality is unhealthy: at first for certain sensitive groups of people, then for everyone as AQI values get higher.
            The AQI is divided into six categories. Each category corresponds to a different level of health concern. Each category also has a specific color. The color makes it easy for people to quickly determine whether air quality is reaching unhealthy levels in their communities.</p>
    </div>
    <div class="col-sm-6">
        <h4 class="burmese bold whatis-title">AQI အညွှန်းကိန်းတွေက ဘယ်လိုအလုပ်လုပ်တာလဲ...?</h4>
        <p class="burmese whitespace">AQI ကို တိုင်းတာဖို့ဆို 0 ကနေ 500 အထိ အမှတ်တွေပါတဲ့ပေတံတစ်ခုကို စိတ်ကူးထဲမှာမြင်ယောင်ကြည့်လိုက်ပါ။ AQI ညွှန်းကိန်းတွေများလာတာနဲ့အမျှ လေထုကလည်းပိုညစ်ညမ်းလာတာဖြစ်ပြီးတော့ ကျန်းမာရေးပိုထိခိုက်လာနိုင်တာဖြစ်ပါတယ်။ AQI ညွှန်းကိန်း 50 အောက်ရောက်နေမယ်ဆိုရင် လေထုအရည်အသွေးကောင်းနေတာဖြစ်ပြီးတော့ 300 ကျော်နေမယ်ဆိုရင်တော့ အရမ်းအန္တရာယ်များတဲ့ လေထုအခြေအနေလို့ မှတ်ယူရမှာဖြစ်ပါတယ်။
            AQI အညွှန်းကိန်း 100 ဖြစ်နေပြီဆိုရင် ရောဂါဖြစ်စေတဲ့ အမှုန်တွေဟာ လေထုထဲမှာ အတိုင်းအတာတစ်ခုထိ စုဝေးနေကြပြီလို့ ညွှန်ပြနေတာဖြစ်ပြီးတော့၊ အဲ့အဆင့်ဟာ နိုင်ငံလုံးဆိုင်ရာ တစ်နှစ်တာအတွင်း လေထုညစ်ညမ်းမှု စံညွှန်းကိန်းနဲ့ ညီမျှနေတာပဲ ဖြစ်ပါတယ်။ 100 အောက်နည်းတဲ့ AQI အညွှန်းကိန်းတွေကို သင့်တင့်တဲ့ အညွှန်းကိန်းတွေအဖြစ် လက်ခံထားကြပြီးတော့ 100 ထက်များသွားမယ်ဆိုရင်တော့ လေထုအရည်အသွေးက ဆိုးရွားလာတာပါပဲ။ အဲ့လိုဆိုးရွားလာရင် ပထမဆုံးအနေနဲ့ ရောဂါအခံရှိတဲ့၊ အထိခိုက်မခံနိုင်တဲ့လူတွေအတွက် ဂရုစိုက်ရမှာဖြစ်ပြီးတော့ အဲ့ထက်ပိုပိုမြင့်လာမယ်ဆိုရင် လူတိုင်းဂရုစိုက်ရတော့မှာပဲ ဖြစ်ပါတယ်။ 
            AQI အညွှန်းကိန်းတွေကို အမျိုးအစားခြောက်ခု ခွဲခြားထားပါတယ်။ အမျိုးအစားတစ်ခုချင်းစီတိုင်းက ကျန်းမာရေးအတွက် တမျိုးစီထိခိုက်စေနိုင်ပြီးတော့ အမျိုးအစားတစ်ခုကို အရောင်တစ်ခုနဲ့ နားလည်လွယ်အောင် သတ်မှတ်ထားပါတယ်။ အဲ့လိုအရောင်နဲ့သတ်မှတ်ပေးထားတဲ့အတွက် ပြည်သူတွေက သူတို့နေထိုင်ရာပတ်ဝန်းကျင်မှာ လေထုအရည်အသွေးက စိုးရိမ်ရတဲ့အဆင့်ကိုရောက်နေလား မရောက်နေလားဆိုတာကို လျင်လျင်မြန်မြန်ပဲ ခွဲခြားသိနိုင်မှာ ဖြစ်ပါတယ်။</p>
    </div>
    <div class="col-sm-6 border-two-col">
        <h4 class="eng bold whatis-title">What is PM2.5?</h4>
        <p class="eng-1">Particulates are microscopic particles of solid or liquid matter suspended in the air. Sources of particulate matter can be natural or anthropogenic. They have impacts on climate and precipitation that adversely affect human health, in ways additional to direct inhalation.
            PM2.5 corresponds to particulates that are just about 2.5 micrometers long, which can severely damage health. AQI value is calculated from the amount of PM2.5 in micrograms which is contained in 1 cubic meter of air.</p>
    </div>
    <div class="col-sm-6">
        <h4 class="burmese bold whatis-title">PM2.5 ဆိုတာ ဘာကိုပြောတာလဲ ...?</h4>
        <p class="burmese whitespace">PM ဆိုတာ Particulate Matter ကိုကိုယ်စားပြုပါတယ်။
            Particulate Matter တွေ ဆိုတာက လေထုထဲမှာ ပျံ့နေပြီးတော့၊ မိုက်ခရိုစကုပ်နဲ့ ကြည့်မှ မြင်နိုင်တဲ့ အမှုန်လေးတွေဖြစ်ပြီး သူတို့ဟာ အစိုင်အခဲအနေနဲ့ရော၊ အရည်အနေနဲ့ပါ ရှိနေနိုင်ပါတယ်။ ဒီအမှုန်လေးတွေက သဘာဝအလျောက်လည်းရှိနေနိုင်ပြီး လူတွေကြောင့် ဖြစ်ပေါ်လာရတာမျိုးလည်းရှိပါတယ်။ သူတို့ဟာ ရာသီဥတု၊ မိုးနဲ့ ဆီးနှင်းကျတာတွေအပါအဝင် တိုက်ရိုက်ရှုသွင်းမိတဲ့ လူသားတွေရဲ့ကျန်းမာရေးကိုပါ ဆိုးဆိုးဝါးဝါး ထိခိုက်စေနိုင်ပါတယ်။  PM2.5 ဆိုတာကတော့ 2.5 micrometers လောက်ပဲ အရွယ်အစားရှိတဲ့ လေထုထဲကအမှုန်အမွှားတွေကို ရည်ညွှန်းတာဖြစ်ပြီး သူတို့က ကျန်းမာရေးကို ဆိုးဆိုးဝါးဝါးထိခိုက်စေတာပဲ ဖြစ်ပါတယ်။ တစ် ကုဗမီတာ (1 meter cube, 1 m3) ရှိတဲ့လေထုထဲမှာ PM2.5 အမှုန်တွေ ဘယ်လောက် micro gram(µg) ပါနေလဲဆိုတာကို တွက်ချက်ပြီးတော့ အဲ့ကရတဲ့ ရလဒ်နဲ့မှ AQI တန်ဖိုးကိုတွက်ချက်ရတာဖြစ်ပါတယ်။</p>
    </div>
    <div class="col-sm-6 border-two-col">
        <h4 class="eng bold whatis-title">AQI Chart</h4>
        <img src="images/aqichart_en.png" width="100%" alt="AQI Chart ENG">
    </div>
    <div class="col-sm-6">
        <h4 class="burmese bold whatis-title">AQI ဇယား</h4>
        <img src="images/aqichart_mm.png" width="100%" alt="AQI Chart MM">
    </div>
</div>
@endsection