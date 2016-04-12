<div class="form-group">
    {!! Form::label('cities_list', 'Selected Cities',['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::select('cities_list[]', ['default' => '' ], null,['multiple' => 'multiple','class'=>'form-control', 'id'=>'city_list']) !!}
        <a href="JavaScript:void(0);" id="btn-remove">&laquo; Remove</a>
    </div>
</div>



<div id="header-search">
    <div>
        {!! Form::open(['url'=>'itinerary/search','class'=>'']) !!}

        {!! Form::label('countryName', 'Country Select',['hidden'=>'true']) !!}
        {!! Form::select('countryName', (['any'=>'any country'] +$countries), 1) !!}

        {!! Form::text('location', null,['placeholder'=>'any city','id' => 'autocomplete', 'onFocus'=>'geolocate1()']) !!}

        {!! Form::label('style_list', 'Style Select',['hidden'=>'true']) !!}
        {!! Form::select('style_list', (['any'=>'any style'] +$styles), 1,['id'=>'style_list', 'class'=>'style_list']) !!}


        {!! Form::submit('SEARCH', ['class'=>'', 'id'=>'iti-search-btn']) !!}

        {!! Form::close() !!}
    </div>
</div>