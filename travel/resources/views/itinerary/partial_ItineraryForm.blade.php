<div class="form-group">
    {!! Form::label('title', 'Title', ['class'=>'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
        {!! Form::text('title', null, ['placeholder' => 'Itinerary Title','class'=>'form-control', 'autocomplete'=>'off']) !!}
    </div>
</div>


<div class="form-group">
    {!! Form::label('price', 'Sales Price (USD)', ['class'=>'col-sm-3 control-label']) !!}
    <div class="col-sm-9" id="itit-price-block">
        <div class="col-sm-2">
            {!! Form::radio('free', '1', ( (isset($itinerary)&&$itinerary->price==0) ? true : false), ['id' => 'free']) !!} free
        </div>
        <div class="col-sm-10">
            {!! Form::radio('free', '0', ( (isset($itinerary)&&$itinerary->price!=0) ? true : false), ['id' => 'not-free']) !!} Set a Price
            {!! Form::text('price', null, ['class'=>'text-center', 'placeholder' => '$'.env('ITI_MIN_PRICE').' - $'.env('ITI_MAX_PRICE'), 'autocomplete'=>'off', 'id'=>'itit-price']) !!}
            <p hidden="hidden" id="itit-price-desc">{{ '$'.env('ITI_MIN_PRICE').' - $'.env('ITI_MAX_PRICE') .' ***all taxes included***' }}</p>


        </div>
    </div>
</div>
<div class="form-group">
    {!! Form::label('best_season', 'Best Time to Visit', ['class'=>'col-sm-3 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::text('best_season', null, ['placeholder' => 'best time to travel, ex: March - September','class'=>'form-control', 'autocomplete'=>'off']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('styles_list', 'Travel Style (max: '.env('MAX_STYLE_TAG').')', ['class'=>'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
        {!! Form::select('styles_list[]', $travelStyles, null, ['multiple' => 'multiple','class'=>'form-control', 'id' => 'style_list']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('autocomplete', 'Destination City (max: '.env('ITI_MAX_CITY').')',['class'=>'col-sm-3 control-label']) !!}
    <div class="col-sm-6">
        {!! Form::text('autocomplete', null,['placeholder'=>'Enter a City','class'=>'form-control', 'autocomplete'=>'off', 'onFocus'=>'geolocate()']) !!}
    </div>
    <div class="">
        <a class="" id="addCity">add city &raquo;</a>
    </div>
</div>
<div class="form-group">
    {!! Form::label('cities_list', '',['class'=>'sr-only col-sm-3 control-label']) !!}
    <div class="col-sm-6">
        {!! Form::select('cities_list[]',isset($itinerary) ? $itinerary->getCitiesListFullAttribute() : [],
                        isset($itinerary) ? $itinerary->getCitiesListFullAttribute() : null,
                        ['multiple'=>'multiple','class'=>'form-control', 'id'=>'city_list']) !!}
    </div>
    <div class="">
        <a href="JavaScript:void(0);" id="btn-remove">&laquo; remove city</a>
    </div>
</div>






<div class="form-group">
    {!! Form::label('region_id', 'Region', ['class'=>'col-sm-3 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::select('region_id',$regions, null, ['placeholder' => 'Region','class'=>'form-control']) !!}
    </div>
</div>


<div class="pull-right" hidden="true">
    {!! Form::label('top_places', '', ['class'=>'sr-only']) !!}
    {!! Form::text('top_places', null, ['id'=>'top_places','class'=>'form-control', 'autocomplete'=>'off']) !!}
</div>

<div class="form-group">
    {!! Form::label('topplaces', 'Top Places of this itinerary (max: '.env('ITI_MAX_TOPPLACES').')', ['class'=>'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
        <div class="col-sm-3 col-xs-12">
            {!! Form::label('top-place', '', ['class'=>'sr-only']) !!}
            {!! Form::text('top-place', null, ['id'=>'top-place', 'placeholder'=>'1st place','class'=>'col-sm-3 form-control']) !!}
        </div>

        <div class="col-sm-3 col-xs-12">
            {!! Form::label('top-place1', '', ['class'=>'sr-only']) !!}
            {!! Form::text('top-place1', null, ['id'=>'top-place1', 'placeholder'=>'2nd','class'=>'form-control']) !!}
        </div>

        <div class="col-sm-3 col-xs-12">
            {!! Form::label('top-place2', '', ['class'=>'sr-only']) !!}
            {!! Form::text('top-place2', null, ['id'=>'top-place2', 'placeholder'=>'3rd','class'=>'form-control']) !!}
        </div>

        <div class="col-sm-3 col-xs-12">
            {!! Form::label('top-place3', '', ['class'=>'sr-only']) !!}
            {!! Form::text('top-place3', null, ['id'=>'top-place3', 'placeholder'=>'4th','class'=>'form-control']) !!}
        </div>

        <div class="col-sm-3 col-xs-12">
            {!! Form::label('top-place4', '', ['class'=>'sr-only']) !!}
            {!! Form::text('top-place4', null, ['id'=>'top-place4', 'placeholder'=>'5th','class'=>'form-control']) !!}
        </div>
        <div class="col-sm-3 col-xs-12">
            {!! Form::label('top-place5', '', ['class'=>'sr-only']) !!}
            {!! Form::text('top-place5', null, ['id'=>'top-place5', 'placeholder'=>'6th','class'=>'form-control']) !!}
        </div>
        <div class="col-sm-3 col-xs-12">
            {!! Form::label('top-place6', '', ['class'=>'sr-only']) !!}
            {!! Form::text('top-place6', null, ['id'=>'top-place6', 'placeholder'=>'7th','class'=>'form-control']) !!}
        </div>
        <div class="col-sm-3 col-xs-12">
            {!! Form::label('top-place7', '', ['class'=>'sr-only']) !!}
            {!! Form::text('top-place7', null, ['id'=>'top-place7', 'placeholder'=>'8th','class'=>'form-control']) !!}
        </div>
    </div>
</div>





<table id="address" class="pull-right" hidden="true">
    <tr>
        <td class="label">City</td>
        <td class="wideField" colspan="3"><input class="field" id="locality"
                                                 disabled="true"></td>
    </tr>
    <tr>
        <td class="label">State</td>
        <td class="slimField"><input class="field"
                                     id="administrative_area_level_1" disabled="true"></td>
    </tr>
    <tr>
        <td class="label">Country</td>
        <td class="wideField" colspan="3"><input class="field"
                                                 id="country" disabled="true"></td>
    </tr>
</table>



<div class="form-group">

    {!! Form::label('', 'Itinerary Features (What\'s included?)',['class'=>'col-sm-3 control-label']) !!}

    {{-- checked checkboxs ids are stored as a string with ',' as delimiter. --}}
    {{-- And then converted back to array in FormBuilder -> getCheckboxCheckedState--}}

    <div class="col-sm-9">
        <div class="items-list-form-box">
            <fieldset class="group">
                <ul class="list-unstyled">
                    @foreach($items as $key => $i)
                        @if($key == 0)
                            <span class="info-block-subtitle">General</span>
                        @elseif($key == 5)
                            <span class="info-block-subtitle">Recommendations</span>
                        @elseif($key == 9)
                            <span class="info-block-subtitle">Destinations</span>
                        @endif
                        <li>
                            <label>
                                {!! Form::checkbox('items_list[]', $i->id) !!}
                                {{$i->item}}
                            </label>
                        </li>
                    @endforeach
                </ul>
            </fieldset>
        </div>
    </div>
</div>

<div class="form-group">
    {!! Form::label('summary', 'Itinerary Summary (text only)', ['class'=>'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
        {!! Form::textarea('summary', null, ['placeholder' => 'type your itinerary summary here','class'=>'form-control']) !!} </div>
</div>

<div class="form-group">
    {!! Form::label('gallery_folder_name', 'Gallery Folder: ', ['class'=>'col-sm-3 control-label']) !!}
    <div class="col-sm-5">
        {!! Form::text('gallery_folder_name', null, ['placeholder'=>'','class'=>'form-control']) !!}
    </div>
        <button class="btn btn-info popup_selector" data-inputid="gallery_folder_name" type="button"
                data-toggle="tooltip" data-placement="right" data-html="true" title="{{ env('ITI_COVER_IMG_BTN') }}">
            Select Gallery Folder</button>
</div>

<div class="form-group">

    {!! Form::label('image', 'Cover Image: ', ['class'=>'col-sm-3 control-label']) !!}
    <div class="col-sm-5">
        {!! Form::text('image', null, ['placeholder'=>'use default image if left empty','class'=>'form-control']) !!}
    </div>
        <button class="btn btn-info popup_selector" data-inputid="image" type="button"
                data-toggle="tooltip" data-placement="right" data-html="true" title="{{ env('ITI_COVER_IMG_BTN') }}">
            Select Cover Image</button>
</div>


//select2 max selected items
<script src="/js/select2/select2.min.js"></script>
<script>
    $('#style_list').select2({
        maximumSelectionLength: '{{ env('MAX_STYLE_TAG') }}',
        tags: true
    });
</script>

<script src="{{ asset('/packages/barryvdh/elfinder/js/standalonepopup.js') }}">
    //standalone elfinder
</script>
<script>
    //hide show price div
    $('#not-free').click(function(){
       $('#itit-price').show();
        $('#itit-price-desc').show();
    });
    $('#free').click(function(){
        $('#itit-price').hide();
        $('#itit-price-desc').hide();
    });



    //when 'Add' cliced, move google autocomplted city, state, country, to list box
    $('#addCity').click(function(){
        if($('#locality').val() != '')
        {
            var city = $('#locality').val();

            $('#city_list').append("<option value='"
            +$('#locality').val()+','+$('#administrative_area_level_1').val()+','+$('#country').val()+"'>"
            +$('#locality').val()+','+$('#administrative_area_level_1').val()+','+$('#country').val()+"</option>");
            $('#autocomplete').val('');
        }

    });


    $(document).ready(function() {

        //tooltip init
        $('[data-toggle="tooltip"]').tooltip()

        //remove selected city from city list when "remove" btn pressed
        $('#btn-remove').click(function(){
            $('#city_list option:selected').each( function() {
                $(this).remove();
            });
        });

       //top places, using jQuery to insert values from 'top_places' to top-place[]
       if($('#top_places').val() != '')
       {
           var topP = $('#top_places').val();
           var topPArr = topP.split(",");
           $('#top-place').val($.trim(topPArr[0]));
           for(i = 1; i < 9; i++){
               $('#top-place'+ i).val($.trim(topPArr[i]));
           }
       }

        //form submit
        $('#itit-form').submit(function(){
            //select all listed cities
            $('#city_list option').prop('selected', true);

            //combine all 8 topplaces[] to string 'top_places' in case validation fails and page bounce back for re-enter
            $('#top_places').val('');
            if($('#top-place').val() != '')
            {
                $('#top_places').val($('#top-place').val());
            }

            for(i = 1; i < 9; i++) {

                if( $('#top-place' + i).length > 0 && $('#top-place' + i).val() != '' )
                {
                    if($('#top_places').val() == '')
                    {
                        //initial value if 1st top-place has no input
                        $('#top_places').val($('#top-place' + i).val());
                    }else{
                        $('#top_places').val($('#top_places').val()+',' + $('#top-place' + i).val());
                    }
                }
            }
        });

    });
</script>
<script>
    // This example displays an address form, using the autocomplete feature
    // of the Google Places API to help users fill in the information.

    var placeSearch, autocomplete;
    var componentForm = {
        locality: 'long_name',
        administrative_area_level_1: 'long_name',
        country: 'long_name'
    };

    function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
                {types: ['(cities)']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);

    }

    // [START region_fillform]
    function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        for (var component in componentForm) {
            document.getElementById(component).value = '';
            document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            if (componentForm[addressType]) {
                var val = place.address_components[i][componentForm[addressType]];
                document.getElementById(addressType).value = val;
            }
        }


    }
    // [END region_fillform]

    // [START region_geolocation]
    // Bias the autocomplete object to the user's geographical location,
    // as supplied by the browser's 'navigator.geolocation' object.
    function geolocate() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var geolocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                var circle = new google.maps.Circle({
                    center: geolocation,
                    radius: position.coords.accuracy
                });
                autocomplete.setBounds(circle.getBounds());
            });
        }
    }
    // [END region_geolocation]

</script>
<script src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_API_KEY')}}&signed_in=true&libraries=places&callback=initAutocomplete"
        async defer></script>