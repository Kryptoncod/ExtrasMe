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
                                 <li data-cardid="{{$extras[$i]->id}}" class="showCard <?php if($i == 0){ echo "active"; }?>" style="list-style-type:none; padding-top:20px; padding-bottom :20px; cursor:pointer;">{{ $extras[$i]->type }} Extra: {{ $professional->company_name }}</li>
                                 <div style="width:100%; height:1px; background-color:white;"></div>
                           @endfor
                       </ul>
                     @endif
                   </div>
                   <div style="width:5%;display:flex;">
                     <img src="{{ asset('images/right-arrow.png') }}" style="margin:auto; width:90%;">
                   </div>
                   <div style="display:flex; flex-direction:column; width:55%; align-items:center" id="card-container">
                     <img src="{{ asset('images/user-professional.png') }}" class="background-image" style="width:90%;"/>
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
                                         <td style="width:25%;">
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
                                           French
                                         </td>
                                       </tr>
                                       <tr>
                                         <td>
                                           @lang('card-content.time')
                                         </td>
                                         <td>
                                           {{ $extra->dateExtra().' at '.$extra->timeExtra() }}
                                         </td>
                                       </tr>
                                       <tr>
                                         <td>
                                           @lang('card-content.otherInfo')
                                         </td>
                                         <td>
                                           @if(empty($extras[0]->informations))
                                               @lang('card-content.noOtherInfo')
                                           @else
                                             {{ $extras[0]->informations}}
                                           @endif
                                         </td>
                                       </tr>
                                     </tbody>
                                   </table>
                                  @if(Auth::user()->type == 1)
                                   @if($extras[0]->find == 0)
                                    <ul>
                                        <li class="title">@lang('myExtraList.studentApplied')</li>
                                        @foreach($students as $student)
                                          <li>
                                            <a href = "{{ route('home', $student[0]->user->id) }}">{{ $student[0]->first_name . " " . $student[0]->last_name }}</a>
                                            <button class="submit-button right">@lang('myExtraList.decline')</button>
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button class="submit-button right"><a href="{{ $extras[0]->id.'/accept/'.$student[0]->id }}">@lang('myExtraList.accept')</a></button>
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                          </li>
                                        @endforeach
                                    </ul>
                                  @else
                                    <ul>
                                        <li class="title">@lang('myExtraList.studentChosen')</li>
                                        <li><a href="{{ route('home', $student->user->id) }}">{{ $student->first_name . " " . $student->last_name }}</a></li>
                                    </ul>
                                  @endif
                                @endif
              
                 </div>
                    @endif
                </div>