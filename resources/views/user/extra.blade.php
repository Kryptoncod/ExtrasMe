@extends('layouts.master', ["title" => trans('profile.title.student', ["name" => $user->username]), "footer" => false])
@section('content')

   <div class="row collapse profile profile-container">
      @include('user.sidebar', ['nav' => ['MY PAST EXPERIENCE' => ''], 'formType' => 0])

      <div class="medium-10 small-12 columns panel-main">

      <div class="row">
            <span class="profile-date"><a href="{{ route('calendar', Auth::user()->id) }}">{{ strtoupper(date('h:i A D j M Y')) }}</a></span>
         </div>

      <div class="liste-extra-container">

        @if(!$extras->first())
          <p class="empty-notice">Sorry, no extra available at the moment. Come back later</p>
        @else

        <div class="extra-list">
          <ul id="liste-extra" style="width: 90%; margin-left: auto; margin-right: auto;">
              @for($i=0; $i < count($extras); $i++)
                    <div style="width:100%; height:1px; background-color:white;"></div>
                    <li data-cardid="{{$extras[$i]->id}}" class="showCard <?php if($i == 0){ echo "active"; }?>" style="list-style-type:none; padding-top:20px; padding-bottom :20px; cursor:pointer;">{{ $extras[$i]->type }} Extra: {{ $professional[$i]->company_name }}</li>
                    <div style="width:100%; height:1px; background-color:white;"></div>
              @endfor
          </ul>
        </div>
        <div class="arrow-container">
          <img src="{{ asset('images/right-arrow.png') }}" style="margin:auto; width:90%;">
        </div>
        <div id="card-container">
          <div class="row account-resume" style="width: 90%;">
            <div class="columns medium-3 medium-uncentered small-centered picture-column small-7" style="padding: 0;">
               @if(file_exists("uploads/pp/".$professional[0]->user_id.".png"))
                  <img class="profile-picture" src=" uploads/pp/{{$professional[0]->user_id}}.png" alt="" />
               @else
                  <img class="profile-picture" src="{{ asset('images/user-professional.png') }}" alt="" />
               @endif
            </div>

            <div class="medium-7 small-12 medium-uncentered small-centered columns">
               <ul class="personal-informations">
                  <li class="title">{{ strtoupper($professional[0]->company_name) }}</li>

               @if(Auth::user()->id == $username)
                  <li><span class="info-label">@lang('professional.email')</span>
                  {{ strtoupper($email) }}</li>

                  <li><span class="info-label">@lang('professional.contactNumber')</span>
                  {{ strtoupper($professional[0]->phone) }}</li>
               @endif

                  <li><span class="info-label">@lang('professional.referencePerson')</span>
                  {{ strtoupper($professional[0]->first_name.' '.$professional[0]->last_name) }}</li>

                  <li><span class="info-label">@lang('professional.sector')</span>
                  {{ strtoupper($professional[0]->category) }}</li>
               </ul>
            </div>
         </div>
         <div class="titre-extra">
               <h2>{{$extras[0]->type}} EXTRA : {{$professional[0]->state}}</h2>
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
                                French
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
          @if($student->registration_done == 1)   
            @if($student->extras->first())
                @if($can_apply == 1)
                  <div style="width: 90%;">
                    <a href="{{ route('extra_apply',  ['id' => $extras[0]->id, 'username' => $user->id]) }}" class="apply-button right main-button">@lang('card-content.apply')</a>
                  </div>
                @else
                    <div style="width: 90%;">
                      <a href="" class="apply-button right main-button" style="pointer-events: none;cursor: default;">@lang('card-content.alreadyApplied')</a>
                  </div>
                @endif
            @else
              <div style="width:90%;">
                <a href="{{ route('extra_apply',  ['id' => $extras[0]->id, 'username' => $user->id]) }}" class="apply-button right main-button">@lang('card-content.apply')</a>
              </div>
            @endif
          @else
            <div style="width: 90%;">
                <a href="{{ route('account', Auth::user()->id)}}" class="main-button">@lang('card-content.cantApply')</a>
              </div>
          @endif
      </div>
@endif
   </div>
   </div>
</div>
   <script type="text/javascript">
     var url = "{{ route('getCard') }}"
   </script>
@endsection
