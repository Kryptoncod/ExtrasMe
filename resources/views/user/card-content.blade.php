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
        {{ $extra->type }}
      </td>
    </tr>
    <tr>
      <td>
        REQUIREMENTS
      </td>
      <td>
        {{ $extra->requirements }}
      </td>
    </tr>
    <tr>
      <td style="width:25%;">
        SALARY
      </td>
      <td>
        {{ $extra->salary }} CHF/Hr
      </td>
    </tr>
    <tr>
      <td>
        BENEFITS
      </td>
      <td>
        {{ $extra->benefits }}
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
        {{ $extra->date.' at '.$extra->date_time }}
      </td>
    </tr>
    <tr>
      <td>
        OTHER INFORMATIONS
      </td>
      <td>
        @if(empty($extra->informations))
        ANY
        @else
        {{ $extra->informations}}
        @endif
      </td>
    </tr>
  </tbody>
</table>

@if($user->type == 0 && $search == 1)
  @if($student->registration_done == 1)   
              @if($student->extras->first())
                  @if($can_apply == 1)
                    <a href="{{ route('extra_apply',  ['id' => $extra->id, 'username' => $user->id]) }}" class="apply-button right">APPLY</a>
                  @endif
              @else
                <a href="{{ route('extra_apply',  ['id' => $extra->id, 'username' => $user->id]) }}" class="apply-button right">APPLY</a>
              @endif
  @else
              <div class="apply-button right">
                You didn't submit the document needed. Go in your account.
              </div>
  @endif
@elseif($user->type == 1)     
  @if($extra->find == 0)
    @if(count($extra->students) != 0)
      <ul>
        <li class="title">STUDENTS WHO HAS APPLIED :</li>
        @foreach($extra->students as $student_i)
          <li>
            <a href = "{{ route('home', $student_i->user->id) }}">{{ $student_i->first_name . " " . $student_i->last_name }}</a>
            <button class="submit-button right">Decline</button>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button class="submit-button right"><a href="{{ $extra->id.'/accept/'.$student_i->id }}">Accept</a></button>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
          </li>
        @endforeach
      </ul>
      @endif
@else
      <ul>
        <li class="title">STUDENTS CHOOSEN :</li>
        <li><a href="{{ route('home', $student->user->id) }}">{{ $student->first_name . " " . $student->last_name }}</a></li>
      </ul>
  @endif
@endif
