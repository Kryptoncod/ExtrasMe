@extends('layouts.master', ["title" => trans('profile.title.student', ["name" => $user->username]), "footer" => false])
@section('content')

   <div class="row collapse profile profile-container">
      @include('user.sidebar')

      <div class="medium-10 small-12 columns panel-main">

         <div class="row">
            <span class="profile-date">{{ strtoupper(date('h:i A D j M Y')) }}</span>
         </div>

         <div class="row account-resume">
            <div class="columns medium-3 medium-uncentered small-centered picture-column small-7">
               <img class="profile-picture" src="{{ asset('../resources/assets/images/user-student.png') }}" alt="" />
            </div>

            <div class="medium-9 small-12 medium-uncentered small-centered columns">
               <ul class="personal-informations">
                  <li class="title">{{ strtoupper($student->first_name." ".$student->last_name) }}</li>
                  @if(Auth::user()->id == $username)
                     <li>
                        <span class="info-label">EMAIL:</span>
                        {{ strtoupper($user->email) }}
                     </li>
                     <li>
                        <span class="info-label">CONTACT NUMBER:</span>
                         {{ $student->phone }}
                      </li>
                  @endif
                  <li>
                     <span class="info-label">SCHOOL:</span>
                     ÉCOLE HÔTELIÈRE DE LAUSANNE
                  </li>
                  <li>
                     <span class="info-label">YEAR:</span>
                     {{ strtoupper($student->school_year) }}
                  </li>
                  <li>
                     <span class="info-label">EXTRASME LEVEL:</span>
                     @if($student->level > 3)
                        <span class="level-logo {{ $student->level > 0 ? 'completed' : '' }}"></span>
                        <span class="level-logo {{ $student->level > 1 ? 'completed' : '' }}"></span>
                        <span class="level-logo {{ $student->level > 2 ? 'completed' : '' }}"></span>
                        <span class="level-logo {{ $student->level > 3 ? 'completed' : '' }}"></span>
                        <span class="level-logo {{ $student->level > 4 ? 'completed' : '' }}"></span>
                     @else
                        NOT ENOUGH EXTRAS DONE YET
                     @endif
                  </li>
               </ul>
            </div>
         </div>

         <div class="row details-button">
            <div id="more-details"><span>MORE DETAILS</span> <i class="fa fa-caret-down" aria-hidden="true"></i></div>
         </div>
         <div class="details-container">
            <div class="summary-container">
               <h2>Résumé</h2>
               <p>
                  Latius iam disseminata licentia onerosus bonis omnibus Caesar nullum post haec adhibens modum orientis latera cuncta vexabat nec honoratis parcens nec urbium primatibus nec plebeiis.
               </p>
            </div>
            <div class="experience-container">
               <h2>Experience</h2>
               <h3>experience 1</h3>
               <h4>2013-2014</h4>
               <p>
                  Latius iam disseminata licentia onerosus bonis omnibus Caesar nullum post haec adhibens modum orientis latera cuncta vexabat nec honoratis parcens nec urbium primatibus nec plebeiis.
               </p>
               <h3>experience 2</h3>
               <h4>2013-2014</h4>
               <p>
                  Latius iam disseminata licentia onerosus bonis omnibus Caesar nullum post haec adhibens modum orientis latera cuncta vexabat nec honoratis parcens nec urbium primatibus nec plebeiis.
               </p>
               <h3>experience 3</h3>
               <h4>2013-2014</h4>
               <p>
                  Latius iam disseminata licentia onerosus bonis omnibus Caesar nullum post haec adhibens modum orientis latera cuncta vexabat nec honoratis parcens nec urbium primatibus nec plebeiis.
               </p>
            </div>
            <div class="education-container">
               <h2>Education</h2>
               <h3>education 1</h3>
               <h4>2013-2014</h4>
               <p>
                  Latius iam disseminata licentia onerosus bonis omnibus Caesar nullum post haec adhibens modum orientis latera cuncta vexabat nec honoratis parcens nec urbium primatibus nec plebeiis.
               </p>
               <h3>education 2</h3>
               <h4>2013-2014</h4>
               <p>
                  Latius iam disseminata licentia onerosus bonis omnibus Caesar nullum post haec adhibens modum orientis latera cuncta vexabat nec honoratis parcens nec urbium primatibus nec plebeiis.
               </p>
            </div>
            <div class="skills-container">
            <h2 style="margin-bottom: 30px;">Compétences</h2>
               <ul>
                  <li>compétence1</li>
                  <li>compétence1</li>
                  <li>compétence1</li>
                  <li>compétence1</li>
                  <li>compétence1</li>
               </ul>
            </div>
            <div class="languages-container">
            <h2 style="margin-bottom: 30px;">Langues</h2>
               <ul>
                  <li>langue1</li>
                  <li>langue1</li>
                  <li>langue1</li>
               </ul>
            </div>
         </div>

         @if(Auth::user()->id == $username)
            <div id="to-load">
               <div class="row section-title">
                  <div class="small-12 columns">
                     <h2>EXTRAS IN SPOTLIGHT</h2>
                  </div>
               </div>

               <div class="row">
                  <div class="small-12 columns">
                     <ul class="large-block-grid-3 medium-block-grid-2 small-block-grid-1">
                        @if(empty($favExtras))
                           <p class="empty-notice">Sorry, no extra available at the moment. Come back later</p>
                        @else
                           @foreach ($favExtras as $favExtra)
                           <li class="extra-available">@include('user.card', ["description" => $favExtra->professional->company_name." in ".
                                                                       $favExtra->type.
                                                                       ' for '.$favExtra->date.' at '.$favExtra->date_time,
                                                      "title" => $favExtra->professional->company_name,
                                                      "image" => asset("../resources/assets/images/extra-card-example.png"),
                                                      "id"  => $favExtra->id])
                           </li>
                           @endforeach
                        @endif
                     </ul>
                  </div>
               </div>
            </div>

            <div id="to-load">
               <div class="row section-title">
                  <div class="small-12 columns">
                     <h2>EXTRAS AVAILABLE</h2>
                     <div class="pagination">{!! $links !!}</div>
                  </div>
               </div>
               
               <div class="row">
                  <div class="small-12 columns">
                     <ul class="large-block-grid-3 medium-block-grid-2 small-block-grid-1">
                        @if(empty($extras))
                           <p class="empty-notice">Sorry, no extra available at the moment. Come back later</p>
                        @else
                           @foreach ($extras as $extra)
                           <li class="extra-available">@include('user.card', ["description" => $extra->professional->company_name." in ".
                                                                       $extra->type.
                                                                       ' for '.$extra->date.' at '.$extra->date_time,
                                                      "title" => $extra->professional->company_name,
                                                      "image" => asset("../resources/assets/images/extra-card-example.png"),
                                                      "id"  => $extra->id])
                           </li>
                           @endforeach
                        @endif
                     </ul>
                  </div>
               </div>
            </div>
          @endif

      </div>

   </div>

@endsection
