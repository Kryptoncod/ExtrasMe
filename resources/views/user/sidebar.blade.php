<div class="medium-2 small-12 columns panel-sidebar">
   <ul class="side-nav">
      <li class="highlight head" style="width:88%; margin-left:auto; margin-right:auto;">MY EXTRASME</li>
      <li><a href="{{ route('home', Auth::user()->id) }}">HOME</a></li>
      <li><a>ACCOUNT</a></li>
      @if(Auth::user()->type == 0)
         <li><a href="">MY PAST EXPERIENCE</a></li>
      @elseif(Auth::user()->type == 1)
         <li><a href="">MY CREDIT</a></li>
      @endif
      <li><a href="{{ route('my_extras', $username) }}">MY EXTRAS</a></li>
      <li><a>MY FAV EXTRAS</a></li>
      <li><a>DASHBOARD</a></li>
      <li><a>EXTRASME APP</a></li>
   </ul>

   @if(Auth::user()->type == 0)
      <span class="separator"></span>

      <form data-abide action="{{ route('extra_search', $username) }}" method="post">
         <ul class="form">
            <li class="head highlight">FIND EXTRAS</li>
            <li>
               <select class="input" name="type" aria-label="Type of extra">
                  <option selected disabled value="">TYPE OF EXTRA</option>
                  @foreach(config('international.last_minute_types') as $id => $nameType)
                     <option value="{{ $id }}">{{ $nameType }}</option>
                  @endforeach
               </select>
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
