$(window).scroll(function() {

    if ($(window).scrollTop() >= 180) {
        $('.navbar').css("padding-top", "0");
        $('.logo').css("width", "45%")
    }
    else if($(window).scrollTop() <= 50) {
        $('.navbar').css("padding-top", "");
        $('.logo').css("width", "")
    }
})