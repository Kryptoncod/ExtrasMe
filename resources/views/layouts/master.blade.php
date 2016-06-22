<!doctype html>
<html class="no-js" lang="en">

   <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>{{ isset($title) ? $title.' | ' : '' }}ExtrasMe</title>
      <link rel="stylesheet" href="{{ asset('../resources/assets/css/app.css') }}" />
      <script src="{{ asset('../resources/assets/js/modernizr.js') }}"></script>
      @yield('head')
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
      <div id="extraModal" class="reveal-modal" data-reveal aria-hidden="true" role="dialog"></div>
      @yield('foot')

      <script src="{{ asset('../resources/assets/js/jquery.min.js') }}"></script>
      <script src="{{ asset('../resources/assets/js/foundation.min.js') }}"></script>
      <script src="{{ asset('../resources/assets/js/app.js') }}"></script>
   </body>

</html>
