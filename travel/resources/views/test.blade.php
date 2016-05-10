@extends('app')

@section('content')
    <h2>Shortened Text with Show More Link - Jquery</h2>

    <div class='forum-content'>
        <div class='comments-space'>The Indian economy is the world's tenth-largest by nominal GDP and third-largest by purchasing power parity. Following market-based economic reforms in 1991, India became one of the fastest-growing major economies; it is considered a newly industrialised country. However, it continues to face the challenges of poverty, corruption, malnutrition, inadequate public healthcare, and terrorism. A nuclear weapons state and a regional power, it has the third-largest standing army in the world and ranks seventh in military expenditure among nations. India is a federal constitutional republic governed under a parliamentary system consisting of 28 states and 7 union territories. India is a pluralistic, multilingual, and multi-ethnic society. It is also home to a diversity of wildlife in a variety of protected habitats.</div>
        <div class='comments-space'>Cotton was domesticated in India by 4000 B.C.E. Traditional Indian dress varies in colour and style across regions and depends on various factors, including climate and faith. Popular styles of dress include draped garments such as the sari for women and the dhoti or lungi for men. Stitched clothes, such as the shalwar kameez for women and kurta–pyjama combinations or European-style trousers and shirts for men, are also popular. Use of delicate jewellery, modelled on real flowers worn in ancient India, is part of a tradition dating back some 5,000 years; gemstones are also worn in India as talismans.</div>
        <div class='comments-space'>The Indian film industry produces the world's most-watched cinema. Established regional cinematic traditions exist in the Assamese, Bengali, Hindi, Kannada, Malayalam, Punjabi, Gujarati, Marathi, Oriya, Tamil, and Telugu languages. South Indian cinema attracts more than 75% of national film revenue. Television broadcasting began in India in 1959 as a state-run medium of communication, and had slow expansion for more than two decades. The state monopoly on television broadcast ended in 1990s and, since then, satellite channels have increasingly shaped popular culture of Indian society. Today, television is the most penetrative media in India; industry estimates indicate that as of 2012 there are over 554 million TV consumers, 462 million with satellite and/or cable connections, compared to other forms of mass media such as press (350 million), radio (156 million) or internet (37 million).</div>
    </div>


    <script>
        var showChar = 56;
        var ellipsestext = "...";
        var moretext = "See More";
        var lesstext = "See Less";
        $('.comments-space').each(function () {
            var content = $(this).html();
            if (content.length > showChar) {
                var show_content = content.substr(0, showChar);
                var hide_content = content.substr(showChar, content.length - showChar);
                var html = show_content + '<span class="moreelipses">' + ellipsestext + '</span><span class="remaining-content"><span>' + hide_content + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
                $(this).html(html);
            }
        });

        $(".morelink").click(function () {
            if ($(this).hasClass("less")) {
                $(this).removeClass("less");
                $(this).html(moretext);
            } else {
                $(this).addClass("less");
                $(this).html(lesstext);
            }
            $(this).parent().prev().toggle();
            $(this).prev().toggle();
            return false;
        });
    </script>

@stop