<div class="sticky">
   <nav class="top-bar" data-topbar role="navigation">
     <ul class="title-area">
      <li class="name">
         <h1>
            <a href="{{ route('index') }}"><img class="logo" src="{{ asset('images/logo-long.gif') }}" id="logo-navbar"></img></a>
         </h1>
      </li>
     </ul>

     <section class="top-bar-section">
      <ul class="right">
         <li class="signin-button-parent"><a href="/signin" data-reveal-id="signinModal" class="signup-button">@lang('navbar.login')</a></li>
         <li><a href="/signup" data-reveal-id="signupModal" class="signup-button">@lang('navbar.signup')</a></li>
      </ul>
     </section>
   </nav>

   <div class="language-picker">
      <a href="{{ route('language', 'fr') }}" class="choose-lan">FRA</a>
      <span class="separator"></span>
      <a href="{{ route('language', 'en') }}" class="choose-lan">ENG</a>
   </div>
</div>
