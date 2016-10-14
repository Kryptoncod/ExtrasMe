@extends('layouts.master', ["title" => trans('profile.title.favExtras'), "footer" => false])
@section('content')

   <div class="row collapse profile profile-container">
      @include('user.sidebar')

      <div class="medium-10 small-12 columns panel-main">

         <div class="row">
            <span class="profile-date"><a href="{{ route('calendar', Auth::user()->id) }}">{{ strtoupper(date('h:i A D j M Y')) }}</a></span>
         </div>
         <hr style="margin: 0;" />
         <div class="experience-container"><div class="chrono-container">
                  <a href="" id="past" data-chrono-id = "1" class="showChrono"><label>Past</label></a>
                  <div style="display:flex; flex-direction:column;">
                    <div style="width:1px; height: 20%; background-color: #222"></div>
                    <div style="width:1px; height: 60%; background-color: grey"></div>
                    <div style="width:1px; height: 20%; background-color: #222"></div>
                  </div>
                  <a href="" id="present" data-chrono-id = "2" class="active showChrono"><label>Future</label></a>
                  <div style="display:flex; flex-direction:column;">
                    <div style="width:1px; height: 20%; background-color: #222; margin-top: auto; margin-bottom: auto;"></div>
                    <div style="width:1px; height: 60%; background-color: grey; "></div>
                    <div style="width:1px; height: 20%; background-color: #222"></div>
                  </div>
                  <a href="" id="future" data-chrono-id = "3" class="showChrono"><label>Applied</label></a>
            </div>
            <div id="list-to-append" style="display: flex; flex-direction:column;">
              <h1>Future Extras</h1>
              <div class="liste-container">
                 @if(!$extras->first())
                     <p class="empty-notice">You didn't get accept to any extras yet.</p>
                   @else
              
                   <div style="display:flex; flex-direction:column; width:40%" class="extra-list">
                     <ul id="liste-extra">
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

                           @if(Auth::user()->id == $username)
                              <li><span class="info-label">@lang('professional.email')</span>
                              {{ strtoupper($user->email) }}</li>

                              <li><span class="info-label">@lang('professional.contactNumber')</span>
                              {{ strtoupper($extras[0]->professional->phone) }}</li>
                           @endif

                              <li><span class="info-label">@lang('professional.referencePerson')</span>
                              {{ strtoupper($extras[0]->professional->first_name.' '.$extras[0]->professional->last_name) }}</li>

                              <li><span class="info-label">@lang('professional.sector')</span>
                              {{ strtoupper($extras[0]->professional->category) }}</li>
                           </ul>
                        </div>
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
                                           {{ $extras[0]->dateStartExtra().' at '.$extras[0]->timeStartExtra() }}
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
                                   <div style="display:flex; align-items:center; margin-top: .5rem;">
                                      <button><a href="{{ route('extra_cancel_application', ['username' => Auth::user()->id, 'id' => $extras[0]->id]) }}">@lang('card-content.alreadyApplied')</a></button>
                                  </div>
              
                 </div>
                    @endif
                </div>
            </div>
         </div>
      </div>
   </div>
<script type="text/javascript">
    var url = "{{ route('getCard') }}";
    var url_liste = "{{ route('getList') }}";
</script>
@endsection

