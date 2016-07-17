<img src="{{ asset('../resources/assets/images/extra-background.png') }}" class="background-image" style="width:50%;"/>
           <ul>
              <li class="title">KEY DETAILS</li>
              <li>SALARY: {{ $extra[0]->salary }} CHF/Hr</li>
              <li>BENEFITS: {{ $extra[0]->benefits }}</li>
              <li>LANG: FRENCH</li>
              <li>TIME: {{ $extra[0]->date.' at '.$extra[0]->date_time }}</li>
           </ul>
        <p>
           DESCRIPTION : {{ $extra[0]->requirements }}
        </p>
<a href="{{ route('extra_apply', $extra[0]->id) }}" class="apply-button right">APPLY</a>
