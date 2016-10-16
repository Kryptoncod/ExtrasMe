<h1>{{$title}}</h1>
              <div class="liste-container">
                 @if(!$extras->first())
                    @if($title == 'Past Extras')
                     <p class="empty-notice">You don't have a past experience.</p>
                    @elseif($title == 'Applied Extras')
                      <p class="empty-notice">You don't applied to extras.</p>
                    @elseif($title == 'Future Extras')
                      <p class="empty-notice">You didn't get accept to any extras yet.</p>
                    @endif
                   @else
              
                   <div style="display:flex; flex-direction:column; width:40%" class="extra-list">
                     @if(Auth::user()->type == 0)
                        <ul>
                           @for($i=0; $i < count($extras); $i++)
                                 <div style="width:100%; height:1px; background-color:white;"></div>
                                 <li data-cardid="{{$extras[$i]->id}}" class="showCard <?php if($i == 0){ echo "active"; }?>" style="list-style-type:none; padding-top:20px; padding-bottom :20px; cursor:pointer;">{{ $extras[$i]->type }} Extra: {{ $extras[$i]->professional->company_name }}</li>
                                 <div style="width:100%; height:1px; background-color:white;"></div>
                           @endfor
                       </ul>
                     @else
                        <ul>
                           @for($i=0; $i < count($extras); $i++)
                                 <div style="width:100%; height:1px; background-color:white;"></div>
                                 <li data-cardid="{{$extras[$i]->id}}" class="showCard <?php if($i == 0){ echo "active"; }?>" style="list-style-type:none; padding-top:20px; padding-bottom :20px; cursor:pointer;">{{ $extras[$i]->type }} Extra: {{ $professional->company_name }}<br/>
                                  Date : {{ $extras[$i]->dateStartExtra() }} <br/>
                                  Duration : {{ $extras[$i]->duration }} Hr(s)
                                 </li>
                                 <div style="width:100%; height:1px; background-color:white;"></div>
                           @endfor
                       </ul>
                     @endif
                   </div>
                   <div style="width:5%;display:flex;">
                     <img src="{{ asset('images/right-arrow.png') }}" style="margin:auto; width:90%;">
                   </div>
                   <div style="display:flex; flex-direction:column; width:55%; align-items:center" id="card-container">
                     <div class="row account-resume" style="width: 90%;">
            <div class="columns medium-3 medium-uncentered small-centered picture-column small-7" style="padding: 0;">
               @if(file_exists("uploads/pp/".$extras[0]->professional->user_id.".png"))
                  <img class="profile-picture" src="{{ asset('uploads/pp/'.$extras[0]->professional->user_id.'.png') }}" alt="" />
               @else
                  <img class="profile-picture" src="{{ asset('images/user-professional.png') }}" alt="" />
               @endif
            </div>

            <div class="medium-7 small-12 medium-uncentered small-centered columns">
               <ul class="personal-informations">
                  <li class="title">{{ strtoupper($extras[0]->professional->company_name) }}</li>

                  <li><span class="info-label">@lang('professional.referencePerson')</span>
                  {{ strtoupper($extras[0]->professional->first_name.' '.$extras[0]->professional->last_name) }}</li>

                  <li><span class="info-label">@lang('professional.sector')</span>
                  {{ strtoupper($extras[0]->professional->category) }}</li>
               </ul>
            </div>
         </div>
         <div class="titre-extra">
               <h2>{{$extras[0]->type}} EXTRA : {{$extras[0]->professional->state}}</h2>
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
                                {{ $extras[0]->dateStartExtra().' at '.$extras[0]->timeStartExtra() }}
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
                        @if(Auth::user()->type == 0)
                          @if($listId == 3 || $listId == 2)
                            <div style="display:flex; align-items:center; margin-top: .5rem;">
                              <button><a href="{{ route('extra_cancel_application', ['username' => Auth::user()->id, 'id' => $extras[0]->id]) }}">@lang('card-content.alreadyApplied')</a></button>
                            </div>
                          @endif
                        @endif
                        @if(Auth::user()->type == 1)
                          @if($listId == 4 || $listId == 5)
                            @if($extras[0]->find == 0)
                              <ul style="width: 80%; margin-left: auto; margin-right: auto;">
                                <li class="title list-stud-title">
                                  @lang('myExtraList.studentApplied')
                                </li>
                                @if(!empty($students))
                                  @foreach($students as $student)
                                    <li class="student-applied-container">
                                      <a href = "{{ route('home', $student[0]->user_id) }}">
                                      @if(file_exists("uploads/pp/".$student[0]->user_id.".png"))
                                          <img class="profile-picture" src="{{ asset('uploads/pp/'.$student[0]->user_id.'.png') }}" alt="" />
                                      @else
                                        @if($student[0]->gender == 0)
                                                               <img class="profile-picture" src="{{ asset('images/user-student.png') }}" alt="" />
                                        @else
                                                               <img class="profile-picture" src="{{ asset('images/user-student-girl.jpg') }}" alt="" />
                                        @endif
                                      @endif
                                      {{ $student[0]->first_name . " " . $student[0]->last_name }}
                                      </a>
                                      <button class="submit-button right"><a href="{{ route('decline_application', ['username' => Auth::user()->id, 'extraID' => $extras[0]->id, 'studentID' => $student[0]->id]) }}">@lang('myExtraList.decline')</a></button>
                                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                      <button class="submit-button right"><a href="{{ $extras[0]->id.'/accept/'.$student[0]->id }}">@lang('myExtraList.accept')</a></button>
                                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    </li>
                                  @endforeach
                                @endif
                              </ul>
                            @endif
                            <ul style="width: 80%; margin-left: auto; margin-right: auto;">
                              <li class="title list-stud-title">
                                @lang('myExtraList.studentChosen')
                              </li>
                              @if(!empty($studentsAlreadyChosen))
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
                                      <button class="submit-button right"><a href="">CONTRAT</a></button>
                                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    </div>
                                  </li>
                                @endforeach
                              @endif
                            </ul>
                          @endif
                        @endif
              
                 </div>
                    @endif
                </div>