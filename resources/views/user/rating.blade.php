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
                  <li class="title" style="display: flex;">@lang('rate.hours.title', ['type' => $extra->type])
                  </li>
                  <li>
                     @lang('rate.hours.supposed', ['duration' => $extra->duration])
                  </li>
                  <li>
                     @lang('rate.hours.reallyMade')<input type="number" min="0" name="hours" id="hours" required />
                  </li>
               </ul>
            </div>
         </div>

         @foreach($studentToRate as $id => $student)
            <div class="row account-resume">
               <div class="columns medium-3 medium-uncentered small-centered picture-column small-7">
                  @if(file_exists("uploads/pp/".$student->id.".png"))
                     <img class="profile-picture" src=" uploads/pp/{{$student->user->id}}.png" alt="" />
                  @else
                     <img class="profile-picture" src="{{ asset('images/user-student.png') }}" alt="" />
                  @endif
               </div>
               <div class="medium-9 small-12 medium-uncentered small-centered columns">
                  <ul class="personal-informations">
                     <li class="title" style="display: flex;">@lang('rate.content', array('student' => $student->first_name.' '.$student->last_name, 'type' => $extra->type))
                     </li>
                     <li>
                        <span class="info-label">EXTRASME LEVEL:</span>
                           <span class="level-logo {{ $student->level > 0 ? 'completed' : '' }}"></span>
                           <span class="level-logo {{ $student->level > 1 ? 'completed' : '' }}"></span>
                           <span class="level-logo {{ $student->level > 2 ? 'completed' : '' }}"></span>
                           <span class="level-logo {{ $student->level > 3 ? 'completed' : '' }}"></span>
                           <span class="level-logo {{ $student->level > 4 ? 'completed' : '' }}"></span>
                     </li>
                     <li>
                        <input type="number" min="0" max="5" name="rate{{ $id }}" id="rate" required />
                        <input type="hidden" name="studentID{{ $id }}" value="{{ $student->id }}">
                     </li>
                  </ul>
               </div>
            </div>
         @endforeach

         <button class="submit-button right">@lang('rate.rate')</button>
         <input type="hidden" name="_token" value="{{ csrf_token() }}">
         </form>
         
      </div>
   </div>

@endsection
