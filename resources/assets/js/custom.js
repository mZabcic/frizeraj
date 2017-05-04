$( document ).ready(function() {
    var location = window.location.pathname;
    $('.nav-item').each(function(){
        if ($(this).attr('href') == location) {
            $(this).addClass('is-active');
        } else if ($(this).attr('href') != location && $(this).hasClass('is-active')){
            $(this).removeClass('is-active');
        };
    })
});