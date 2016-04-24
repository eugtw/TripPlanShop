
$('form[data-delete]').on('submit', function(e){
    var form = $(this);
    var method = form.find('input[name="_method"]').val() || 'POST';
    var url = form.prop('action');

    swal({   title: "Are you sure?",
            text: "",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        },
        function(){

            $.ajax({
                type: method,
                url: url,
                data: form.serialize(),
                success: function() {

                    swal({
                        title: "Deleting...",
                        timer: 500,
                        showConfirmButton: false
                    });
                    location.reload();

                },
                error: function() {
                    swal({   title: "Error!",   text: "Here's my error message!",   type: "error",   confirmButtonText: "Cool" });
                }
            });

        });
    e.preventDefault();
});

$('form[data-remote]').on('submit', function(e){
    var form = $(this);
    var method = form.find('input[name="_method"]').val() || 'POST';
    var url = form.prop('action');


    $.ajax({
        type: method,
        url: url,
        data: form.serialize(),
        success: function() {

            swal({
                title: "Loading...",
                animation: false,
                timer: 500,
                showConfirmButton: false
            });
            location.reload();
        }
    });

    e.preventDefault();
});



$('form[data-confirm], button[data-confirm]').on('click', function(e) {
    var input = $(this);

    input.prop('disabled', 'disabled');

    if ( ! confirm(input.data('confirm'))) {
        e.preventDefault();
    };

    input.removeAttr('disabled');
});


