@extends('layouts.master', ["title" => trans('profile.title.favExtras'), "footer" => false])
@section('content')

   <div class="row collapse profile profile-container">
      @include('user.sidebar')

      <div class="medium-10 small-12 columns panel-main">

         <div class="row">
            <span class="profile-date"><a href="{{ route('calendar', Auth::user()->id) }}">{{ strtoupper(date('h:i A D j M Y')) }}</a></span>
         </div>
         <div class="dashboard-container">
            <div class="dashboard-leftpan">
               <h2 style="padding:20px;">@lang('favExtras.title')</h2>
               <div class="search-bar">
                  <label for="search"><i class="icon-search"></i></label>
                  <input type="search" name="search-extras" placeholder="@lang('favExtrasSearch.search')" id="search">
               </div>
               <div class="fav-list-container" style="margin-top: 30px; padding-left: 10px;">
                  <div>
                     <img class="profile-picture" src="{{ asset('images/user-student.png') }}" alt="" />
                  </div>
                  <div style="display: flex;">
                     <div style="margin:auto; padding: 20px;">
                        <h2 class="name-list">BAPTISTE ARNAUD</h2>
                        <p>a travaillé pour vous le 10/11 à la tour Eiffel.</p>
                     </div>
                  </div>
               </div>
               <hr>
               <div class="fav-list-container" style="padding-left: 10px;">
                  <div>
                     <img class="profile-picture" src="{{ asset('images/user-student.png') }}" alt="" />
                  </div>
                  <div style="display: flex;">
                     <div style="margin:auto; padding: 20px;">
                        <h2 class="name-list">BAPTISTE ARNAUD</h2>
                        <p>a travaillé pour vous le 10/11 à la tour Eiffel.</p>
                     </div>
                  </div>
               </div>
               <hr>
               <div class="fav-list-container" style="padding-left: 10px;">
                  <div>
                     <img class="profile-picture" src="{{ asset('images/user-student.png') }}" alt="" />
                  </div>
                  <div style="display: flex;">
                     <div style="margin:auto; padding: 20px;">
                        <h2 class="name-list">BAPTISTE ARNAUD</h2>
                        <p>a travaillé pour vous le 10/11 à la tour Eiffel.</p>
                     </div>
                  </div>
               </div>
            </div>
            <div class="dashboard-rightpan-fav" style="display: flex;">
               <h2 class="name-list">BAPTISTE ARNAUD</h2>
               <p>ETUDIANT A L'ECOLE DE LAUSANNE</p>
               <hr style="margin-top: 0px;">
               <div style="width: 40%;">
                  <img style="width: 100%;" class="profile-picture" src="{{ asset('images/user-student.png') }}" alt="" />
               </div>
                <div class="summary-container cv-div" style="margin-top: 20px;">
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
                     <p>
                        {{ $experience->summary }}
                     </p>
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
                     <p>
                        {{ $education->summary }}
                     </p>
                  @endforeach
               @else
                  <p>@lang('student.noEducation')</p>
               @endif
            </div>
            <div class="skills-container cv-div">
               <h2>@lang('student.competence')</h2>
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
               <h2>@lang('student.language')</h2>
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
            </div>
            </div>
         </div>
         
      </div>
   </div>

@endsection

