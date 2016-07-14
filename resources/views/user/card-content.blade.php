<img src="{{ asset('../resources/assets/images/extra-background.png') }}" class="background-image" style="width:50%;"/>
           <ul>
              <li class="title">KEY DETAILS</li>
              <li>SALARY: {{ $extra->salary }} CHF/Hr</li>
              <li>BENEFITS: {{ $extra->benefits }}</li>
              <li>LANG: FRENCH</li>
              <li>TIME: {{ $extra->date.' at '.$extra->date_time }}</li>
           </ul>
        <p>
           DESCRIPTION : {{ $extra->requirements }}
        </p>
<a href="{{ route('extra_apply', $extra->id) }}" class="apply-button right">APPLY</a>