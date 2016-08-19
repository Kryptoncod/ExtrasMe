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
                     <ul>
                         @for($i=0; $i < count($extras); $i++)
                               <div style="width:100%; height:1px; background-color:white;"></div>
                               <li data-cardid="{{$extras[$i]->id}}" class="showCard <?php if($i == 0){ echo "active"; }?>" style="list-style-type:none; padding-top:20px; padding-bottom :20px; cursor:pointer;">{{ $extras[$i]->type }} Extra: {{ $professional[$i] }}</li>
                               <div style="width:100%; height:1px; background-color:white;"></div>
                         @endfor
                     </ul>
                   </div>
                   <div style="width:5%;display:flex;">
                     <img src="{{ asset('images/right-arrow.png') }}" style="margin:auto; width:90%;">
                   </div>
                   <div style="display:flex; flex-direction:column; width:55%; align-items:center" id="card-container">
                     <img src="{{ asset('images/extra-background.png') }}" class="background-image" style="width:90%;"/>
                                   <table style="width:90%;" class="card-info">
                                     <thead>
                                       <tr>
                                         <td colspan="2" style="text-align:center; color:white;">
                                           KEY DETAILS
                                         </td>
                                       </tr>
                                     </thead>
                                     <tbody>
                                       <tr>
                                         <td>
                                           CATEGORY
                                         </td>
                                         <td>
                                           {{ $extras[0]->type }}
                                         </td>
                                       </tr>
                                       <tr>
                                         <td>
                                           REQUIREMENTS
                                         </td>
                                         <td>
                                           {{ $extras[0]->requirements }}
                                         </td>
                                       </tr>
                                       <tr>
                                         <td style="width:25%;">
                                           SALARY
                                         </td>
                                         <td>
                                           {{ $extras[0]->salary }} CHF/Hr
                                         </td>
                                       </tr>
                                       <tr>
                                         <td>
                                           BENEFITS
                                         </td>
                                         <td>
                                           {{ $extras[0]->benefits }}
                                         </td>
                                       </tr>
                                       <tr>
                                         <td>
                                           LANG
                                         </td>
                                         <td>
                                           French
                                         </td>
                                       </tr>
                                       <tr>
                                         <td>
                                           TIME
                                         </td>
                                         <td>
                                           {{ $extras[0]->date.' at '.$extras[0]->date_time }}
                                         </td>
                                       </tr>
                                       <tr>
                                         <td>
                                           OTHER INFORMATIONS
                                         </td>
                                         <td>
                                           @if(empty($extras[0]->informations))
                                               ANY
                                           @else
                                             {{ $extras[0]->informations}}
                                           @endif
                                         </td>
                                       </tr>
                                     </tbody>
                                   </table>
              
                 </div>
                    @endif
                </div>