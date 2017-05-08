<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::to('/') }}/logo_4.png">

   <title>WorthRand-CRM</title>

   <link rel="stylesheet" href="{{ URL::to('/') }}/bootstrap-3.3.7/css/bootstrap-theme.min.css">
   <link rel="stylesheet" href="{{ URL::to('/') }}/bootstrap-3.3.7/css/bootstrap.css">
   <link rel="stylesheet" href="{{ URL::to('/') }}/font-awesome-4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" href="{{ URL::to('/') }}/font-css/worthrand-css.css">
   <link rel="stylesheet" href="{{ URL::to('/') }}/searchable-dropdown/content/styles.css">
   <link rel="stylesheet" href="{{ URL::to('/') }}/alertifyjs/css/themes/default.css">
   <link rel="stylesheet" href="{{ URL::to('/') }}/alertifyjs/css/alertify.css">
   <link rel="stylesheet" href="{{ URL::to('/') }}/select2.css">
   <link rel="stylesheet" href="{{ asset('chosen_v1.6.2/chosen.css') }}">
   <link rel="stylesheet" href="{{ asset('chosen_v1.6.2/chosen-bootstrap-css.css') }}">
   <link rel="stylesheet" href="{{ asset('bootstrap-datepicker-1.6.4/css/bootstrap-datepicker.min.css') }}">

   <script type='text/javascript' src="{{ URL::to('/') }}/bootstrap-3.3.7-dist/js/jquery.min.js"></script>
   <script type='text/javascript' src="{{ URL::to('/') }}/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
   <script type='text/javascript' src="{{ URL::to('/') }}/searchable-dropdown/dist/jquery.autocomplete.js"></script>
   <script type='text/javascript' src="{{ URL::to('/') }}/accordion-menu/js/jquery.cookie.js"></script>
   <script type='text/javascript' src="{{ URL::to('/') }}/accordion-menu/js/jquery.hoverIntent.minified.js"></script>
   <script type='text/javascript' src="{{ URL::to('/') }}/accordion-menu/js/jquery.dcjqaccordion.2.7.min.js"></script>
   <script type='text/javascript' src="{{ URL::to('/') }}/moment.js"></script>
   <script type='text/javascript' src="{{ URL::to('/') }}/alertifyjs/alertify.min.js"></script>
   <script src="{{ URL::to('/') }}/adamwdraper-numeral-js/src/numeral.js"></script>
   <script src="{{ asset('chosen_v1.6.2/chosen.jquery.min.js') }}" type="text/javascript"></script>
   <script type="text/javascript" src="{{ asset('bootstrap-datepicker-1.6.4/js/bootstrap-datepicker.min.js') }}"></script>
   @include('layouts.header')
</head>

<body id="app-layout">
   <div class="container-fluid">
      @yield('content')

      <div class="footer">
         <div class="col-lg-12">
            <hr/>
            <label class="size-12 app-info-label" for=""><span class=""><kbd>© 2016 WORTHRAND INVENTORY CRM</kbd></span></label>
            <label class=" size-12 app-info-label" for="" style="float: right;"><kbd>WORTHRAND INVENTORY CRM &mdash; Version: 0.4.1</kbd></label>
         </div>
      </div>
   </div>

   <script>
   alertify.set('notifier','position', 'top-right');
   </script>

   <script type="text/javascript">
   $('#implementation_date').datepicker({
      format: "MM d, yyyy",
      orientation: "bottom right"
   });
   </script>
</body>
</html>
