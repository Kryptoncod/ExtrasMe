@extends('layouts.master', ["title" => trans('profile.title.favExtras'), "footer" => false])
@section('content')

   <div class="row collapse profile profile-container">
      @include('user.sidebar')

      <div class="medium-10 small-12 columns panel-main">

         <div class="row">
            <span class="profile-date">{{ strtoupper(date('h:i A D j M Y')) }}</span>
         </div>

         <div class="row account-resume">
            <div class="row">
               <div class="medium-9 small-12 medium-uncentered small-centered columns">
                  <ul class="personal-informations">
                     <li>
                        <span class="info-label">TOTAL AMOUNT EARNED:</span>
                        {{ $dashboard->total_earned }}
                     </li>
                     <li>
                        <span class="info-label">TOTAL EXTRA HOURS:</span>
                         {{ $dashboard->total_hours }}
                      </li>
                     <li>
                        <span class="info-label">NUMBER OF EXTRAS:</span>
                        {{ $dashboard->numbers_extras }}
                     </li>
                     <li>
                        <span class="info-label">NUMBER OF ESTABLISHEMENT:</span>
                        {{ $dashboard->numbers_establishement }}
                     </li>
                     <li>
                        <span class="info-label">FORCE DU PROFIL: </span>
                        {{ $dashboard->level }}
                     </li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>

@endsection

