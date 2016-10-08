<h2 class="name-list">{{$name}}</h2>
<p>ETUDIANT A L'ECOLE DE LAUSANNE</p>
<hr style="margin-top: 0px;">
<div style="width: 40%;">
   @if(file_exists("uploads/pp/".$student->user_id.".png"))
      <img class="profile-picture" src="{{ asset('uploads/pp/'.$student->user_id.'.png') }}" alt="" />
   @else
      @if($student->gender == 0)
         <img class="profile-picture" src="{{ asset('images/user-student.png') }}" alt="" />
      @else
         <img class="profile-picture" src="{{ asset('images/user-student-girl.jpg') }}" alt="" />
      @endif
   @endif
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
         <h3 style="color:white;">{{ $experience->title }}</h3>
         <h4 style="color:white;">{{ $experience->from_date->format('F Y'). " - " .$experience->to_date->format('F Y') }}</h4>
         <p style="color:white;">
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
         <h3 style="color:white;">{{ $education->title }}</h3>
         <h4 style="color:white;">{{ $education->from_date->format('F Y'). " - " .$education->to_date->format('F Y') }}</h4>
         <p style="color:white;"> 
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
   @if(sizeof($alreadyFav) == 0)
      <button><a class="submit-button" href="{{ route('add_favorite', ['username' => Auth::user()->id, 'id' => $student->id]) }}">@lang('favorite.add')</a></button>
   @else
      <button><a class="submit-button" href="{{ route('delete_favorite', ['username' => Auth::user()->id, 'id' => $student->id]) }}">@lang('favorite.delete')</a></button>
   @endif
</div>