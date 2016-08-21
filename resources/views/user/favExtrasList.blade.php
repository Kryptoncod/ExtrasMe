@extends('layouts.master', ["title" => trans('profile.title.favExtras'), "footer" => false])
@section('content')

   <div class="row collapse profile profile-container">
      @include('user.sidebar')

      <div class="medium-10 small-12 columns panel-main">

         <div class="row">
            <span class="profile-date"><a href="{{ route('calendar', Auth::user()->id) }}">{{ strtoupper(date('h:i A D j M Y')) }}</a></span>
         </div>

         <div class="row">
            <form data-abide class="extra-search-form" action="{{ route('my_favorite_extras_search', Auth::user()->id) }}" method="get">
               <div class="large-8 small-12 columns">

               <div class="search-bar">
                  <label for="search"><i class="icon-search"></i></label>
                  <input type="search" name="search-extras" placeholder="SEARCH" id="search">
               </div>
                  <div class="row">
                     <div class="small-centered columns">
                        <button type="submit" class="submit-button">SEARCH</button>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                     </div>
                  </div>
               </div>
            </form>
            <div style="display:flex; flex-direction:column;" class="extra-list">
               <ul>
                 @if(!empty($results))
                  @foreach($results as $result)
                     <div style="width:100%; height:1px; background-color:white;"></div>
                        <a href="{{ route('home', $result->user->id) }}">
                           <li style="list-style-type:none; padding-top:20px; padding-bottom :20px; cursor:pointer;">
                              @if(Auth::user()->type == 0)
                                 <div class="row account-resume">
                                    <div class="columns medium-3 medium-uncentered small-centered picture-column small-7">
                                       <img class="profile-picture" src="{{ asset('images/user-professional.png') }}" alt="" />
                                    </div>

                                    <div class="medium-7 small-12 medium-uncentered small-centered columns">
                                       <ul class="personal-informations">
                                          <li class="title">{{ strtoupper($result->company_name) }}</li>

                                          <li><span class="info-label">REFERENCE PERSON:</span>
                                          {{ strtoupper($result->first_name.' '.$result->last_name) }}</li>

                                          <li><span class="info-label">SECTOR:</span>
                                          {{ strtoupper($result->category) }}</li>
                                          <button class="submit-button right"><a href="{{ 'myFavoriteExtras/'.$result->id.'/delete' }}">DELETE</button>
                                       </ul>
                                    </div>
                                 </div>
                              @else
                                 <div class="row account-resume">
                                    <div class="columns medium-3 medium-uncentered small-centered picture-column small-7">
                                       <img class="profile-picture" src="{{ asset('images/user-student.png') }}" alt="" />
                                    </div>

                                    <div class="medium-9 small-12 medium-uncentered small-centered columns">
                                       <ul class="personal-informations">
                                          <li class="title">{{ strtoupper($result->first_name." ".$result->last_name) }}</li>
                                          <li>
                                             <span class="info-label">SCHOOL:</span>
                                             ÉCOLE HÔTELIÈRE DE LAUSANNE
                                          </li>
                                          <li>
                                             <span class="info-label">YEAR:</span>
                                             {{ strtoupper($result->school_year) }}
                                          </li>
                                       </ul>
                                    </div>
                                 </div>
                              @endif
                           </li>
                        </a>
                     <div style="width:100%; height:1px; background-color:white;"></div>
                  @endforeach
                 @endif
               </ul>
            </div>
         </div>
      </div>
   </div>

@endsection
