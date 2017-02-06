<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::to('/') }}/logo_4.png">

        <title>WorthRand-CRM</title>

        <link rel="stylesheet" href="{{ URL::to('/') }}/bootstrap-3.3.7-dist/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="{{ URL::to('/') }}/bootstrap-3.3.7-dist/css/bootstrap.css">
        <link rel="stylesheet" href="{{ URL::to('/') }}/font-awesome-4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{ URL::to('/') }}/font-css/worthrand-css.css">
        <link rel="stylesheet" href="{{ URL::to('/') }}/searchable-dropdown/content/styles.css">
        <link rel="stylesheet" href="{{ URL::to('/') }}/accordion-menu/css/dcaccordion.css">
        <link rel="stylesheet" href="{{ URL::to('/') }}/accordion-menu/css/skins/black.css">
        <link rel="stylesheet" href="{{ URL::to('/') }}/alertifyjs/css/themes/default.css">
        <link rel="stylesheet" href="{{ URL::to('/') }}/alertifyjs/css/alertify.css">
        <link rel="stylesheet" href="{{ URL::to('/') }}/select2.css">

        <script type='text/javascript' src="{{ URL::to('/') }}/bootstrap-3.3.7-dist/js/jquery.min.js"></script>
        <script type='text/javascript' src="{{ URL::to('/') }}/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
        <script type='text/javascript' src="{{ URL::to('/') }}/searchable-dropdown/dist/jquery.autocomplete.js"></script>
        <script type='text/javascript' src="{{ URL::to('/') }}/accordion-menu/js/jquery.cookie.js"></script>
        <script type='text/javascript' src="{{ URL::to('/') }}/accordion-menu/js/jquery.hoverIntent.minified.js"></script>
        <script type='text/javascript' src="{{ URL::to('/') }}/accordion-menu/js/jquery.dcjqaccordion.2.7.min.js"></script>
        <script type='text/javascript' src="{{ URL::to('/') }}/moment.js"></script>
        <script type='text/javascript' src="{{ URL::to('/') }}/alertifyjs/alertify.min.js"></script>
        @include('layouts.header')
    </head>

    <body id="app-layout">

        @yield('content')
        <script>
        jQuery(document).ready(function($) {
            jQuery('#accordion').dcAccordion();
        });

        alertify.set('notifier','position', 'top-right');
        </script>

        <style>
            body {
                background-color: white;
            }
        </style>
    </body>
</html>
