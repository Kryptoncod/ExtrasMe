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

         <li class="has-form signin-section closed">
            <form class="" action="{{ route('authenticate')}}" method="post">

               <div class="row collapse">
                  <div class="small-4 columns">
                     <input type="text" name="email" placeholder="Email">
                  </div>
                  <div class="small-4 columns">
                     <input type="password" name="password" placeholder="Password">
                  </div>
                  <div class="small-3 columns">
                     <button type="submit" class="button expand">Sign in</button>
                     <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  </div>
                  <div class="small-1 columns">
                     <a href="" class="exit-button button secondary expand">X</a>
                  </div>
               </div>

            </form>
         </li>

         <li class="signin-button-parent"><a href="/signin" class="signin-button">SIGN IN</a></li>
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
