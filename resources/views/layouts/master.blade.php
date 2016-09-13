<!doctype html>
<html class="no-js" lang="en">

   <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>ExtrasMe</title>
      <link rel="icon" type="image/gif" href="{{ asset('images/logo-blue.gif') }}" />
      <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
      <link href="//cdnjs.cloudflare.com/ajax/libs/foundicons/3.0.0/foundation-icons.css" rel="stylesheet">
      <link rel="stylesheet" href="{{ asset('css/foundation-datepicker.min.css') }}" />
      <link href="//netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome.css" rel="stylesheet">
      <link href="https://file.myfontastic.com/UbG5ssV57cNYroYCjkUMdm/icons.css" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
      <script src="{{ asset('js/modernizr.js') }}"></script>
      <link rel='stylesheet' href="{{ asset('css/fullcalendar.min.css') }}" />
      <link rel="stylesheet" type="text/css" href="{{ asset('css/sweetalert.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.fullPage.css') }}" />
      <script src="{{ asset('js/moment.min.js') }}"></script>
      <script src="{{ asset('js/fullcalendar.min.js') }}"></script>
      <script src="{{ asset('js/sweetalert.min.js') }}"></script>


   </head>

   <body>
      <div class="js-notice">@lang('layouts.jsNotice')</div>

      @if(Auth::check())
         @include('layouts.master.navbars.connected')
      @else
         @include('layouts.master.navbars.default')
      @endif

      @yield('content')
      @if(!isset($footer) || $footer != false)
         <div class="section fp-auto-height">@include('layouts.master.footer')</div>
      @endif
      @include('layouts.master.modals.signup')
      @include('layouts.master.modals.signin')
      <div id="extraModal" class="reveal-modal" data-reveal aria-hidden="true" role="dialog"></div>
      @yield('foot')


      <script src="{{ asset('js/foundation-datepicker.min.js') }}"></script>
      <script src="{{ asset('js/foundation-datepicker.fr.js') }}"></script>
      <script src="{{ asset('js/jquery.cropit.js') }}"></script>
      <script src="{{ asset('js/foundation.min.js') }}"></script>
      <script src="{{ asset('js/app.js') }}"></script>
   </body>

</html>
