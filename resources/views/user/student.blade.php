@extends('layouts.master', ["title" => trans('profile.title.student', ["name" => $user->username]), "footer" => false])
@section('content')

   <div class="row collapse profile profile-container">
      @include('user.sidebar')

      <div class="medium-10 small-12 columns panel-main">

         <div class="row">
            <span class="profile-date"><a href="{{ route('calendar', Auth::user()->id) }}">{{ Carbon\Carbon::now('Europe/Paris')->formatLocalized('%A %d %B %Y') }}</a></span>
         </div>
         @if(session()->has('message'))
            @if(session()->get('message') == 'RAS')
            @elseif(session()->get('message') == 'error')
              <div class="erreur-update" style="background-color: #960E0E;">Une erreur s'est produite.</div>
            @else
              <div class="erreur-update" style="background-color: #00B143;">{{ session()->get('message') }}</div>
            @endif
          @endif

         <div class="row account-resume" style="background: url(images/annexe_test_blur.jpg) center center no-repeat; background-size: cover;">
            <div class="columns medium-3 medium-uncentered small-centered picture-column small-7">
               @if(file_exists("uploads/pp/".$user->id.".png"))
                  <img class="profile-picture" src="{{ asset('uploads/pp/'.$user->id.'.png') }}" alt="" />
               @else
                  @if($student->gender == 0)
                     <img class="profile-picture" src="{{ asset('images/user-student.png') }}" alt="" />
                  @else
                     <img class="profile-picture" src="{{ asset('images/user-student-girl.jpg') }}" alt="" />
                  @endif
               @endif
            </div>

            <div class="medium-9 small-12 medium-uncentered small-centered columns">
               <ul class="personal-informations">
                  <li class="title" style="display: flex;">{{ strtoupper($student->first_name." ".$student->last_name) }} 
                  @if(Auth::user()->id == $username && !$student->registration_done)
                  <a href="{{ route('account', Auth::user()->id)}}" class="warning_register"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                  <div class="warning_box">
                     <p>@lang('student.errorFiles')</p>
                  </div>
                  </a></li>
                  @endif
                  @if(Auth::user()->id == $username)
                     <li>
                        <span class="info-label">@lang('student.email')</span>
                        {{ strtoupper($user->email) }}
                     </li>
                     <li>
                        <span class="info-label">@lang('student.contactNumber')</span>
                         {{ $student->phone }}
                      </li>
                  @endif
                  <li>
                     <span class="info-label">@lang('student.school')</span>
                     ÉCOLE HÔTELIÈRE DE LAUSANNE
                  </li>
                  <li>
                     <span class="info-label">@lang('student.year')</span>
                     {{ strtoupper($student->school_year) }}
                  </li>
                  <li>
                     <span class="info-label">@lang('student.extrasmeLevel')</span>
                     @if($student->level > 3)
                        <span class="level-logo {{ $student->level > 0 ? 'completed' : '' }}"></span>
                        <span class="level-logo {{ $student->level > 1 ? 'completed' : '' }}"></span>
                        <span class="level-logo {{ $student->level > 2 ? 'completed' : '' }}"></span>
                        <span class="level-logo {{ $student->level > 3 ? 'completed' : '' }}"></span>
                        <span class="level-logo {{ $student->level > 4 ? 'completed' : '' }}"></span>
                     @else
                        @lang('student.notEnoughExtras')
                     @endif
                  </li>
                  <li>
                     <span class="info-label"></span>
                  </li>
               </ul>
            </div>
         </div>

         @if(Auth::user()->type == 1 && $student->registration_done == 1 && $studentApply == 1)
            @foreach($extrasWhereStudentApplied as $extra)
               <p style="color: white;">This student asked for the extras : {{ $extra->type }} the {{ $extra->dateStartExtra() }} at {{ $extra->timeStartExtra() }} : </p>
               <div style="margin-left: 5px;">
                  <button class="submit-button"><a href="{{ route('accept_extra', ['username' => Auth::user()->id, 'extraID' => $extra->id, 'studentID' => $student->id]) }}">@lang('myExtraList.accept')</a></button>
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <button class="submit-button"><a href="{{ route('decline_application', ['username' => Auth::user()->id, 'extraID' => $extra->id, 'studentID' => $student->id]) }}">@lang('myExtraList.decline')</a></button>
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
               </div>
            @endforeach
         @endif

         <div class="row details-button">
            @if(Auth::user()->id == $username)
               <div id="more-details"><span>@lang('student.moreDetails')</span> <i class="fa fa-caret-down" aria-hidden="true"></i></div>
         </div>
         <div class="details-container">
            @else
               <div id="more-details"><span>@lang('student.lessDetails')</span> <i class="fa fa-caret-up" aria-hidden="true"></i></div>
         </div>
         <div class="details-container" style="max-height:3000px; opacity:1;">
            @endif
            <div class="summary-container cv-div">
               <h2>@lang('student.summary')</h2>
               <p>
                  @if(!empty($student->cv->summary))
                     {{ $student->cv->summary }}
                  @else
                     @lang('student.noSummary')
                  @endif
               </p>
            </div>
            <div class="experience-container cv-div">
               <h2>@lang('student.experience')</h2>
               @if(count($experiences) != 0)
                  @foreach($experiences as $experience)
                     <h3>{{ $experience->title }}</h3>
                     <h4>{{ $experience->from_date->format('F Y'). " - " .$experience->to_date->format('F Y') }}</h4>
                     <hr>
                     <p>
                        {{ $experience->summary }}
                     </p>
                     <hr>
                  @endforeach
               @else
                  <p>@lang('student.noExperience')</p>
               @endif
            </div>
            <div class="education-container cv-div">
               <h2>@lang('student.education')</h2>
               @if(count($educations) != 0)
                  @foreach($educations as $education)
                     <h3>{{ $education->title }}</h3>
                     <h4>{{ $education->from_date->format('F Y'). " - " .$education->to_date->format('F Y') }}</h4>
                     <hr>
                     <p>
                        {{ $education->summary }}
                     </p>
                     <hr>
                  @endforeach
               @else
                  <p>@lang('student.noEducation')</p>
               @endif
            </div>
            <div class="skills-container cv-div">
               <h2 style="margin-bottom: 30px;">@lang('student.competence')</h2>
               @if(count($skills) != 0)
               <ul>
                  
                     @foreach($skills as $skill)
                        <li>{{ $skill->title }}</li>
                     @endforeach
                  @else
                     <p>@lang('student.noCompetence')</p>
                  
               </ul>
               @endif
            </div>
            <div class="languages-container cv-div">
               <h2 style="margin-bottom: 30px;">@lang('student.language')</h2>
               @if(count($languages) != 0)
               <ul>
                     @foreach($languages as $language)
                        <li>{{ $language->title }}</li>
                     @endforeach
                  @else
                     <p>@lang('student.noLanguage')</p>
                  
               </ul>
               @endif
            </div>
            @if(Auth::user()->type == 1 && $student->registration_done == 1 && $canDownloadCard == 1)
               <div class="export-ids">
                  <a href="{{ asset('uploads/'.$student->user_id.'/cartes.zip') }}" download="Official_Documents_{{$student->last_name}}">CARTES</a>
               </div>
            @endif
         </div>
         
         @if(Auth::user()->id == $username)
            <div>
               <div class="row section-title">
                  <div class="small-12 columns">
                     <h2>@lang('student.extrasInSpotlight')</h2>
                     <div class="pagination">{{ $linksFav }}</div>
                  </div>
               </div>

               <div class="row">
                  <div class="small-12 columns">
                     <ul class="large-block-grid-3 medium-block-grid-2 small-block-grid-1">
                        @if(count($favPro) == 0)
                           <p class="empty-notice">@lang('student.noFavorite')</p>
                        @else
                           @if(count($favExtras) == 0)
                              <p class="empty-notice">@lang('student.noExtras')</p>
                           @else
                              @for($i = 0; $i < count($favExtras); $i++)
                                 @foreach ($favExtras[$i] as $favExtra)
                                    <li class="extra-available"><a href="{{ route('show_extra', ['username' => Auth::user()->id, 'id' => $favExtra->id]) }}">
                                       @include('user.card', ["extra" => $favExtra,
                                                               "id"  => $favExtra->id])
                                    </a></li>
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
                  <div class="small-8 columns">
                     <h2>@lang('student.extrasAvailable')</h2>
                     <div class="pagination">{{ $links }}</div>
                  </div>
               </div>
               
               <div class="row">
                  <div class="small-12 columns">
                     <ul class="large-block-grid-3 medium-block-grid-2 small-block-grid-1">
                        @if(empty($extras))
                           <p class="empty-notice">@lang('student.noExtras')</p>
                        @else
                           @foreach ($extras as $extra)
                           <li class="extra-available"><a href="{{ route('show_extra', ['username' => Auth::user()->id, 'id' => $extra->id]) }}">
                                       @include('user.card', ["extra" => $extra,
                                                               "id"  => $extra->id])
                           </a></li>
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
