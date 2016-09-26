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
               <h2 style="padding:20px;">@lang('favExtras.title')</h2>
               <div class="search-bar">
                  <label for="search"><i class="icon-search"></i></label>
                  <form action="{{ route('my_favorite_extras_search', Auth::user()->type) }}" method="GET" style="width: 100%;">
                     @if($back == false)
                        <input type="search" name="searchFav" placeholder="@lang('favExtrasSearch.search')" id="search">
                     @else
                        <input type="search" name="searchFav" placeholder="@lang('favExtrasSearch.search')" id="search" value="{{ $_GET['searchFav'] }}">
                     @endif
                  </form>
               </div>
               @if($back == true)
                  <div class="fav-list-container" style="padding-left: 10px; " >
                        <div style="display: flex; width:100%; height:100%;">
                           <a href="{{ route('my_favorite_extras', Auth::user()->id) }}" class="submit-button" style="color:white; background-color:#060b2b; width:100%; text-align:center;">Back</a>
                        </div>
                     </div>
               @endif
               <hr>
               @foreach($results as $result)
                  @if(Auth::user()->type == 0)
                  <div class="fav-list-container" data-studid="{{$result->id}}" data-type=0 style="padding-left: 10px;">
                  @else
                  <div class="fav-list-container" data-studid="{{$result->id}}" data-type=1 style="padding-left: 10px;">
                  @endif
                     <div>
                        <img class="profile-picture" src="{{ asset('images/user-student.png') }}" alt="" />
                     </div>
                     <div style="display: flex;">
                        <div style="margin:auto; padding: 20px;">
                           <h2 class="name-list">
                              @if(Auth::user()->type == 1)
                                 {{ $result->first_name.' '.$result->last_name }}
                              @else
                                 {{ $result->company_name }}
                              @endif
                           </h2>
                           @if(Auth::user()->type == 1)
                           <p>Nationality : {{ $result->nationality }}</p>
                           <p>School year : {{ $result->school_year }}</p>
                           @endif
                        </div>
                     </div>
                  </div>
                  <hr>
               @endforeach
            </div>
            <div class="dashboard-rightpan-fav">
               <div class="rightpan-toload">
                  
               </div>
               
            </div>
            </div>
            </div>
         </div>
         
      </div>
   </div>

<script type="text/javascript">
     var urlStudent = "{{ route('getStudent') }}";
     var urlPro = "{{ route('getPro') }}"
</script>
@endsection

