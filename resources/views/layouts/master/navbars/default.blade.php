<div class="sticky">
   <nav class="top-bar" data-topbar role="navigation">
     <ul class="title-area">
      <li class="name">
         <h1>
            <a href="{{ route('index') }}"><img class="logo" src="{{ asset('../resources/assets/images/logo.gif') }}"></img>ExtrasMe</a>
         </h1>
      </li>
     </ul>

     <section class="top-bar-section">
      <ul class="right">
         <li class="signin-button-parent"><a href="/signin" data-reveal-id="signinModal" class="signup-button">LOG IN</a></li>
         <li><a href="/signup" data-reveal-id="signupModal" class="signup-button">SIGN UP</a></li>
      </ul>
     </section>
   </nav>

   <div class="language-picker">
      <a href="{-- route('locale/FR_fr') --}">FRA</a>
      <span class="separator"></span>
      <a href="{-- //route('locale/EN_en') --}">ENG</a>
   </div>
</div>
