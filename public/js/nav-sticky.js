$(window).scroll(function() {
    if ($(window).scrollTop() >= 200) {
        $('.navbar').css("padding-top", "0");
        $('.logo').css("width", "45%")
    }
    else if($(window).scrollTop() < 120) {
        $('.navbar').css("padding-top", "");
        $('.logo').css("width", "")
    }
})