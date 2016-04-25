<!-- Swiper -->
<div  class="col-xs-12">
    <div id="gallery{{$day->day_num}}" style="display:none;">

        @foreach($day->photos as $photo)
            <img alt="{{ $photo->name }}" src="/{{ $photo->photo_path }}"
                 data-image="/{{ $photo->photo_path }}"
                 data-description="">
        @endforeach


    </div>

    <script type="text/javascript">

        jQuery(document).ready(function(){
            jQuery("#gallery{{$day->day_num}}").unitegallery({
                gallery_theme: "grid",


                theme_panel_position: "right",
                theme_hide_panel_under_width: 480
            });
        });

    </script>
</div>
