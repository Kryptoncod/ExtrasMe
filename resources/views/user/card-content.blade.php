<div class="row account-resume" style="width: 90%;">
            <div class="columns medium-3 medium-uncentered small-centered picture-column small-7" style="padding: 0;">
               @if(file_exists("uploads/pp/".$professional->user_id.".png"))
                  <img class="profile-picture" src="{{ asset('uploads/pp/'.$professional->user_id.'.png') }}" alt="" />
               @else
                  <img class="profile-picture" src="{{ asset('images/user-professional.png') }}" alt="" />
               @endif
            </div>

            <div class="medium-7 small-12 medium-uncentered small-centered columns">
               <ul class="personal-informations">
                  <li class="title">{{ strtoupper($professional->company_name) }}</li>

                  <li><span class="info-label">@lang('professional.referencePerson')</span>
                  {{ strtoupper($professional->first_name.' '.$professional->last_name) }}</li>

                  <li><span class="info-label">@lang('professional.sector')</span>
                  {{ strtoupper($professional->category) }}</li>
               </ul>
            </div>
         </div>
         <div class="titre-extra">
               <h2>{{$extra->type}} EXTRA : {{$professional->state}}</h2>
            </div>
<table style="width:90%;" class="card-info">
  <thead>
    <tr>
      <td colspan="2" style="text-align:center; color:white;">
        @lang('card-content.keyDetails')
      </td>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>
        @lang('card-content.category')
      </td>
      <td>
        {{ $extra->type }}
      </td>
    </tr>
    <tr>
      <td>
        @lang('card-content.requirements')
      </td>
      <td>
        {{ $extra->requirements }}
      </td>
    </tr>
    <tr>
      <td style="width:25%;">
        @lang('card-content.salary')
      </td>
      <td>
        {{ $extra->salary }} CHF/Hr
      </td>
    </tr>
    <tr>
      <td>
        @lang('card-content.benefits')
      </td>
      <td>
        {{ $extra->benefits }}
      </td>
    </tr>
    <tr>
      <td>
        @lang('card-content.lang')
      </td>
      <td>
        French
      </td>
    </tr>
    <tr>
      <td>
        @lang('card-content.time')
      </td>
      <td>
        {{ $extra->dateStartExtra().' at '.$extra->timeStartExtra() }}
      </td>
    </tr>
    <tr>
     <td>
       @lang('card-content.numberPerson')
     </td>
     <td>
       {{ $extra->number_persons }}
     </td>
   </tr>
    <tr>
      <td style="border-bottom: none;">
        @lang('card-content.otherInfo')
      </td>
      <td style="border-bottom: none;">
        @if(empty($extra->informations))
          @lang('card-content.noOtherInfo')
        @else
        {{ $extra->informations}}
        @endif
      </td>
    </tr>
  </tbody>
</table>

@if($user->type == 0 && $search == 1)
  @if($student->registration_done == 1)   
              @if($student->extras->first())
                  @if($can_apply == 1)
                    <div style="width: 90%;">
                      <a href="{{ route('extra_apply',  ['id' => $extra->id, 'username' => $user->id]) }}" class="apply-button right main-button">@lang('card-content.apply')</a>
                    </div>
                  @else
                    <div style="width: 90%;">
                      <a href="{{ route('extra_cancel_application', ['username' => Auth::user()->id, 'id' => $extra->id]) }}" class="apply-button right main-button" style="pointer-events: none;cursor: default;">@lang('card-content.alreadyApplied')</a>
                  </div>
                  @endif
              @else
                <div style="width: 90%;">
                  <a href="{{ route('extra_apply',  ['id' => $extra->id, 'username' => $user->id]) }}" class="apply-button right main-button">@lang('card-content.apply')</a>
                </div>
              @endif
  @else
              <div style="width: 90%;">
                <a href="{{ route('account', Auth::user()->id)}}" class="main-button">@lang('card-content.cantApply')</a>
              </div>
  @endif
@elseif($user->type == 1)     
  @if($extra->find == 0)
    @if(count($extra->students) != 0)
      <ul style="width: 80%; margin:auto;">
        <li class="title list-stud-title">@lang('myExtraList.studentApplied')</li>
        @if(!empty($student))
          @foreach($students as $student_i)
            <li class="student-applied-container">
                <a href = "{{ route('home', $student_i[0]->user->id) }}">
                  @if(file_exists("uploads/pp/".$user->id.".png"))
                      <img class="profile-picture" src=" uploads/pp/{{$student_i[0]->user->id}}.png" alt="" />
                   @else
                      @if($student_i[0]->gender == 0)
                         <img class="profile-picture" src="{{ asset('images/user-student.png') }}" alt="" />
                      @else
                         <img class="profile-picture" src="{{ asset('images/user-student-girl.jpg') }}" alt="" />
                      @endif
                   @endif
                {{ $student_i[0]->first_name . " " . $student_i[0]->last_name }}
                </a>
              <div style="display: flex;">
                <button style="margin-right: 20px;"><a href="{{ route('decline_application', ['username' => Auth::user()->id, 'extraID' => $extra->id, 'studentID' => $student_i[0]->id]) }}">@lang('myExtraList.decline')</a></button>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button><a href="{{ $extra->id.'/accept/'.$student_i[0]->id }}">@lang('myExtraList.accept')</a></button>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
              </div>
            </li>
          @endforeach
        @endif
      </ul>
      @endif
  @endif
      <ul style="width:80%; margin:auto;">
        <li class="title list-stud-title">@lang('myExtraList.studentChosen')</li>
                              @foreach($studentsAlreadyChosen as $student)
                                <li class="student-applied-container">
                                  <a href = "{{ route('home', $student->user_id) }}">
                                  @if(file_exists("uploads/pp/".$student->user_id.".png"))
                                      <img class="profile-picture" src="{{ asset('uploads/pp/'.$student->user_id.'.png') }}" alt="" />
                                  @else
                                  @if($student->gender == 0)
                                                         <img class="profile-picture" src="{{ asset('images/user-student.png') }}" alt="" />
                                  @else
                                                         <img class="profile-picture" src="{{ asset('images/user-student-girl.jpg') }}" alt="" />
                                  @endif
                                                   @endif
                                  {{ $student->first_name . " " . $student->last_name }}
                                  </a>
                                    <div style="display:flex; align-items:center;">
                                      <button class="submit-button right" style="margin-right: 20px;"><a href="{{ asset('uploads/'.$student->user_id.'/cartes.zip') }}" download="carte_{{$student->first_name}}_{{$student->last_name}}">CARTES</a></button>
                                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                        <button class="submit-button right"><a href="{{ asset('uploads/contrat/contrat.pdf') }}">CONTRAT</a></button>
                                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    </div>
                                </li>
                              @endforeach
      </ul>
@endif
