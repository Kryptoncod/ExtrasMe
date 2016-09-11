@extends('layouts.master', ["title" => trans('profile.title.student', ["name" => $user->username]), "footer" => false])
@section('content')

   <div class="row collapse profile profile-container">
      @include('user.sidebar', ['nav' => ['MY PAST EXPERIENCE' => ''], 'formType' => 0])

      <div class="medium-10 small-12 columns panel-main" style="display:flex; color:white; padding-top:50px;">
        @if(!$extras->first())
          <p class="empty-notice">Sorry, no extra available at the moment. Come back later</p>
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
          <img src="{{ asset('images/extra-background.png') }}" class="background-image" style="width:90%;"/>
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
                                {{ $extras[0]->date.' at '.$extras[0]->date_time }}
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
          @if($student->registration_done == 1)   
            @if($student->extras->first())
                @if($can_apply == 1)
                  <a href="{{ route('extra_apply',  ['id' => $extras[0]->id, 'username' => $user->id]) }}" class="apply-button right">@lang('card-content.apply')</a>
                @endif
            @else
              <a href="{{ route('extra_apply',  ['id' => $extras[0]->id, 'username' => $user->id]) }}" class="apply-button right">@lang('card-content.apply')</a>
            @endif
          @else
            <div class="apply-button right">
              <a href="{{ route('account', Auth::user()->id)}}">@lang('card-content.cantApply')</a>
            </div>
          @endif

      </div>
@endif
   </div>
</div>
   <script type="text/javascript">
     var url = "{{ route('getCard') }}"
   </script>
@endsection
