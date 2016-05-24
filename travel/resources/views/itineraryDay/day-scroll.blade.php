<!-- day places -->

                <div class="col-xs-12 visible-xs">
                    <select id="day{{ $day->day_num }}" class="">
                        @foreach($day->places as $key => $place)
                            <option value="{{ $key }}"
                                    data-link="#day{{ $day->day_num }}-route{{($key+1)}}"
                                    data-imagesrc="/{{ $place->image_path }}"
                                    data-description=
                                '<span class="dayplace-select-info"><i class="fa fa-map-marker" aria-hidden="true"></i><span  class="detail">{{ $place->place_name_short }}</span></span>
                                <span class="dayplace-select-info"><i class="fa fa-clock-o" aria-hidden="true"></i>{{ $place->duration }}</span>'>
                                {{$place->letterLabel() .' - '.  $place->place_title }}</option>
                        @endforeach
                    </select>

                </div>
