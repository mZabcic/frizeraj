$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function omiljeni(id) {
    $.ajax({
            type: "POST",
            url: '/frizer/' + id + '/omiljeni',
            data: "csrf-token=" + window.Laravel.csrfToken,
            success: function(response) {
                if (response == "1") {
                    //dodat promjenu zvjezdice
                    toastr.success('Odabrali ste omiljenog frizera!');
                } else {
                    toastr.error('Greška!');
                }
              }
            });

    }
