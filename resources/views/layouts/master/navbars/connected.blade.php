<div class="sticky">
   <nav class="top-bar" data-topbar role="navigation">
   <ul class="title-area">
      <li class="name">
         <h1>
            <a href="{{ route('home', Auth::user()->id) }}"><img class="logo" src="{{ asset('/images/logo-long.gif') }}" id="logo-navbar"></img></a>
         </h1>
      </li>
   </ul>

      <section class="top-bar-section connected">
            <ul class="right">
               <li><a href="{{ route('home', Auth::user()->id) }}">
               @if(Auth::user()->type == 0)
                  {{ strtoupper(substr(Auth::user()->student->first_name, 0, 1).'. '.Auth::user()->student->last_name) }}
               @else
                  {{ strtoupper(Auth::user()->professional->company_name) }}
               @endif
               </a></li>
            <li><a data-dropdown="menu-drop" data-options="is_hover:true;" aria-controls="menu-drop" aria-expanded="false" class="menu-button"></a></li>

         </ul>

      </section>
   </nav>

   <ul id="menu-drop" class="menu-dropdown" data-dropdown-content aria-hidden="true" tabindex="-1">
      <li><a href="{{ route('account', Auth::user()->id) }}">@lang('navbar.connected.account')</a></li>
      <li><a href="">@lang('navbar.connected.help')</a></li>
      <li><a href="{{ url('/logout') }}">@lang('navbar.connected.signOut')</a></li>
   </ul>
</div>
