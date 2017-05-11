$( document ).ready(function() {
    var location = window.location.pathname;
    if (location.includes('admin') ) {
            $('#admin-control').addClass('is-active');
            $('.admin-menu').each(function(){
                if ($(this).attr('href') == location) {
                    $(this).parent().addClass('is-active'); 
                } else {
                    $(this).parent().removeClass('is-active'); 
                }
            })
        };
    $('.nav-item.is-active').removeClass('is.active');
    $('.nav-item').each(function(){
        if ($(this).attr('href') == location) {
            $(this).addClass('is-active');
        };
    })
});


$( document ).ready(function() {
    if ($('#Rola').val() !== undefined){
    if ($('#Rola').val().length == 0) {
        $('#Rola').val($('#uloga').val());
    } else {
        $('#uloga').val($('#Rola').val())
    }
    }
   $('#uloga').on('change', function() {
       $('#Rola').val($('#uloga').val());
   });
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
    });
    $('#app_errors').each(function(){
         toastr["error"]($(this).val());
    });

});


confirmDelete = function(id) {
    var r = confirm("Jeste li sigurni da želite obrisati korisnika?");
    if (r == true) {
        document.getElementById(id).submit();
    } else {
        toastr["error"]('Morate potvrditi brisanje!');
    }
}
//# sourceMappingURL=all.js.map
