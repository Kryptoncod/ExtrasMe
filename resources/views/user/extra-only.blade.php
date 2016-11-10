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

         <div class="extra-container">
         <div class="row account-resume">
            <div class="columns medium-3 medium-uncentered small-centered picture-column small-7" style="padding: 0;">
               @if(file_exists("uploads/pp/".$professional->user_id.".png"))
                  <img class="profile-picture" src="{{ asset ('uploads/pp/'.$professional->user_id.'.png') }}" alt="" />
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
            <div class="info-container">
                  <table>
                                     <thead>
                                       <tr>
                                         <td colspan="2">
                                           @lang('card-content.keyDetails')
                                         </td>
                                       </tr>
                                     </thead>
                                     <tbody>
                                       <tr>
                                         <td>
                                           @lang('card-content.category')
                                         </td>
                                         <td id="extra_type">
                                           {{ $extra->type }}
                                         </td>
                                       </tr>
                                       <tr>
                                         <td>
                                           @lang('card-content.requirements')
                                         </td>
                                         <td id="extra_requirements">
                                           {{ $extra->requirements }}
                                         </td>
                                       </tr>
                                       <tr>
                                         <td>
                                           @lang('card-content.salary')
                                         </td>
                                         <td id="extra_salary">
                                           {{ $extra->salary }} CHF/Hr
                                         </td>
                                       </tr>
                                       <tr>
                                         <td>
                                           @lang('card-content.benefits')
                                         </td>
                                         <td id="extra_benefits">
                                           {{ $extra->benefits }}
                                         </td>
                                       </tr>
                                       <tr>
                                         <td>
                                           @lang('card-content.lang')
                                         </td>
                                         <td>
                                           {{ $extra->language }}
                                         </td>
                                       </tr>
                                       <tr>
                                         <td>
                                           @lang('card-content.timeStart')
                                         </td>
                                         <td id="extra_date">
                                           {{ $extra->dateStartExtra().' at '.$extra->timeStartExtra() }}
                                         </td>
                                       </tr>
                                       <tr>
                                         <td>
                                           @lang('card-content.timeFinish')
                                         </td>
                                         <td id="extra_date">
                                           {{ $extra->dateFinishExtra().' at '.$extra->timeFinishExtra() }}
                                         </td>
                                       </tr>
                                       <tr>
                                         <td>
                                           @lang('card-content.duration')
                                         </td>
                                         <td id="extra_date">
                                           {{ $extra->duration }} Hr(s)
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
                                         <td style="border-bottom: none;" id="extra_otherInfos">
                                           @if(empty($extra->informations))
                                               @lang('card-content.noOtherInfo')
                                           @else
                                             {{ $extra->informations}}
                                           @endif
                                         </td>
                                       </tr>
                                     </tbody>
                                   </table>
               </div>
               @if(Auth::user()->type == 0)
                @if($student->registration_done == 1)
                  @if($can_apply != null)
                    <button><a href="{{ route('extra_apply',  ['id' => $extra->id, 'username' => $user->id]) }}">@lang('card-content.apply')</a></button>
                  @else
                    <button><a href="{{ route('extra_cancel_application', ['username' => Auth::user()->id, 'id' => $extra->id]) }}">@lang('card-content.alreadyApplied')</a></button>
                  @endif
                @else
                  <button><a href="{{ route('account', Auth::user()->id)}}">@lang('card-content.cantApply')</a></button>
                @endif
              @elseif($edit_ok == 1)
                  @if($extra->find == 0)
                        <ul style="width: 80%; margin-left: auto; margin-right: auto; color: white;">
                            <li class="title list-stud-title">@lang('myExtraList.studentApplied')</li>
                            @if(!empty($students))
                              @foreach($students as $student)
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
                                    <button class="submit-button right" style="margin-right: 20px;"><a href="{{ route('decline_application', ['username' => Auth::user()->id, 'extraID' => $extra->id, 'studentID' => $student->id]) }}">@lang('myExtraList.decline')</a></button>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button class="submit-button right"><a href="{{ $extra->id.'/accept/'.$student->id }}">@lang('myExtraList.accept')</a></button>
                                  </div>
                                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                </li>
                              @endforeach
                            @endif
                        </ul>
                      @endif
                        <ul style="width: 80%; margin-left: auto; margin-right: auto; color: white;">
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
                                  <button class="submit-button right" style="margin-right: 20px;"><a href="{{ asset('uploads/'.$student->user_id.'/cartes.zip') }}" download="Official_Documents_{{$student->last_name}}">CARTES</a></button>
                                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                  <button class="submit-button right"><a href="{{ asset('uploads/contrat/contrat.pdf') }}">CONTRAT</a></button>
                                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                </div>
                              </li>
                            @endforeach
                        </ul>
                    </div>
                <div style="display: flex;">
                   <button style="margin-left: auto;"><a href="{{ route('modify_extra', ['username' => Auth::user()->id, 'id' => $extra->id]) }}">@lang('card-content.modify')</a></button>
                   <button style="margin-left:20px;" id="delete-extra"><a href="{{ route('delete_extra', ['username' => Auth::user()->id, 'id' => $extra->id]) }}">@lang('card-content.delete')</a></button>
                </div>
              @endif
            </div>
         </div>
      </div>
   </div>

@endsection
