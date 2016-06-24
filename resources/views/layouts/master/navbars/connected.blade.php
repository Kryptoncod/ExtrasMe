<div class="sticky">
   <nav class="top-bar" data-topbar role="navigation">
   <ul class="title-area">
      <li class="name">
         <h1>
            <a href="{{ route('index') }}"><img class="logo" src="{{ asset('../resources/assets/images/logo.gif') }}"></img><span class="hide-for-small-only">ExtrasMe</span></a>
         </h1>
      </li>
   </ul>

      <section class="top-bar-section connected">
         <ul class="right">

            <li><a href="{{ route('profile', Auth::user()->username) }}">{{ Auth::user()->username }}</a></li>
            <li><a data-dropdown="menu-drop" data-options="is_hover:true; hover_timeout:10000" aria-controls="menu-drop" aria-expanded="false" class="menu-button"></a></li>

         </ul>
      </section>
   </nav>

   <ul id="menu-drop" class="menu-dropdown" data-dropdown-content aria-hidden="true" tabindex="-1">
      <li><a href="{{ route('profile', Auth::user()->username) }}">ACCOUNT</a></li>
      <li><a href="">SETTINGS</a></li>
      <li><a href="">HELP</a></li>
      <li><a href="{{ route('logout') }}">SIGN OUT</a></li>
   </ul>
</div>