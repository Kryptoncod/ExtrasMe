@extends('layouts.master', ["title" => trans('profile.title.professional', ["name" => $user->username]), "footer" => false])
@section('content')

   <div class="row collapse profile profile-container">
      @include('user.sidebar', ['nav' => ['MY CREDIT' => '', 'MY EXTRAS' => route('my_extras', $username)], 'formType' => 1])

      <div class="medium-10 small-12 columns panel-main" style="display:flex; color:white; padding-top:50px;">
        @if(count($extras) == 0)
          <p class="empty-notice">You didn't submit extras</p>
        @else

          <div style="display:flex; flex-direction:column; width:90%">
            <ul>
                @foreach ($extras as $extra)
                          <li>@include('user.card', ["description" => $extra->professional->company_name . " is looking for extras in ".
                                                                   $extra->type.
                                                                   ' for '.$extra->date.' at '.$extra->date_time,
                                                  "title" => $extra->professional->company_name,
                                                  "image" => asset("../resources/assets/images/extra-card-example.png"),
                                                  "id"  => $extra->id])
                          </li>
                          <ul>
                            <li class="title">STUDENTS WHO HAS APPLIED :</li>
                            @foreach($extra->students as $student)
                              <li><a href = "{{ route('home', $student->user->id) }}">{{ $student->first_name . " " . $student->last_name }}</a></li>
                            @endforeach
                       </ul>
                       @endforeach
            </ul>
          </div>
        @endif
      </div>
  </div>
@endsection
