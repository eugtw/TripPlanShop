<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ $title or 'TripPlanShop: Trip Plans Marketplace | Travel Itineraries & Guides'}}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    @yield('meta-description')
    @yield('meta-og')


    <meta name="keywords" content="tripplanshop, shop,travel, itinerary, trip, backpacking, vacation, getaway, tour, plan, planning, experience">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- fav icon -->
    <link rel="shortcut icon" href="{{ asset('images/site/favicon.ico') }}">



    <!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <!-- jQuery -->
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>

    <!-- Latest compiled and minified JavaScript -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> -->

    <!-- matchHeight -->
    <script src="{{ asset('/js/matchHeight/jquery.matchHeight.js') }}"></script>

    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/all.css" rel="stylesheet">
    <!-- <link href="{{ asset('/css/promo.css')  }}" rel="stylesheet"> -->
    <!-- Go to www.addthis.com/dashboard to customize your tools -->
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-56874d094d1fe552" async="async"></script>

</head>
<body>

<div id="">
@yield('content')

</div><!-- .wrapper -->

</body>
</html>
