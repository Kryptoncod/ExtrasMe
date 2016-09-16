<div class="sticky">
   <nav class="top-bar" data-topbar role="navigation">
   <ul class="title-area">
      <li class="name">
         <h1>
            <a href=""><img class="logo" src="{{ asset('images/logo-long.gif') }}" id="logo-navbar"></img></a>
         </h1>
      </li>
   </ul>

      <section class="top-bar-section connected">
      </section>
   </nav>

   <ul id="menu-drop" class="menu-dropdown" data-dropdown-content aria-hidden="true" tabindex="-1">
      <li><a href="">ACCOUNT</a></li>
      <li><a href="">HELP</a></li>
      <li><a href="{{ url('/logout') }}">SIGN OUT</a></li>
   </ul>
</div>
