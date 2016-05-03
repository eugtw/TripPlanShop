<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Responsive Tabs</title>
    <meta name="description" content="Responsive Tabs">
    <meta name="author" content="Gabriel Tomescu"><meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">

    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>


    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->


    <!-- responsive tabs-->
    <script src="/js/responsive-tabs/responsive-tabs.js"></script>
    <style>
        body{
            font-size: 1em;
            padding: 30px;
        }

        .nav-tabs {
            width: 100%;
            float: left;
            border-bottom-color: #d9d9d9; }
        .nav-tabs > li a {
            text-align: center;
            border-width: 1px 1px 0 1px;
            border-style: solid;
            border-color: #e0e0e0;
            color: #444444;
            background: #f2f2f2; }
        .nav-tabs > li a:hover {
            background: #F9F9F9;
            border-color: #d9d9d9; }
        .nav-tabs > li.active a, .nav-tabs > li.active:hover a {
            color: #444444;
            background: white;
            border-color: #d9d9d9;
            border-bottom-color: transparent; }

        .responsive-tabs-container {
            position: relative; }
        .responsive-tabs-container .responsive-tabs {
            padding-right: 102px; }
        .responsive-tabs-container .tabs-dropdown {
            position: absolute;
            right: 0;
            margin-right: 0 !important; }
        .responsive-tabs-container .tabs-dropdown.navbar-nav {
            margin: 0 !important; }
        @media only screen and (max-width: 767px) {
            .responsive-tabs-container .tabs-dropdown .dropdown-menu {
                position: fixed;
                top: 20px;
                right: 20px;
                bottom: 20px;
                left: 20px;
                padding-top: 50px;
                overflow: hidden;
                overflow-y: scroll; }
            .responsive-tabs-container .tabs-dropdown .dropdown-menu .dropdown-header {
                position: fixed;
                left: 21px;
                right: 21px;
                background: #FFF;
                margin-top: -50px;
                padding-top: 18px;
                border-radius: 4px 4px 0 0; }
            .responsive-tabs-container .tabs-dropdown .dropdown-menu .close {
                position: absolute;
                top: 14px;
                right: 20px; }
            .responsive-tabs-container .tabs-dropdown .dropdown-menu .divider {
                margin: 0; } }
        .responsive-tabs-container .tabs-dropdown .dropdown-toggle {
            width: 102px;
            position: relative;
            display: block;
            padding: 10px 15px; }
        .responsive-tabs-container .tabs-dropdown .dropdown-toggle .count {
            margin-right: 5px; }
        .responsive-tabs-container .tabs-dropdown .dropdown-toggle .caret {
            border-top: 4px solid transparent;
            border-bottom: 4px solid transparent;
            border-left: 6px solid;
            margin-left: 0;
            vertical-align: initial; }

        /*# sourceMappingURL=main.css.map */

    </style>
</head>

<body>
<p class="instructions"><strong>How to Test:</strong> Resize your browser window to see how tabs scale / respond.</p>

<!-- Nav tabs -->
<ul class="nav nav-tabs " ></ul>

<!-- Tab panes -->
<div class="tab-content"></div>


<ul class="nav nav-tabs js-example" role="tablist">
    <li class="active"><a href="#tab1" data-toggle="tab">Tab1</a></li>
    <li><a href="#tab2" data-toggle="tab">Tab2</a></li>
    <li><a href="#tab3" data-toggle="tab">Tab3</a></li>
    <li><a href="#tab4" data-toggle="tab">Tab4</a></li>
    <li><a href="#tab5" data-toggle="tab">Tab5</a></li>
</ul>
<script>
    $(document).ready(function () {


        //$(".tab-content").ipsum();
        $(".js-example").find("li").first().addClass("active");
        $(".tab-content").find(".tab-pane").first().addClass("active");

        $('.js-example').bootstrapResponsiveTabs({
            minTabWidth: 80,
            maxTabWidth: 150
        });
    });
</script>
</body>
</html>
