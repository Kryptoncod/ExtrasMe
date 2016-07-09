<div class="sticky">
   <nav class="top-bar" data-topbar role="navigation">
   <ul class="title-area">
      <li class="name">
         <h1>
            <a href="{{ url('/home') }}"><img class="logo" src="{{ asset('../resources/assets/images/logo.gif') }}"></img><span class="hide-for-small-only">ExtrasMe</span></a>
         </h1>
      </li>
   </ul>

      <section class="top-bar-section connected">
         <ul class="right">
            @if($user->type == 0)
               <li><a href="{{ url('/home') }}">{{ strtoupper($name) }}</a></li>
            @else
               <li><a href="{{ url('/home') }}">{{ strtoupper($professional->company_name) }}</a></li>
            @endif
            <li><a data-dropdown="menu-drop" data-options="is_hover:true; hover_timeout:10000" aria-controls="menu-drop" aria-expanded="false" class="menu-button"></a></li>

         </ul>
      </section>
   </nav>

   <ul id="menu-drop" class="menu-dropdown" data-dropdown-content aria-hidden="true" tabindex="-1">
      <li><a href="{{ url('/home') }}">ACCOUNT</a></li>
      <li><a href="">HELP</a></li>
      <li><a href="{{ url('/logout') }}">SIGN OUT</a></li>
   </ul>
</div>
