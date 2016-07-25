<!doctype html>
<html class="no-js" lang="en">

   <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>ExtrasMe</title>
      <link rel="stylesheet" href="{{ asset('../resources/assets/css/app.css') }}" />
      <link href="//cdnjs.cloudflare.com/ajax/libs/foundicons/3.0.0/foundation-icons.css" rel="stylesheet">
      <link href="//netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome.css" rel="stylesheet">
      <link rel="stylesheet" href="{{ asset('../resources/assets/css/foundation-datepicker.min.css') }}" />
      <script src="{{ asset('../resources/assets/js/modernizr.js') }}"></script>
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
         @include('layouts.master.footer')
      @endif
      @include('layouts.master.modals.signup')
      @include('layouts.master.modals.signin')
      <div id="extraModal" class="reveal-modal" data-reveal aria-hidden="true" role="dialog"></div>
      @yield('foot')

      <script src="{{ asset('../resources/assets/js/jquery.min.js') }}"></script>
      <script src="{{ asset('../resources/assets/js/foundation-datepicker.min.js') }}"></script>
      <script src="{{ asset('../resources/assets/js/foundation-datepicker.fr.js') }}"></script>
      <script src="{{ asset('../resources/assets/js/foundation.min.js') }}"></script>
      <script src="{{ asset('../resources/assets/js/app.js') }}"></script>
   </body>

</html>
