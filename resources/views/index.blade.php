@extends('layouts.layout')
@section('title', 'Home')
@section('head')
<link href="https://fonts.googleapis.com/css2?family=Padauk&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/index.styles.css">
@endsection
@section('content')
<div class="row noti-alert-row">
    <div class="alert noti-alert alert-info alert-dismissible fade show " role="alert">
        <div><a href="#" class="alert-link" onclick="initSW()">Subscribe</a> to YangonAQI notification and get AQI alerts at 7AM everyday on your phone.</div>
        <div>အခုပဲ YangonAQI ရဲ့ Notification ကို <a href="#" class="alert-link" onclick="initSW()">Subscribe</a> လုပ်ပြီး နေ့စဉ် နံနက် ၇ နာရီတိုင်း ရန်ကုန်မြို့ရဲ့ Air Quality Index ကိုရယူလိုက်ပါ</div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>

<div class="row aqi-main">
    <div class="col-sm-12 mb-3 justify-content-sm-center"><h1>Current Yangon Air Quality: </h1></div>
    <div class="col-sm-12 justify-content-sm-center aqi-overall">
        <div class="box" style="background-color: {{ $colorCode }};  {{ $colorCode == ('#ffff00' ?? '#00e400' ?? '#ff7e00') ? 'color: black' : 'color: white'}}">
            <h2>{{ $overall }} AQI</h2>
            <h3>{{ $category['description'] }}</h3>
            <h3 class="burmese">{{ $category['description_mm'] }}</h3>
            <p class="updatedText">Updated {{ $updated_at }}.</p>
        </div>
    </div>
    <div class="col-4 m-auto">
        <div class="aqi-max">
            <p>Today's Max:</p>
            <div class="box-small" style="background-color: {{ $maxColor }};  {{ $maxColor == ('#ffff00' ?? '#00e400' ?? '#ff7e00') ? 'color: black' : ''}}">
                <h2>{{ $maxAQI }} AQI</h2>
            </div>
        </div>
    </div>
    <div class="col-4 m-auto">
        <div class="aqi-avg">
            <p>Today Avg:</p>
            <div class="box-small" style="background-color: {{ $avgColor }};  {{ $avgColor == ('#ffff00' ?? '#00e400' ?? '#ff7e00') ? 'color: black' : ''}}">
                <h2>{{ $avgAQI }} AQI</h2>
            </div>
        </div>
    </div>
    <div class="col-4 mr-auto">
        <div class="aqi-min">
            <p>Today Min:</p>
            <div class="box-small" style="background-color: {{ $minColor }};  {{ $minColor == ('#ffff00' ?? '#00e400' ?? '#ff7e00') ? 'color: black' : ''}}">
                <h2>{{ $minAQI }} AQI</h2>
            </div>
        </div>
    </div>
</div>
<div class="row aqi-advise secondary-background">
    <div class="col-sm-12 mb-4">
    <h2 class="eng bold" style="text-align: center;">So, What's Next?</h2></div>
    @if($category['level'] == 0)
    <div class="col-sm-6 border-two-col good">
        <h4 class="eng subbold">Who needs to be concerned?</h4>
        <p>No one.</p>
        <h4 class="eng subbold">What should I do?</h4>
        <p>Hoorayy!! It’s a great day to be active outside</p> 
    </div>
    <div class="col-sm-6 good burmese">
        <h4 class="subbold">ဘယ်သူတွေ ဂရုစိုက်ရမလဲ</h4>
        <p>မည်သူမျှ ထိခိုက်နိုင်ခြင်းမရှိပါ</p>
        <h4 class="subbold">ကာကွယ်ဖို့ ဘာတွေလုပ်ရမလဲ</h4>
        <p>အပြင်မှာနေလို့ကောင်းတဲ့ နေ့လေးတစ်နေ့ပါ။</p>
    </div>
    @endif
    @if($category['level'] == 1)
    <div class="col-sm-6 border-two-col moderate">
        <h4 class="eng subbold">Who needs to be concerned?</h4>
        <p>Some people who may be unusually sensitive to particle pollution.</p>
        <h4 class="eng subbold">What should I do?</h4>
        <p><b>Unusually sensitive people:</b> Consider reducing prolonged or heavy exertion. Watch for symptoms such as coughing or shortness of breath. These are signs to take it easier. </p>
        <p> <b>Everyone else:</b> It’s a good day to be active outside.</p> 
    </div>
    <div class="col-sm-6 moderate burmese">
        <h4 class="subbold">ဘယ်သူတွေ ဂရုစိုက်ရမလဲ</h4>
        <p>လေထုထဲက အမှုန်အမွှားတွေနဲ့ ထိတွေ့လို့ အဆင်မပြေတဲ့လူတွေ</p>
        <h4 class="subbold">ကာကွယ်ဖို့ ဘာတွေလုပ်ရမလဲ</h4>
        <p>ရောဂါအခံရှိတဲ့လူတွေအတွက် ပြင်းထန်ပြီးတော့ ကြာရှည်တဲ့ လေ့ကျင့်ခန်းတွေလုပ်တာကို ရှောင်ရှားသင့်ပါတယ်။
            ချောင်းဆိုးတာနဲ့ အသက်ရှူကျပ်တာမျိုးလို လက္ခဏာတွေကိုလည်း သတိထားသင့်ပါတယ်။
            တခြားလူတွေအတွက်ကတော့ အပြင်မှာနေလို့အဆင်ပြေတဲ့နေ့လေးတစ်နေ့ပါ။</p>
    </div>
    @endif
    @if($category['level'] == 2)
    <div class="col-sm-6 border-two-col unhealtysensitive">
        <h4 class="eng subbold">Who needs to be concerned?</h4>
        <p>Sensitive groups include people with heart or lung disease, older adults, children, and teenagers.</p>
        <h4 class="eng subbold">What should I do?</h4>
        <p><b>Sensitive groups:</b> Reduce prolonged or heavy exertion. It’s OK to be active outside, but take more breaks and do less intense activities. Watch for symptoms such as coughing or shortness of breath.</p>
        <p><b>People with asthma</b> should follow their asthma action plans and keep quick relief medicine handy.</p> 
        <p><b>If you have heart disease:</b> Symptoms such as palpitations, shortness of breath, or unusual fatigue may indicate a serious problem if you have any of these, contact your healthcare provider.</p>
    </div>
    <div class="col-sm-6 unhealtysensitive burmese">
        <h4 class="subbold">ဘယ်သူတွေ ဂရုစိုက်ရမလဲ</h4>
        <p>အသက်ကြီးသူတွေ၊ နှလုံး ဒါမှမဟုတ် အဆုတ်ရောဂါ ရှိသူတွေနဲ့ ကလေးသူငယ်တွေ</p>
        <h4 class="subbold">ကာကွယ်ဖို့ ဘာတွေလုပ်ရမလဲ</h4>
        <p>ရောဂါအခံရှိတဲ့လူတွေအတွက် ပြင်းထန်ပြီးတော့ ကြာရှည်တဲ့လေ့ကျင့်ခန်းတွေလုပ်တာကို ရှောင်ရှားသင့်ပါတယ်။
            အပြင်မှာနေလို့အဆင်ပြေပေမယ့် နားချိန်ပိုယူပြီးတော့ သိပ်ပြီးမပင်ပန်းတာတွေကိုပဲ လုပ်သင့်ပါတယ်။
            ချောင်းဆိုးတာနဲ့ အသက်ရှူကျပ်တာမျိုးလို လက္ခဏာတွေကိုလည်း သတိထားသင့်ပါတယ်။
            ပန်းနာရင်ကြပ်ရှိတဲ့လူတွေအတွက်ကတော့ ကုထုံးအစီအစဉ်တွေကို လိုက်နာပြီး ဆေးအဆင်သင့် ဆောင်ထားသင့်ပါတယ်။ နှလုံးရောဂါရှိတဲ့လူတွေအတွက်ကတော့ မောပန်းခြင်း၊ အသက်ရှူကြပ်ခြင်းနဲ့ ရုတ်တရက်မောပန်းတာလိုမျိုး အရေးကြီးတဲ့လက္ခဏာတွေကို အထူးဂရုပြုသင့်ပါတယ်။ 
            ဒီလက္ခဏာတွေ ဖြစ်ပေါ်လာရင် ဆေးရုံ၊ ဆေးခန်းကို ဆက်သွယ်သင့်ပါတယ်။</p>
    </div>
    @endif
    @if($category['level'] == 3)
    <div class="col-sm-6 border-two-col unhealty">
        <h4 class="eng subbold">Who needs to be concerned?</h4>
        <p>Everyone</p>
        <h4 class="eng subbold">What should I do?</h4>
        <p><b>Sensitive groups:</b> Avoid prolonged or heavy exertion. Move activities indoors or reschedule to a time when the air quality is better.</p>
        <p><b>Everyone else: </b> Reduce prolonged or heavy exertion. Take more breaks during all outdoor activities.</p> 
    </div>
    <div class="col-sm-6 unhealty burmese">
        <h4 class="subbold">ဘယ်သူတွေ ဂရုစိုက်ရမလဲ</h4>
        <p>လူတိုင်း</p>
        <h4 class="subbold">ကာကွယ်ဖို့ ဘာတွေလုပ်ရမလဲ</h4>
        <p>ရောဂါအခံရှိတဲ့လူတွေအတွက် ပြင်းထန်ပြီးတော့ ကြာရှည်တဲ့လေ့ကျင့်ခန်းတွေလုပ်တာကို ရှောင်ရှားသင့်ပါတယ်။ 
            အလုပ်တွေကိုအိမ်ထဲမှာပဲလုပ်ပြီး အပြင်မှာလုပ်ရမယ့် အလုပ်တွေကို လေထုအရည်အသွေးကောင်းလာမှ ပြန်လုပ်သင့်ပါတယ်။ 
            ပုံမှန်လူတွေအတွက်ကတော့ ပြင်းထန်ပြီးတော့ ကြာရှည်တဲ့လေ့ကျင့်ခန်းတွေလုပ်တာကို ရှောင်ရှားသင့်ပါတယ်။ အနားလည်းမကြာခဏယူသင့်ပါတယ်။</p>
    </div>
    @endif
    @if($category['level'] == 4)
    <div class="col-sm-6 border-two-col veryunhealty">
        <h4 class="eng subbold">Who needs to be concerned?</h4>
        <p>Everyone</p>
        <h4 class="eng subbold">What should I do?</h4>
        <p><b>Sensitive groups:</b> Avoid all physical activity outdoors. Move activities indoors or reschedule to a time when air quality is better.</p>
        <p><b>Everyone else: </b> Avoid prolonged or heavy exertion. Consider moving activities indoors or rescheduling to a time when air quality is better.</p> 
    </div>
    <div class="col-sm-6 veryunhealty burmese">
        <h4 class="subbold">ဘယ်သူတွေ ဂရုစိုက်ရမလဲ</h4>
        <p>လူတိုင်း</p>
        <h4 class="subbold">ကာကွယ်ဖို့ ဘာတွေလုပ်ရမလဲ</h4>
        <p>ရောဂါအခံရှိတဲ့လူတွေ အိမ်အပြင်လုံး၀မထွက်မသင့်တော့ပါဘူး။ အပြင်မှာလုပ်ရမယ့် အလုပ်တွေကိုလည်း လေထုအရည်အသွေးကောင်းလာမှ ပြန်လုပ်သင့်ပါတယ်။
            ပုံမှန်လူတွေအတွက်ကတော့ ပြင်းထန်ပြီးတော့ ကြာရှည်တဲ့လေ့ကျင့်ခန်းတွေလုပ်တာကို ရှောင်ရှားသင့်ပါတယ်။ 
            အလုပ်တွေကိုအိမ်ထဲမှာပဲလုပ်ပြီး အပြင်မှာလုပ်ရမယ့် အလုပ်တွေကို လေထုအရည်အသွေးကောင်းလာမှ ပြန်လုပ်ဖို့ဆင်းစဉ်းစားသင့်ပါတယ်။</p>
    </div>
    @endif
    @if($category['level'] == 5)
    <div class="col-sm-6 border-two-col hazardous">
        <h4 class="eng subbold">Who needs to be concerned?</h4>
        <p>Everyone</p>
        <h4 class="eng subbold">What should I do?</h4>
        <p><b>Everyone:</b> Avoid all physical activity outdoors.</p>
        <p><b>Sensitive groups:</b> Sensitive groups: Remain indoors and keep activity levels low. Follow tips for keeping particle levels low indoors.</p> 
    </div>
    <div class="col-sm-6 hazardous burmese">
        <h4 class="subbold">ဘယ်သူတွေ ဂရုစိုက်ရမလဲ</h4>
        <p>လူတိုင်း</p>
        <h4 class="subbold">ကာကွယ်ဖို့ ဘာတွေလုပ်ရမလဲ</h4>
        <p>လူတိုင်းအပြင်မထွက်သင့်တော့ပါဘူး။</p>
        <p>ရောဂါအခံရှိတဲ့လူအတွက် အိမ်ထဲမှာဘဲနေပြီးတော့ အလုပ်ကို တတ်နိုင်သမျှလျော့လုပ်သင့်ပါတယ်။ 
            အိမ်တွင်းလေထုညစ်ညမ်းမှု လျော့ကျစေမည့်နည်းလမ်းများကိုလည်း လိုက်နာ ဆောင်ရွက်သင့်ပါတယ်။</p>
    </div>
    @endif
    <div class="col-sm-6 border-two-col"><p class="eng">You can read more about AQI and PM2.5 <a href="whatisaqi">here</a></p></div>
    <div class="col-sm-6"><p class="burmese">AQI နဲ့ PM2.5 အကြောင်းကို <a href="whatisaqi">ဒီမှာ</a> လေ့လာဖတ်ရှုလို့ရပါတယ်</p></div>
</div>
<div class="row border-top secondary-background">
    <div class="col-sm-6 border-two-col eng pt-3">
        <h4 class="subbold">
            How YangonAQI works?
        </h4>
        <p>
            YangonAQI works by taking data from <a href="https://www.purpleair.com">PurpleAir</a>'s sensors. There are 11 sensors currently in Yangon. We take raw PM2.5 values from each sensors, convert them to AQI and find average of these values. That way, we can show realtime AQI values to users.
        </p>
    </div>
    <div class="col-sm-6 burmese pt-3">
        <h4 class="subbold">
            Yangon AQI ဘယ်လိုအလုပ်လုပ်ပါသလဲ
        </h4>
        <p>
            YangonAQI works by taking data from <a href="https://www.purpleair.com">PurpleAir</a>'s sensors. There are 11 sensors currently in Yangon. We take raw PM2.5 values from each sensors, convert them to AQI and find average of these values. That way, we can show realtime AQI values to users.
        </p>
    </div>
</div>

@endsection