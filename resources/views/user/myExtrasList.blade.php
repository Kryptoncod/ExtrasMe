@extends('layouts.master', ["title" => trans('profile.title.professional', ["name" => $user->username]), "footer" => false])
@section('content')

   <div class="row collapse profile profile-container">
      @include('user.sidebar')

      <div class="medium-10 small-12 columns panel-main">

        <div class="row">
            <span class="profile-date"><a href="{{ route('calendar', Auth::user()->id) }}">{{ strtoupper(date('h:i A D j M Y')) }}</a></span>
         </div>

      <div class="liste-extra-container">

         <div class="experience-container"><div class="chrono-container">
                  <a href="" id="past" data-chrono-id = "4" class="showChrono" style="width: 50%;"><label>@lang('myExtraList.past')</label></a>
                  <div style="display:flex; flex-direction:column;">
                    <div style="width:1px; height: 20%; background-color: #222"></div>
                    <div style="width:1px; height: 60%; background-color: grey"></div>
                    <div style="width:1px; height: 20%; background-color: #222"></div>
                  </div>
                  <a href="" id="present" data-chrono-id = "5" class="active showChrono" style="width: 50%;"><label>@lang('myExtraList.future')</label></a>
            </div>
            <div id="list-to-append" style="display: flex; flex-direction:column;">
              <h1>Future Extras</h1>
              <div class="liste-container">
        @if(count($extras) == 0)
          <p class="empty-notice">@lang('myExtraList.noExtra')</p>
        @else

        <div style="display:flex; flex-direction:column; width:40%" class="extra-list">
          <ul>
              @for($i=0; $i < count($extras); $i++)
                    <div style="width:100%; height:1px; background-color:white;"></div>
                    <li data-cardid="{{$extras[$i]->id}}" class="showCard <?php if($i == 0){ echo "active"; }?>" style="list-style-type:none; padding-top:20px; padding-bottom :20px; cursor:pointer;">{{ $extras[$i]->type }} Extra: {{ $professional->comany_name }}<br/>
                    Date : {{ $extras[$i]->date }} <br/>
                    Duration : {{ $extras[$i]->date_time }}
                    </li>
                    <div style="width:100%; height:1px; background-color:white;"></div>
              @endfor
          </ul>
        </div>
        <div style="width:5%;display:flex;">
          <img src="{{ asset('images/right-arrow.png') }}" style="margin:auto; width:90%;">
        </div>
        <div style="display:flex; flex-direction:column; width:55%; align-items:center" id="card-container">
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

               @if(Auth::user()->id == $username)
                  <li><span class="info-label">@lang('professional.email')</span>
                  {{ strtoupper($user->email) }}</li>

                  <li><span class="info-label">@lang('professional.contactNumber')</span>
                  {{ strtoupper($professional->phone) }}</li>
               @endif

                  <li><span class="info-label">@lang('professional.referencePerson')</span>
                  {{ strtoupper($professional->first_name.' '.$professional->last_name) }}</li>

                  <li><span class="info-label">@lang('professional.sector')</span>
                  {{ strtoupper($professional->category) }}</li>
               </ul>
            </div>
         </div>
         <div class="titre-extra">
               <h2>{{$extras[0]->type}} EXTRA : {{$professional->state}}</h2>
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
                                {{ $extras[0]->type }}
                              </td>
                            </tr>
                            <tr>
                              <td>
                                @lang('card-content.requirements')
                              </td>
                              <td>
                                {{ $extras[0]->requirements }}
                              </td>
                            </tr>
                            <tr>
                              <td>
                                @lang('card-content.salary')
                              </td>
                              <td>
                                {{ $extras[0]->salary }} CHF/Hr
                              </td>
                            </tr>
                            <tr>
                              <td>
                                @lang('card-content.benefits')
                              </td>
                              <td>
                                {{ $extras[0]->benefits }}
                              </td>
                            </tr>
                            <tr>
                              <td>
                                @lang('card-content.lang')
                              </td>
                              <td>
                                {{ $extras[0]->language }}
                              </td>
                            </tr>
                            <tr>
                              <td>
                                @lang('card-content.time')
                              </td>
                              <td>
                                {{ $extras[0]->dateExtra().' at '.$extras[0]->timeExtra() }}
                              </td>
                            </tr>
                            <tr>
                             <td>
                               @lang('card-content.numberPerson')
                             </td>
                             <td>
                               {{ $extras[0]->number_persons }}
                             </td>
                           </tr>
                            <tr>
                              <td style="border-bottom: none;">
                                @lang('card-content.otherInfo')
                              </td>
                              <td style="border-bottom: none;">
                                @if(empty($extras[0]->informations))
                                    @lang('card-content.noOtherInfo')
                                @else
                                  {{ $extras[0]->informations}}
                                @endif
                              </td>
                            </tr>
                          </tbody>
                        </table>
                        @if($extras[0]->find == 0)
                          <ul style="width: 80%; margin:auto;">
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
                                    <button class="submit-button right"><a href="{{ route('decline_application', ['username' => Auth::user()->id, 'extraID' => $extras[0]->id, 'studentID' => $student->id]) }}">@lang('myExtraList.decline')</a></button>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button class="submit-button right"><a href="{{ $extras[0]->id.'/accept/'.$student->id }}">@lang('myExtraList.accept')</a></button>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                  </li>
                                @endforeach
                              @endif
                          </ul>
                        @endif
                          <ul style="width: 80%; margin: auto;">
                              <li class="title list-stud-title">@lang('myExtraList.studentChosen')</li>
                              @foreach($studentsAlreadyChosen as $student)
                                <li class="student-applied-container">
                                  <a href = "{{ route('home', $student->user_id) }}">
                                  @if(file_exists("uploads/pp/".$student->user_id.".png"))
                                      <img class="profile-picture" src=" uploads/pp/{{$student->user_id}}.png" alt="" />
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
                      </div>
                    @endif
                  </div>
                </div>
              </div>
            </div>
   <script type="text/javascript">
     var url = "{{ route('getCard') }}";
     var url_liste = "{{ route('getList') }}";
   </script>
@endsection
