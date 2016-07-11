@extends('layouts.master', ["title" => trans('profile.title.extra', ["name" => $user->username]), "footer" => false])
@section('content')

<div class="extra-container">
   @if(empty($extras))
      <p class="empty-notice">Sorry, no extra available at the moment. Come back later</p>
   @else
      @foreach ($extras as $extra)
         <img src="{{ asset('../resources/assets/images/extra-background.png') }}" class="background-image" />
         <div class="extra-title">{{ $extra->type }} Extra: The Pauker Hotel</div>

         <div class="extra-description row">
            <div class="small-3 columns">
               <div class="details">
                  <ul>
                     <li class="title">KEY DETAILS</li>
                     <li>SALARY: {{ $extra->salary }} CHF/Hr</li>
                     <li>BENEFITS: {{ $extra->benefits }}</li>
                     <li>LANG: FRENCH</li>
                     <li>TIME: {{ $extra->date.' at '.$extra->date_time }}</li>
                  </ul>
               </div>
            </div>

            <div class="small-9 columns">
               <p>
                  DESCRIPTION : {{ $extra->requirements }}
               </p>
            </div>
         </div>
         @if(Auth::user()->type == 0)
            <a href="" class="apply-button right">APPLY</a>
         @endif
      @endforeach
   @endif
</div>

@endsection
