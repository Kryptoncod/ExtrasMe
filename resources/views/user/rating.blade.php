@extends('layouts.master', ["title" => trans('profile.title.professional', ["name" => $user->username]), "footer" => false])
@section('content')

   <div class="row collapse profile profile-container">
      @include('user.sidebar')

      <div class="medium-10 small-12 columns panel-main">

         <div class="row">
            <span class="profile-date"><a href="{{ route('calendar', Auth::user()->id) }}">{{ Carbon\Carbon::now('Europe/Paris')->formatLocalized('%A %d %B %Y') }}</a></span>
         </div>

         <form action="{{ route('rate', [Auth::user()->id,
                       $extra->id]) }}" method="post">
         @foreach($studentToRate as $id => $student)
               <div class="rating-container">
                  <div class="profile-image-container">
                     @if(file_exists("uploads/pp/".$student->user->id.".png"))
                        <img src="{{ asset('uploads/pp/'.$student->user->id.'.png') }}" alt="" />
                     @else
                        <img src="{{ asset('images/user-student.png') }}" alt="" />
                     @endif
                  </div>
                  <div class="marks-container">
                     <div class="hours-done">
                        <h2>@lang('rate.hours.title', ['type' => $extra->type])</h2>
                        <h3>@lang('rate.hours.supposed', ['duration' => $extra->duration])</h3>
                        <div class="nb-input-container">
                           <h3>@lang('rate.hours.reallyMade')</h3>
                           <input style="width: 100px;" type="number" min="0" name="hours" id="hours" required />
                        </div>
                     </div>
                     <div class="mark-given">
                        <h2>@lang('rate.content', array('student' => $student->first_name.' '.$student->last_name, 'type' => $extra->type))</h2>
                        <div class="level-container">
                           <ul class="notes-echelle">
                              <li>
                                 <label for="note01" title="Note&nbsp;: 1 sur 5"></label>
                                 <input type="radio" name="rate{{$id}}" id="note01" value="1" />
                              </li>
                              <li>
                                 <label for="note02" title="Note&nbsp;: 2 sur 5"></label>
                                 <input type="radio" name="rate{{$id}}" id="note02" value="2" />
                              </li>
                              <li>
                                 <label for="note03" title="Note&nbsp;: 3 sur 5"></label>
                                 <input type="radio" name="rate{{$id}}" id="note03" value="3" />
                              </li>
                              <li>
                                 <label for="note04" title="Note&nbsp;: 4 sur 5"></label>
                                 <input type="radio" name="rate{{$id}}" id="note04" value="4" />
                              </li>
                              <li>
                                 <label for="note05" title="Note&nbsp;: 5 sur 5"></label>
                                 <input type="radio" name="rate{{$id}}" id="note05" value="5" />
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
               <input type="hidden" name="studentID{{$id}}" id="note05" value="{{$student->id}}" />
         @endforeach

         <button class="submit-button right">@lang('rate.rate')</button>
         <input type="hidden" name="_token" value="{{ csrf_token() }}">
         </form>
         
      </div>
   </div>

@endsection
