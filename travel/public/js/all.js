

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
                    swal({   title: "Error!",   type: "error",   confirmButtonText: "go back" });
                }
            });

        });
    e.preventDefault();
});
$(document).on('submit', 'form.ajaxForm', function(e) {
    e.preventDefault();


    var form = $(this);
    var method = form.find('input[name="_method"]').val() || 'POST';
    var url = form.prop('action');

    var $body = $("body");
    $body.addClass('loading');

    if( form.find('textarea[class="editor"]')){
        for( var i in CKEDITOR.instances){
            CKEDITOR.instances[i].updateElement();
        }
    }

    $.ajax({
        type: method,
        url: url,
        data: form.serialize()
    }).done(function() {
        /*
         swal({
         title: "Loading...",
         animation: false,
         timer: 500,
         showConfirmButton: false
         });*/
        //location.reload();
    }).fail(function(xhr, status, error) {
        alert("Error! Please refresh page");
        console.log("An AJAX error occured: " + status + "\nError: " + error);
    }).always(function() {
        $body.removeClass('loading');
    });

    $(document).ajaxStop(function () {
       location.reload();
    });
});
/*
$('form[data-remote]').on('submit', function(e){
    e.preventDefault();


    var form = $(this);
    var method = form.find('input[name="_method"]').val() || 'POST';
    var url = form.prop('action');

    alert(url);

    if( form.find('textarea[class="editor"]')){
        for( var i in CKEDITOR.instances){
            CKEDITOR.instances[i].updateElement();
        }
    }

    $.ajax({
        type: method,
        url: url,
        data: form.serialize()
    }).done(function() {
              /*
               swal({
               title: "Loading...",
               animation: false,
               timer: 500,
               showConfirmButton: false
               });*/
              //location.reload();
  /*  }).fail(function() {
          alert('error! please try again');
    });
});*/



$('form[data-confirm], button[data-confirm]').on('click', function(e) {
    var input = $(this);

    input.prop('disabled', 'disabled');

    if ( ! confirm(input.data('confirm'))) {
        e.preventDefault();
    };

    input.removeAttr('disabled');
});



//{{-- jquery tabs --}}

/*
$(document).ready(function(){
    $('ol.route-list-test').each(function(){
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
            initDropzone(id);
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

                //init dropzone
                if( $(this.hash).data('placeEdit') ) {
                   initDropzone(id);
                }

            }


            // Prevent the anchor's default click action
            e.preventDefault();
        });
    });


});*/


function initDropzone(pId)
{

  $("#dropzone-" + pId).dropzone(
      {
           maxFiles: 1,
           paramName: "place_image", // The name that will be used to transfer the file
           maxFilesize: 15, // MB
           acceptedFiles: '.jpg, .jpeg, .png',
           addRemoveLinks: true,
           dictDefaultMessage: 'Drop an image for this place or Google image will be used',
          init: function() {

              this.on("queuecomplete", function() {
                 // location.reload();
                  //var getPlaceUrl = '/itinerary-day/day-place/' + pId + '/edit';
                  var getPlaceUrl = '/itinerary-day/day-place/getPlaceData/' + pId;

                  $.get(getPlaceUrl, function(data) {
                      $('.place-nav-img.place-' + pId).attr('src', '/' + data['image_path']);
                  }).fail(function(){
                      alert('error! please refresh page');
                  });

              });
              this.on("removedfile", function(file) {
                  // if (!file.serverId) { return; }
                  var $loading = $('#loading');
                  $loading.show();

                  $.get("/iti-day-place-photo-delete/" + pId, function(data){
                      $('.place-nav-img.place-' + pId).attr('src', data['photo_ref_google']);
                  }).fail(function(){
                      alert('error!');
                  }).always(function() {
                    $loading.hide();
                  })
              });
          }
      });
}

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
    if(typeof place.photos !== 'undefined')
    {
        $('#place-' + placeId + '-photo_ref_google').val(place.photos[0].getUrl({ 'maxWidth': 626, 'maxHeight': 256 }));
    }


    //console.log(place.photos[0].getUrl({ 'maxWidth': 626, 'maxHeight': 256 }));

    $('#place_title').val(place.name);
    console.log(place.name);
    var open_hours;


    try {
        open_hours = place.opening_hours.weekday_text.join(", ");
    } catch(e) {
        open_hours = "N/A";
    }
    $('textarea[data-place-id="'+placeId+'"]').val(open_hours);


    // ajaxForm save doesnt save business_hours part, maybe it's becuase async
    var form = $('form.pid-' + placeId);
    var method = form.find('input[name="_method"]').val() || 'POST';
    var url = form.prop('action');

    $.ajax({
        type: method,
        url: url,
        data: form.serialize()
    }).done(function() {

    }).fail(function() {
        alert('error! please try again');
    });
}



//select2
$('select.select2').each(function(){
    $(this).select2({
        maximumSelectionLength: $(this).data('maxSelected'),
        tags: true
    });
});

/*
//init ckeditor
CKEDITOR.replaceAll( 'editor',{

    uiColor : '#9AB8F3'
});*/

$(document).ready(function(){
    $('a[data-day-img-delete]').click(function(e){

        e.preventDefault();

        var url = $(this).attr('href');
        var element = $(this);

        var $body = $("body");
        //$body.addClass("loading");

        $.get(url, function(data) {
            element.parent().fadeOut();
        }).fail(function() {
            alert('error! please try again');
        });/*.always(function() {
                $body.removeClass("loading");
        });*/




        // if (!file.serverId) { return; }

/*
        $.get("/iti-day-place-photo-delete/" + pId, function(data){
            $('.place-nav-img.place-' + pId).attr('src', data['photo_ref_google']);
        }).fail(function(){
            alert('error!');
        }).always(function() {
            $loading.hide();
        })*/
    });
});


//day-place edit ajax
$(document).ready(function() {

    Dropzone.autoDiscover = false;

    $('ol.route-list.edit-mode li a').click(function(e) {
       
        e.preventDefault();

        var _page_ajax_pre_load = function() {
            if (typeof CKEDITOR !== 'undefined') {
                for (var instanceName in CKEDITOR.instances) {
                    if (typeof CKEDITOR.instances[instanceName] !== 'undefined' && instanceName != 'dayEditor') {
                        CKEDITOR.instances[instanceName].destroy();
                    }
                }
            }
        };

        var $clickedPlace = $(this);
        $('ol.route-list.edit-mode li a.active').removeClass('active');
        $clickedPlace.addClass('active');

        var pId = $clickedPlace.attr('href').split('-')[1];
        var url = '/itinerary-day/day-place/' + pId + '/edit';
        var currentDayDiv =  $clickedPlace.parents("div.dayEdit");

        var $body = $("body");
        $body.addClass("loading");


        $.get({
            url: url,
            timeout: 20000
        }).done(function(data) {

            _page_ajax_pre_load();

            currentDayDiv.children(".dayPlace").html(data);

            CKEDITOR.replaceAll('editor',{
                uiColor : '#9AB8F3'
            });

            if(pId){
                initPlaceMap(pId);
                initDropzone(pId);
            }

            $('select.select2').select2({
                maximumSelectionLength: $clickedPlace.data('maxSelected'),
                tags: true
            });
        }).fail(function(xhr, status, error) {
            alert("Error! Please refresh page");
            console.log("An AJAX error occured: " + status + "\nError: " + error);
        }).always(function() {
            $body.removeClass("loading");
        });

    });

    $("ol.route-list.edit-mode li:first-child a").each(function() {
        $(this).trigger("click");
    });


});

/**
 *
 */
//day-place view ajax
$(document).ready(function() {

    var api = {};
    //var dayId = [];

    $('ol.route-list.view-mode').each(function() {

        var $day = $(this);
        var dayId = $day.data('dayid');

        $("ol.route-list.view-mode.day"+dayId+" li a").click(function(e) {

            e.preventDefault();

            var $clickedPlace = $(this);
            $("ol.route-list.view-mode.day"+dayId+" li a.active").removeClass('active');
            $clickedPlace.addClass('active');


            var pId = $clickedPlace.attr('href').split('-')[1];
            var url = '/itinerary-day/day-place/' + pId;
            var currentDayDiv =  $clickedPlace.parents("div.dayView");

            var $body = $("body");
            $body.addClass("loading");

            //cacheing
            if(!api[pId]) {
                api[pId] = $.get({
                    url: url,
                    timeout: 20000
                }) }

            api[pId].done(function(data) {
                currentDayDiv.children(".dayPlace").html(data);
            }).fail(function(xhr, status, error) {
                //reset this place cache if fails
                delete api[pId];
                alert("Error! Please refresh page");
                console.log("An AJAX error occured: " + status + "\nError: " + error);
            }).always(function() {
                $body.removeClass("loading");
            });

        });
    });

    $("ol.route-list.view-mode li:first-child a").each(function() {
        $(this).trigger("click");
    });
});


//iti overview edit
$(document).ready(function() {
    $("#iti-photo-dropzone").dropzone({
        dictDefaultMessage: 'Click to upload new cover image',
        paramName: "iti_image", // The name that will be used to transfer the file
        maxFilesize: 99, // MB
        acceptedFiles: '.jpg, .jpeg, .png',
        maxFiles: 1,
        init: function(file) {
            this.on("queuecomplete", function() {
                location.reload();
            });
        }
    });
});