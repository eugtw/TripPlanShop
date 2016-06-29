<!-- Swiper -->
<div  class="col-xs-12">
    <div id="gallery{{$day->day_num}}" style="display:none;">

        @foreach($day->photos as $photo)
            <img alt="{{ $photo->name }}" src="{{ asset($photo->photo_path) }}"
                 data-image="{{ asset($photo->photo_path)  }}"
                 data-description="">
        @endforeach


    </div>

    <script type="text/javascript">

        jQuery(document).ready(function(){
            jQuery("#gallery{{$day->day_num}}").unitegallery({
                gallery_theme: "grid",

                gallery_width:1800,							//gallery width
                gallery_height:900,
                gallery_min_height: 250,
                theme_panel_position: "right",
                theme_hide_panel_under_width: 480,
                gallery_autoplay:true,
                gallery_play_interval: 3000
            });
        });

    </script>
</div>
