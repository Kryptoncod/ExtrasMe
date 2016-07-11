@extends('layouts.master', ["title" => trans('profile.title.extra', ["name" => $user->username]), "footer" => false])
@section('content')

<div class="extra-container">
   <img src="{{ asset('../resource/assets/images/extra-background.png') }}" class="background-image" />
   <div class="extra-title">{{ $extra->extra_type }} Extra: {{ $extra->getUserModel()->getTypeModel()->company_name }} {{ $extra->getUserModel()->getTypeModel()->address }}</div>

   <div class="extra-description row">
      <div class="small-3 columns">
         <div class="details">
            <ul>
               <li class="title">KEY DETAILS</li>
               <li>SALARY: {{ $extra->salary }} CHF/Hr</li>
               <li>BENEFITS: {{ $extra->benefits }}</li>
               <li>LANG: FRENCH</li>
               <li>TIME: {{ $extra->getFormattedDatetime('D F jS Y').' at '.$extra->getFormattedDatetime('h:i A') }}</li>
            </ul>
         </div>
      </div>

      <div class="small-9 columns">
         <p>
            Description
         </p>
      </div>
   </div>
   @if(Auth::user()->getUserModel()->isStudent())
      <a href="{{ route('extra_apply', $extra->id) }}" class="apply-button right">APPLY</a>
   @endif
</div>

@endsection
