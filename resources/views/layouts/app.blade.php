<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel='stylesheet' href='https://anovavn.com/wpdemo/Hotel/wp-includes/css/dist/block-library/style.min.css' type='text/css'
          media='all'/>
    <link rel='stylesheet'href='https://fonts.googleapis.com/css2?family=Montserrat%3Awght%40100%3B200%3B300%3B400%3B500%3B600%3B700%3B800&#038;display=swap&#038;ver=6.0'
          type='text/css' media='all'/>
    <link rel='stylesheet' id='font-awesome-css' href='{{asset('assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}'
          type='text/css' media='all'/>
    <link rel='stylesheet' id='slick-min-css-css' href='{{asset('vendors/slick/slick.min.css')}}' type='text/css' media='all'/>
    <link rel='stylesheet' id='slick-theme-min-css-css' href='{{asset('vendors/slick/slick-theme.min.css')}}' type='text/css'
          media='all'/>
    <link rel='stylesheet' id='fancybox-css-css' href='{{asset('vendors/fancybox/jquery.fancybox.min.css')}}' type='text/css'
          media='all'/>
    <link rel='stylesheet' id='nice-select-css-css' href='{{asset('vendors/nice-select/nice-select.css')}}' type='text/css'
          media='all'/>
    <link rel='stylesheet' id='datetimepicker-min-css-css' href='{{asset('vendors/datetimepicker/jquery.datetimepicker.min.css')}}'
          type='text/css' media='all'/>
    <link rel='stylesheet' id='animatecss-css' href='{{asset('assets/css/animate.css')}}' type='text/css' media='all'/>
    <link rel='stylesheet' id='maincss-css' href='{{asset('assets/css/main.css')}}' type='text/css' media='all'/>
    <link rel='stylesheet' id='custom-css-css' href='{{asset('assets/css/custom.css')}}' type='text/css' media='all'/>
    <link rel='stylesheet' id='dv-theme-style-css' href='{{asset('assets/css/style.css')}}' type='text/css' media='all'/>
    <link rel='stylesheet' id='jquery-ui-css' href='https://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css'
          type='text/css' media='all'/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css" integrity="sha512-wJgJNTBBkLit7ymC6vvzM1EcSWeM9mmOu+1USHaRBbHkm6W9EgM0HY27+UtUaprntaYQJF75rc8gjxllKs5OIQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js" integrity="sha512-zlWWyZq71UMApAjih4WkaRpikgY9Bz1oXIW5G0fED4vk14JjGlQ1UmkGM392jEULP8jbNMiwLWdM8Z87Hu88Fw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>

<div class="wrapper">

    @include('layouts.header')

    @yield('content')

    @include('layouts.footer')

    @include('layouts.message')

</div>
<script src='{{asset('vendors/fancybox/jquery.fancybox.min.js')}}'></script>
<script src='{{asset('vendors/nice-select/jquery.nice-select.js')}}'></script>
<script src='{{asset('vendors/datetimepicker/jquery.datetimepicker.full.min.js')}}'></script>
<script src='{{asset('js/main.js')}}' id='mainjs-js'></script>
<script src='{{asset('vendors/slick/slick.min.js')}}' id='slick-js-js'></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src='https://npmcdn.com/isotope-layout@3/dist/isotope.pkgd.js'
        id='isotope-js-js'></script>
<script src='{{asset('assets/js/wow.min.js')}}' id='wow-js-js'></script>
<script src='{{asset('assets/js/main.js')}}' id='mainjs-js'></script>

<script src='{{asset('assets/js/custom.js')}}' id='custom-js-js'></script>
<script src='https://anovavn.com/wpdemo/Hotel/wp-includes/js/jquery/ui/core.min.js?ver=1.13.1'></script>
<script src='https://anovavn.com/wpdemo/Hotel/wp-includes/js/jquery/ui/datepicker.min.js?ver=1.13.1'></script>
<script id='jquery-ui-datepicker-js-after'>
    jQuery(function (jQuery) {
        jQuery.datepicker.setDefaults({
            "closeText": "Close",
            "currentText": "Today",
            "monthNames": ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            "monthNamesShort": ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            "nextText": "Next",
            "prevText": "Previous",
            "dayNames": ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
            "dayNamesShort": ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
            "dayNamesMin": ["S", "M", "T", "W", "T", "F", "S"],
            "dateFormat": "MM d, yy",
            "firstDay": 1,
            "isRTL": false
        });
    });
</script>
@yield('script')
</body>
</html>