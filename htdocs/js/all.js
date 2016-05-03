
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



//{{-- jquery tabs --}}
$(document).ready(function(){
    $('ol.route-list').each(function(){
        // For each set of tabs, we want to keep track of
        // which tab is active and its associated content
        var $active, $content, $links = $(this).find('a');

        // If the location.hash matches one of the links, use that as the active tab.
        // If no match is found, use the first link as the initial active tab.
        $active = $($links.filter('[href="'+location.hash+'"]')[0] || $links[0]);
        $active.addClass('active');

        $content = $($active[0].hash);

        // Hide the remaining content
        $links.not($active).each(function () {
            $(this.hash).hide();
        });

        // Bind the click event handler
        $(this).on('click', 'a', function(e){
            // Make the old tab inactive.
            $active.removeClass('active');
            $content.hide();

            // Update the variables with the new link and content
            $active = $(this);
            $content = $(this.hash);

            // Make the tab active.
            $active.addClass('active');
            $content.show();

            //id passed in from dayEdit page
            var id = $(this.hash).data('placeId');
            if(id){
                google.maps.event.trigger(maps[id], 'resize');
                maps[id].setCenter(markers[id].getPosition());

               /* google.maps.event.trigger(window['map'+id], 'resize');
                window['map'+id].setCenter(window['marker'+id].getPosition());*/
            }


            // Prevent the anchor's default click action
            e.preventDefault();
        });
    });
});



//select2
$('select.select2').each(function(){
    $(this).select2({
        maximumSelectionLength: $(this).data('maxSelected'),
        tags: true
    });
});