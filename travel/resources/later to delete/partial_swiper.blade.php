<!-- Swiper -->
<div  class="col-xs-12">
    <div id="gallery{{$day->day_num}}" style="display:none;">

        <img alt="Image 1 Title" src="http://lorempixel.com/1200/1200/nature/1"
             data-image="http://lorempixel.com/1200/1200/nature/1"
             data-description="Image 1 Description">

        <img alt="Image 2 Title" src="http://lorempixel.com/1200/1200/nature/2"
             data-image="http://lorempixel.com/1200/1200/nature/2"
             data-description="Image 2 Description">
        <img alt="Image 2 Title" src="http://lorempixel.com/1200/1200/nature/3"
             data-image="http://lorempixel.com/1200/1200/nature/3"
             data-description="Image 3 Description">
        <img alt="Image 2 Title" src="http://lorempixel.com/1200/1200/nature/4"
             data-image="http://lorempixel.com/1200/1200/nature/4"
             data-description="Image 4 Description">
        <img alt="Image 2 Title" src="http://lorempixel.com/1200/1200/nature/5"
             data-image="http://lorempixel.com/1200/1200/nature/5"
             data-description="Image 5 Description">
        <img alt="Image 2 Title" src="http://lorempixel.com/1200/1200/nature/6"
             data-image="http://lorempixel.com/1200/1200/nature/6"
             data-description="Image 6 Description">

    </div>
    <script type="text/javascript">

        jQuery(document).ready(function(){
            jQuery("#gallery{{$day->day_num}}").unitegallery({
                gallery_theme: "grid",
                theme_panel_position: "right",
                gallery_width:"100%"
            });
        });

    </script>
</div>



<div id="swiper" class="col-xs-12">
    <div class="swiper-container gallery-top swiper{{$day->day_num}}-top">
        <div class="swiper-wrapper">
            <div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/1)"></div>
            <div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/2)"></div>
            <div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/3)"></div>
            <div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/4)"></div>
            <div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/5)"></div>
            <div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/6)"></div>
            <div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/7)"></div>
            <div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/8)"></div>
            <div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/9)"></div>
            <div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/10)"></div>
        </div>
        <!-- Add Arrows -->
        <div class="swiper-button-next swiper-button-white"></div>
        <div class="swiper-button-prev swiper-button-white"></div>
    </div>
    <div class="swiper-container gallery-thumbs swiper{{$day->day_num}}-thumbs">
        <div class="swiper-wrapper">
            <div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/1)"></div>
            <div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/2)"></div>
            <div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/3)"></div>
            <div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/4)"></div>
            <div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/5)"></div>
            <div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/6)"></div>
            <div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/7)"></div>
            <div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/8)"></div>
            <div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/9)"></div>
            <div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/10)"></div>
        </div>
    </div>
</div>
<!-- Initialize Swiper -->
<script>
    var galleryTop{{$day->day_num}} = new Swiper('.swiper{{$day->day_num}}-top', {
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        spaceBetween: 10
    });
    var galleryThumbs{{$day->day_num}} = new Swiper('.swiper{{$day->day_num}}-thumbs', {
        spaceBetween: 10,
        centeredSlides: true,
        slidesPerView: 'auto',
        touchRatio: 0.2,
        slideToClickedSlide: true
    });
    galleryTop{{$day->day_num}}.params.control = galleryThumbs{{$day->day_num}};
    galleryThumbs{{$day->day_num}}.params.control =  galleryTop{{$day->day_num}};

</script>