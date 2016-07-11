@extends('layouts.master', ["title" => trans('profile.title.extra', ["name" => $user->username]), "footer" => false])
@section('content')

<div class="extra-container">
   @if(empty($extras))
      <p class="empty-notice">Sorry, no extra available at the moment. Come back later</p>
   @else
      @for($i=0; $i < count($extras); $i++)
         <img src="{{ asset('../resources/assets/images/extra-background.png') }}" class="background-image" />
         <div class="extra-title">{{ $extras[$i]->type }} Extra: {{ $professional[$i] }}</div>

         <div class="extra-description row">
            <div class="small-3 columns">
               <div class="details">
                  <ul>
                     <li class="title">KEY DETAILS</li>
                     <li>SALARY: {{ $extras[$i]->salary }} CHF/Hr</li>
                     <li>BENEFITS: {{ $extras[$i]->benefits }}</li>
                     <li>LANG: FRENCH</li>
                     <li>TIME: {{ $extras[$i]->date.' at '.$extras[$i]->date_time }}</li>
                  </ul>
               </div>
            </div>

            <div class="small-9 columns">
               <p>
                  DESCRIPTION : {{ $extras[$i]->requirements }}
               </p>
            </div>
         </div>
         @if(Auth::user()->type == 0)
            <a href="" class="apply-button right">APPLY</a>
         @endif
      @endfor
   @endif
</div>

@endsection
