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
                  <li class="title" style="display: flex;">{{ strtoupper($student->first_name." ".$student->last_name) }} 
                  @if(!$student->registration_done)
                  <a href="{{ route('account', Auth::user()->id)}}" style=" display: flex;margin-left: 10px;"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="margin-top: auto; margin-bottom: auto; font-size: 25px; color: orange;"></i></a></li>
                  @endif
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
                  <li>
                     <span class="info-label"></span>
                  </li>
               </ul>
            </div>
         </div>

         <div class="row details-button">
            <div id="more-details"><span>MORE DETAILS</span> <i class="fa fa-caret-down" aria-hidden="true"></i></div>
         </div>
         <div class="details-container">
            <div class="summary-container cv-div">
               <h2>Résumé</h2>
               <p>
                  @if(!empty($student->cv->summary))
                     {{ $student->cv->summary }}
                  @else
                     Pas de résumé.
                  @endif
               </p>
            </div>
            <div class="experience-container cv-div">
               <h2>Experience</h2>
               @if(!empty($experiences))
                  @foreach($experiences as $experience)
                     <h3>{{ $experience->title }}</h3>
                     <h4>{{ $experience->from_date - $experience->to_date }}</h4>
                     <p>
                        {{ $experience->summary }}
                     </p>
                  @endforeach
               @else
                  <p>Pas d'expérience.</p>
               @endif
            </div>
            <div class="education-container cv-div">
               <h2>Education</h2>
               @if(!empty($educations))
                  @foreach($educations as $education)
                     <h3>{{ $education->title }}</h3>
                     <h4>{{ $education->from_date - $education->to_date }}</h4>
                     <p>
                        {{ $education->summary }}
                     </p>
                  @endforeach
               @else
                  <p>Pas d'éducation.</p>
               @endif
            </div>
            <div class="skills-container cv-div">
               <h2 style="margin-bottom: 30px;">Compétences</h2>
               <ul>
                  @if(!empty($competences))
                     @foreach($competences as $competence)
                        <li>{{ $competence->title }}</li>
                     @endforeach
                  @else
                     <p>Pas de compétence.</p>
                  @endif
               </ul>
            </div>
            <div class="languages-container cv-div">
               <h2 style="margin-bottom: 30px;">Langues</h2>
               <ul>
                  @if(!empty($languages))
                     @foreach($languages as $language)
                        <li>{{ $language->title }}</li>
                     @endforeach
                  @else
                     <p>Pas de langues.</p>
                  @endif
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
                        @if(empty($favPro))
                           <p class="empty-notice">You don't have favorite professionals.</p>
                        @else
                           @if(empty($favExtras))
                              <p class="empty-notice">Sorry, no extra available at the moment. Come back later.</p>
                           @else
                              @for($i = 0; $i < count($favExtras); $i++)
                                 @foreach ($favExtras[$i] as $favExtra)
                                    <li class="extra-available">@include('user.card', ["description" => $favExtra->professional->company_name." in ".
                                                                                $favExtra->type.
                                                                                ' for '.$favExtra->date.' at '.$favExtra->date_time,
                                                               "title" => $favExtra->professional->company_name,
                                                               "image" => asset("../resources/assets/images/extra-card-example.png"),
                                                               "id"  => $favExtra->id])
                                    </li>
                                 @endforeach
                              @endfor
                           @endif
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
            <div id='calendar'>
               {!! $calendar->calendar() !!}
               {!! $calendar->script() !!}
            </div>
         @endif
      </div>
   </div>

@endsection
