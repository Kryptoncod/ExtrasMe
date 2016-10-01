@extends('layouts.master', ["title" => trans('profile.title.professional', ["name" => $user->username]), "footer" => false])
@section('content')

   <div class="row collapse profile profile-container">
      @include('user.sidebar')

      <div class="medium-10 small-12 columns panel-main">

         <div class="row">
            <span class="profile-date"><a href="{{ route('calendar', Auth::user()->id) }}">{{ strtoupper(date('h:i A D j M Y')) }}</a></span>
         </div>

         <form action="{{ route('rate', [Auth::user()->id,
                       $extra->id]) }}" method="post">

            <div class="row account-resume">
               <div class="medium-9 small-12 medium-uncentered small-centered columns">
                  <ul class="personal-informations">
                     <li class="title" style="display: flex;">Hours made for the extra : {{ $extra->type }}
                     </li>
                     <li>
                        Hours registered on the extra : {{ $extra->duration }}
                     </li>
                     <li>
                        Hours made by the student(s) : <input type="number" min="0" name="rate{{ $id }}" id="rate" required />
                     </li>
                  </ul>
               </div>
            </div>
         <button class="submit-button right">NEXT</button>
         <input type="hidden" name="_token" value="{{ csrf_token() }}">
         </form>
         
      </div>
   </div>

@endsection
