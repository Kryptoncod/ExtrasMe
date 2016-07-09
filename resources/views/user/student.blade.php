@extends('layouts.master', ["title" => trans('profile.title.student', ["name" => $user->username]), "footer" => false])
@section('content')

   <div class="row collapse profile profile-container">
      @include('user.sidebar', ['nav' => ['MY CV' => '', 'MY TESTIMONIALS' => ''], 'formType' => 0])

      <div class="medium-10 small-12 columns panel-main">

         <div class="row">
            <span class="profile-date">{{ strtoupper(date('h:i A D j M Y')) }}</span>
         </div>

         <div class="row account-resume">
            <div class="columns medium-3 medium-uncentered small-centered picture-column small-7">
               <img class="profile-picture" src="{{ asset('assets/images/user-student.png') }}" alt="" />
            </div>

            <div class="medium-9 small-12 medium-uncentered small-centered columns">
               <ul class="personal-informations">
                  <li class="title">{{ $student->first_name.' '.$student->last_name }}</li>
                  <li>
                     <span class="info-label">EMAIL:</span>
                     {{ $user->email }}
                  </li>
                  <li>
                     <span class="info-label">CONTACT NUMBER:</span>
                      {{ $student->phone_number }}
                   </li>
                  <li>
                     <span class="info-label">SCHOOL:</span>
                     ÉCOLE HÔTELIÈRE DE LAUSANNE
                  </li>
                  <li>
                     <span class="info-label">YEAR:</span>
                     {{ $student->school_year }}
                  </li>
                  <li>
                     <span class="info-label">EXTRASME LEVEL:</span>
                     <span class="level-logo {{ $student->level > 0 ? 'completed' : '' }}"></span>
                     <span class="level-logo {{ $student->level > 1 ? 'completed' : '' }}"></span>
                     <span class="level-logo {{ $student->level > 2 ? 'completed' : '' }}"></span>
                     <span class="level-logo {{ $student->level > 3 ? 'completed' : '' }}"></span>
                     <span class="level-logo {{ $student->level > 4 ? 'completed' : '' }}"></span>
                     @if($student->level == 0)
                        <span data-tooltip aria-haspopup="true" class="has-tip level-error" title="You have never done any extra">!</span>
                     @endif
                  </li>
               </ul>
            </div>
         </div>

         <div class="row details-button">
            <a href="">MORE DETAILS</a>
         </div>

         @if(false)
            <div class="row section-title">
               <div class="small-12 columns">
                  <h2>EXTRAS IN SPOTLIGHT</h2>
               </div>
            </div>

            <div class="row">
               <div class="small-12 columns">
                  <ul class="large-block-grid-3 medium-block-grid-2 small-block-grid-1">

                     <li>@include('user.card', ["description" => "Four Seasons Hotel des Bergues is looking for extra in all department
                                                                  for several events upcoming in the month of December. If you have strong background ...",
                                                "title" => "FOUR SEASONS HOTEL DES BERGUES",
                                                "image" => asset("/assets/images/extra-card-example.png")])
                     </li>

                     <li>@include('user.card', ["description" => "Four Seasons Hotel des Bergues is looking for extra in all department
                                                                  for several events upcoming in the month of December. If you have strong background ...",
                                                "title" => "FOUR SEASONS HOTEL DES BERGUES",
                                                "image" => asset("/assets/images/extra-card-example.png")])
                     </li>

                     <li>@include('user.card', ["description" => "Four Seasons Hotel des Bergues is looking for extra in all department
                                                                  for several events upcoming in the month of December. If you have strong background ...",
                                                "title" => "FOUR SEASONS HOTEL DES BERGUES",
                                                "image" => asset("/assets/images/extra-card-example.png")])
                     </li>

                  </ul>
               </div>
            </div>
         @endif

         <div class="row section-title">
            <div class="small-12 columns">
               <h2>EXTRAS AVAILABLE</h2>
            </div>
         </div>

         <div class="row">
            <div class="small-12 columns">
               <ul class="large-block-grid-3 medium-block-grid-2 small-block-grid-1"

                  @if(empty($extras))
                     <p class="empty-notice">Sorry, no extra available at the moment. Come back later</p>
                  @else
                     @foreach ($extras as $extra)
                     <li>@include('user.card', ["description" => $extra->getUserModel()->getTypeModel()->company_name." is looking for extras in ".
                                                                 $extra->extra_type.
                                                                 ' for '.$extra->getFormattedDatetime('D F jS Y').' at '.$extra->getFormattedDatetime('h:i A'),
                                                "title" => $extra->getUserModel()->getTypeModel()->company_name,
                                                "image" => asset("/assets/images/extra-card-example.png"),
                                                "id"  => $extra->id])
                     </li>
                     @endforeach
                  @endif

               </ul>
            </div>
         </div>

      </div>

   </div>

@endsection
