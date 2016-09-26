<h2 class="name-list">{{$name}}</h2>
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

<div>
   <a class="submit-button" href="{{ route('add_favorite', ['username' => Auth::user()->id, 'id' => $student->id]) }}">Add as favorite</a>
   <a class="submit-button" href="{{ route('delete_favorite', ['username' => Auth::user()->id, 'id' => $student->id]) }}">Delete as favorite</a>
</div>