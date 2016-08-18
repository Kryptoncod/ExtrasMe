<img src="{{ asset('images/extra-background.png') }}" class="background-image" style="width:90%;"/>
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

@if($student->registration_done == 1)   
            @if($student->extras->first())
                @if($can_apply == 1)
                  <a href="{{ route('extra_apply',  ['id' => $extra->id, 'username' => $user_id]) }}" class="apply-button right">APPLY</a>
                @endif
            @else
              <a href="{{ route('extra_apply',  ['id' => $extra->id, 'username' => $user_id]) }}" class="apply-button right">APPLY</a>
            @endif
          @else
            <div class="apply-button right">
              You didn't submit the document needed. Go in your account.
            </div>
          @endif