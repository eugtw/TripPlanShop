<div class="placeMapDiv">
    <input id="place-{{$place->id}}-addressBar" class="placeEditMapControl col-xs-8" type="textbox" value="{{ $place->place_name_long }}">
    <div id="place-{{$place->id}}-Map" class="placeMap" data-place-id="{{$place->id}}"></div>
</div>


