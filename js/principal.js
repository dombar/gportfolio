var num = 50;

$(window).bind('scroll', function () {
    if ($(window).scrollTop() > num) {
        $('.navbar-fixed-top').css('top', 0);
    } else {
       //Quando o menu ficar fixo
        $('.navbar-fixed-top').css('top', 130); 
    }
});