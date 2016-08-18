@extends('layouts.master', ["title" => trans('profile.title.professional', ["name" => $user->username]), "footer" => false])
@section('content')

   <div class="row collapse profile profile-container">
      @include('user.sidebar')

      <div class="medium-10 small-12 columns panel-main" style="display:flex; color:white; padding-top:50px;">

        @if(empty($extras))
          <p class="empty-notice">You didn't submit any extra.</p>
        @else

        <div style="display:flex; flex-direction:column; width:40%" class="extra-list">
          <ul>
              @for($i=0; $i < count($extras); $i++)
                    <div style="width:100%; height:1px; background-color:white;"></div>
                    <li data-cardid="{{$i+1}}" class="showCard <?php if($i == 0){ echo "active"; }?>" style="list-style-type:none; padding-top:20px; padding-bottom :20px; cursor:pointer;">{{ $extras[$i]->type }} Extra: {{ $professional->comany_name }}</li>
                    <div style="width:100%; height:1px; background-color:white;"></div>
              @endfor
          </ul>
        </div>
        <div style="width:5%;display:flex;">
          <img src="../../resources/assets/images/right-arrow.png" style="margin:auto; width:90%;">
        </div>
        <div style="display:flex; flex-direction:column; width:55%; align-items:center" id="card-container">
          <img src="{{ asset('../resources/assets/images/extra-background.png') }}" class="background-image" style="width:90%;"/>
                        <table style="width:80%;" class="card-info">
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
                        <ul>
                            <li class="title">STUDENTS WHO HAS APPLIED :</li>
                            @foreach($extras[0]->students as $student)
                              <li>
                                <a href = "{{ route('home', $student->user->id) }}">{{ $student->first_name . " " . $student->last_name }}</a>
                                <button class="submit-button right">Decline</button>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button class="submit-button right"><a href="{{ $extras[0]->id.'/accept/'.$student->id }}">Accept</a></button>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              </li>
                            @endforeach
                       </ul>
                      </div>
                    @endif
                </div>
              </div>
   <script type="text/javascript">
     var url = "{{ route('getCard') }}"
   </script>
@endsection
