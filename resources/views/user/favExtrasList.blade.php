@extends('layouts.master', ["title" => trans('profile.title.favExtras'), "footer" => false])
@section('content')

   <div class="row collapse profile profile-container">
      @include('user.sidebar')

      <div class="medium-10 small-12 columns panel-main">
         @if($message != "RAS")
          @if($message == "Vous ne pouvez pas avoir plus de 5 favoris.")
            <div class="erreur-update" style="background-color: #960E0E;">{{$message}}</div>
          @else
            <div class="erreur-update" style="background-color: #00B143;">{{$message}}</div>
          @endif
        @elseif($message == "RAS")
        @else
            <div class="erreur-update" style="background-color: #960E0E;">Une erreur s'est produite.</div>
        @endif
         <div class="row">
            <span class="profile-date"><a href="{{ route('calendar', Auth::user()->id) }}">{{ Carbon\Carbon::now('Europe/Paris')->formatLocalized('%A %d %B %Y') }}</a></span>
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
                           <a href="{{ route('my_favorite_extras', Auth::user()->id) }}" class="submit-button" style="color:white; background-color:#060b2b; width:100%; text-align:center;">@lang('favorite.back')</a>
                        </div>
                     </div>
               @endif
               <hr>
               @foreach($results as $result)
                  @if(Auth::user()->type == 0)
                  <div class="fav-list-container" data-studid="{{$result->id}}" data-type=0 style="padding-left: 10px;">
                     <div>
                        @if(file_exists("uploads/pp/".$result->user_id.".png"))
                           <img class="profile-picture" src="{{ asset('uploads/pp/'.$result->user_id.'.png') }}" alt="" />
                        @else
                           <img class="profile-picture" src="{{ asset('images/user-professional.png') }}" alt="" />
                        @endif
                     </div>
                  @else
                  <div class="fav-list-container" data-studid="{{$result->id}}" data-type=1 style="padding-left: 10px;">
                     <div>
                        @if(file_exists("uploads/pp/".$result->user_id.".png"))
                           <img class="profile-picture" src="{{ asset('uploads/pp/'.$result->user_id.'.png') }}" alt="" />
                        @else
                           @if($result->gender == 0)
                              <img class="profile-picture" src="{{ asset('images/user-student.png') }}" alt="" />
                           @else
                              <img class="profile-picture" src="{{ asset('images/user-student-girl.jpg') }}" alt="" />
                           @endif
                        @endif
                     </div>
                  @endif
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
                           <p>@lang('favExtras.nationality') {{ $result->nationality }}</p>
                           <p>@lang('favExtras.schoolYear') {{ $result->school_year }}</p>
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

