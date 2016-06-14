<!-- days container -->
<div class="" id="myDay">

    {{-- not to show the 1 day itinerary day details to public --}}
    @if(!$is_preview ||
        ($is_preview && $itinerary->days->count() > 1) )


    @foreach($itinerary->days($is_preview)->orderby('day_num')->get() as $day)

        @include('itineraryDay.partial_DayView')

            {{-- jquery tabs --}}
            <script>
                $("ol.route-day{{ $day->day_num }}").each(function(){
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

                        // Prevent the anchor's default click action
                        e.preventDefault();
                    });
                });
            </script>
    @endforeach  {{-- end Day foreach --}}
    @endif
</div><!-- #myDay -->



