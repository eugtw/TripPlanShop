<!-- Modal header search bar for mobile view only -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                {!! Form::open(['url'=>'itinerary-search','method'=>'GET']) !!}
                <div class="form-group">
                    {!! Form::label('style_list_mobile', 'Style') !!}
                    {!! Form::select('style_list_mobile[]', (['any'=>'any style'] +$travelStyles), 1,['id'=>'style_list_mobile', 'class'=>'form-control style_list_mobile', 'multiple'=>'multiple']) !!}
                </div>
                <div class="form-group">
                    <label for="location_mobile">City</label>
                    <input name="location_mobile" type="text" class="form-control" id="autocomplete_mobile" placeholder="any city" onfocus="geolocate()">
                </div>
                <div class="form-group">
                    {!! Form::label('country_mobile', 'Country') !!}
                    {!! Form::select('country_mobile', (['any'=>'any country'] +$travelCountries), 1,['class'=>'form-control']) !!}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                {!! Form::submit('SEARCH', ['class'=>'btn btn-primary', 'id'=>'iti-search-btn-mobile']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>