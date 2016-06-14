

jQuery("#sticky").sticky({topSpacing:0});

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

    if( form.find('textarea[class="editor"]')){
        for( var i in CKEDITOR.instances){
            CKEDITOR.instances[i].updateElement();
        }
    }

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
        var id = $($active[0].hash).data('placeId');
        if(id){
            initPlaceMap(id);
        }

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
                initPlaceMap(id);
            }

            //init dropzone

            // Prevent the anchor's default click action
            e.preventDefault();
        });
    });


});


function initPlaceMap(pId) {
    var marker;
    var default_location = {lat: 59.327, lng: 18.067};
    var LngLat = default_location;
    var loc_lat = $('#place-' + pId + '-lat').val();
    var loc_lng = $('#place-' + pId + '-lng').val();

    if(loc_lat != '' && loc_lng != '')
    {
        LngLat = new google.maps.LatLng(loc_lat, loc_lng);
    }

    var map = new google.maps.Map(document.getElementById('place-' + pId + '-Map'), {
        zoom: 13,
        scrollwheel: true,
        scaleControl: true,
        center: LngLat

    });

    var geocoder = new google.maps.Geocoder();



    if(loc_lat != '' && loc_lng != '')
    {
        marker = new google.maps.Marker({
            animation: google.maps.Animation.DROP,
            position: LngLat,
            map: map,
            draggable: true
        });

        (function(id){
            return function() {
                google.maps.event.addListener(marker, 'dragend', function() {
                    //updateMarkerStatus('Drag ended');
                    geoPosition(marker.getPosition(), geocoder, id);
                });
            }()
        })(pId);
    }


    setMapListener(pId, map, marker);
}
function setMapListener(pId, map, marker){

    var input = /** @type {!HTMLInputElement} */(
        document.getElementById('place-' + pId + '-addressBar'));
    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.bindTo('bounds', map);


    var infowindow = new google.maps.InfoWindow();
    var service = new google.maps.places.PlacesService(map);

    autocomplete.addListener('place_changed', function() {
        infowindow.close();
        var place = autocomplete.getPlace();
        service.getDetails({
            placeId: place.place_id
        }, function(place, status) {
            if (status === google.maps.places.PlacesServiceStatus.OK) {

                if ( marker ) {
                    //if marker already was created change positon
                    marker.setPosition(place.geometry.location);
                } else {
                    //create a marker
                    marker = new google.maps.Marker({
                        position: place.geometry.location,
                        map: map
                        //draggable: true
                    });
                }
                map.setCenter(marker.getPosition());

                //update form
                updateInputs(pId, place);


                google.maps.event.addListener(marker, 'click', function() {
                    infowindow.setContent(
                        '<div class="placeMarker">' +
                        '<p class="title">' + place.name + '</p>' +
                        '<ul class="list-unstyled">'+
                        '<li><i class="fa fa-map-marker" aria-hidden="true"></i>' + place.formatted_address + '</li>' +
                        '</ul>'+
                        '</div>'
                    );
                    infowindow.open(map, this);
                });
            }
        });
    });
}
function updateInputs(placeId, place){
    //var address_short = '';

    $('#place-' + placeId + '-addressBar').val(place.formatted_address);
    $('#place-' + placeId + '-lat').val(place.geometry.location.lat());
    $('#place-' + placeId + '-lng').val(place.geometry.location.lng());
    //$('#place-' + placeId + '-name-short').val(address_short);
    $('#place-' + placeId + '-formatted_address').val(place.formatted_address);
    $('#place-' + placeId + '-website').val(place.website);
    $('#place-' + placeId + '-photo_ref_google').val(place.photos[0].getUrl({ 'maxWidth': 626, 'maxHeight': 256 }));

    //console.log(place.photos[0].getUrl({ 'maxWidth': 626, 'maxHeight': 256 }));

    $('div[data-place-id="'+placeId+'"] #place_title').val(place.name);

    var open_hours;

    try {
        open_hours = place.opening_hours.weekday_text.join(", ");
    } catch(e) {
        open_hours = "N/A";
    }

    $('div[data-place-id="'+placeId+'"] #business_hours').val(open_hours);
}



//select2
$('select.select2').each(function(){
    $(this).select2({
        maximumSelectionLength: $(this).data('maxSelected'),
        tags: true
    });
});


//init ckeditor
CKEDITOR.replaceAll( 'editor',{

    uiColor : '#9AB8F3'
});

