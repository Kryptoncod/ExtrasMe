<div class="medium-2 small-12 columns panel-sidebar">
   <ul class="side-nav">
      <li><a href="{{ url('/home') }}">YOUR EXTRASME</a></li>
      <li><a>ACCOUNT</a></li>
      @foreach($nav as $key => $link)
         <li><a href="{{ $link }}">{{ $key }}</a></li>
      @endforeach
      <li><a>MY FAV EXTRAS</a></li>
      <li><a>DASHBOARD</a></li>
      <li><a>EXTRASME APP</a></li>
   </ul>

   @if($formType == 0)
      <span class="separator"></span>

      <form data-abide action="{{ route('extra_search') }}" method="post">
         <ul class="form">
            <li class="head">FIND EXTRAS</li>
            <li>
               <select class="input" name="type" aria-label="Type of extra" required>
                  <option selected disabled value="">TYPE OF EXTRA</option>
                  @foreach(config('international.last_minute_types') as $id => $name)
                     <option value="{{ $id }}">{{ $name }}</option>
                  @endforeach
               </select>
               <small class="error">Type of extra is required</small>
            </li>

            <li>
               <input type="text" name="location" placeholder="LOCATION" aria-label="Location" required>
               <small class="error">Location is required.</small>
            </li>

            <li>
               <input type="text" name="date" placeholder="DATE (mm/dd/yyyy)" aria-label="Date (mm/dd/yyyy)" value="{{ date('m/d/Y') }}" pattern="month_day_year" data-abide-validator="after_now" required>
               <small class="error">Date is required and must be mm/dd/yyyy.</small>
            </li>

            <li>
               <button class="submit-button right">SEARCH</button>
               <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </li>

         </ul>
      </form>

   @endif


</div>
