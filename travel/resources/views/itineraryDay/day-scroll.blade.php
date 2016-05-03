<!-- day places -->

                <div class="col-xs-12 visible-xs">
                    <select id="day{{ $day->day_num }}" class="dayplace-select">
                        @foreach($day->places as $key => $place)
                            <option value="{{ $key }}"
                                    data-link="#day{{ $day->day_num }}-route{{($key+1)}}"
                                    data-imagesrc="/{{ $place->image_path }}"
                                    data-description=
                                    '<span class="route-extra mark"><i class="fa fa-map-marker" aria-hidden="true"></i></span><span  class="route-extra detail">{{ $place->place_name_short }}</span>
                                <span class="route-extra"><i class="fa fa-clock-o" aria-hidden="true"></i>{{ $place->duration }}</span>
                                <span class="route-extra"><i class="fa fa-usd" aria-hidden="true"></i>{{ $place->price_range }}</span>'>
                                {{$place->letterLabel() .' - '.  $place->place_title }}</option>
                        @endforeach
                    </select>

                </div>
