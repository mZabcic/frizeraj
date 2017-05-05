$( document ).ready(function() {
    var location = window.location.pathname;
    $('.nav-item.is-active').removeClass('is.active');
    $('.nav-item').each(function(){
        if ($(this).attr('href') == location) {
            $(this).addClass('is-active');
        };
    })
});


//Notifications
$( document ).ready(function() {
    toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": false,
  "progressBar": true,
  "positionClass": "toast-bottom-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "200",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
    $('#notification').each(function(){
         toastr["success"]($(this).val());
    })
});
//# sourceMappingURL=all.js.map
