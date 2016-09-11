@extends('layouts.master', ["title" => trans('profile.title.favExtras'), "footer" => false])
@section('content')

   <div class="row collapse profile profile-container">
      @include('user.sidebar')

      <div class="medium-10 small-12 columns panel-main">

         <div class="row">
            <span class="profile-date"><a href="{{ route('calendar', Auth::user()->id) }}">{{ strtoupper(date('h:i A D j M Y')) }}</a></span>
         </div>

         <div class="dashboard-container">
            <div class="dashboard-leftpan">
               <h2 style="padding:20px;">@lang('favExtrasSearch.yourFav')</h2>
               <div class="search-bar">
                  <label for="search"><i class="icon-search"></i></label>
                  <form class="ajax" action="{{ route('my_favorite_extras_search', Auth::user()->id) }}" method="get">
                     <input type="search" name="search-extras" placeholder="SEARCH" id="search-extras">
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>

@endsection
