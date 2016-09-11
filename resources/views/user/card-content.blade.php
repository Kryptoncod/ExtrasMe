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
        {{ $extra->type }}
      </td>
    </tr>
    <tr>
      <td>
        @lang('card-content.requirements')
      </td>
      <td>
        {{ $extra->requirements }}
      </td>
    </tr>
    <tr>
      <td style="width:25%;">
        @lang('card-content.salary')
      </td>
      <td>
        {{ $extra->salary }} CHF/Hr
      </td>
    </tr>
    <tr>
      <td>
        @lang('card-content.benefits')
      </td>
      <td>
        {{ $extra->benefits }}
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
        {{ $extra->date.' at '.$extra->date_time }}
      </td>
    </tr>
    <tr>
      <td>
        @lang('card-content.otherInfos')
      </td>
      <td>
        @if(empty($extra->informations))
          @lang('card-content.noOtherInfo')
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
                    <a href="{{ route('extra_apply',  ['id' => $extra->id, 'username' => $user->id]) }}" class="apply-button right">@lang('card-content.apply')</a>
                  @else
                    <div class="apply-button right">
                      @lang('card-content.alreadyApplied')
                  </div>
                  @endif
              @else
                <a href="{{ route('extra_apply',  ['id' => $extra->id, 'username' => $user->id]) }}" class="apply-button right">@lang('card-content.apply')</a>
              @endif
  @else
              <div class="apply-button right">
                <a href="{{ route('account', Auth::user()->id)}}">@lang('card-content.cantApply')</a>
              </div>
  @endif
@elseif($user->type == 1)     
  @if($extra->find == 0)
    @if(count($extra->students) != 0)
      <ul>
        <li class="title">@lang('myExtraList.studentApplied')</li>
        @foreach($extra->students as $student_i)
          <li>
            <a href = "{{ route('home', $student_i->user->id) }}">{{ $student_i->first_name . " " . $student_i->last_name }}</a>
            <button class="submit-button right">@lang('myExtraList.decline')</button>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button class="submit-button right"><a href="{{ $extra->id.'/accept/'.$student_i->id }}">@lang('myExtraList.accept')</a></button>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
          </li>
        @endforeach
      </ul>
      @endif
@else
      <ul>
        <li class="title">@lang('myExtraList.studentChosen')</li>
        <li><a href="{{ route('home', $student->user->id) }}">{{ $student->first_name . " " . $student->last_name }}</a></li>
      </ul>
  @endif
@endif
