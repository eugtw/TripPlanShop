<div id="floating-panel" class="form-group row">
    <div class="col-xs-9">
        <input id="place-{{$place->id}}-address" class="form-control " type="textbox" value="{{ $place->place_name_long }}">
    </div>
    <div class="col-xs-3">
        <input id="place-{{$place->id}}-submit" class="form-control btn btn-info" type="button" value="Find">
    </div>

</div>
<div class="clearfix"></div>
<div id="place-{{$place->id}}-Map" class="placeMap" data-place-id="{{$place->id}}">


</div>


