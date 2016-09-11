<div class="medium-2 small-12 columns panel-sidebar">
   <ul class="side-nav">
      <li class="highlight head" style="width:88%; margin-left:auto; margin-right:auto;    color: #FFF;
    font-weight: 700;
    margin-bottom: 1.25rem;
    font-size: .875rem;">@lang('sidebar.myExtrasme')</li>
      <li><a href="{{ route('home', Auth::user()->id) }}">@lang('sidebar.home')</a></li>
      <li><a href="{{ route('account', Auth::user()->id) }}">@lang('sidebar.account')</a></li>
      @if(Auth::user()->type == 0)
         <li><a href="{{ route('experience', Auth::user()->id) }}">@lang('sidebar.myExperiences')</a></li>
      @elseif(Auth::user()->type == 1)
         <li><a href="">@lang('sidebar.myCredit')</a></li>
         <li><a href="{{ route('my_extras', Auth::user()->id) }}">@lang('sidebar.myExtras')</a></li>
      @endif
      <li><a href="{{ route('dashboard', Auth::user()->id)}}">@lang('sidebar.dashboard')</a></li>
      <li><a href="{{ route('my_favorite_extras', Auth::user()->id) }}">@lang('sidebar.myFavExtras')</a></li>
      <li><a href="{{ route('applicationDownload', Auth::user()->id) }}">@lang('sidebar.extrasmeApp')</a></li>
   </ul>

   @if(Auth::user()->type == 0)
      <span class="separator"></span>

      <form data-abide action="{{ route('extra_search', Auth::user()->id) }}" method="post">
         <ul class="form">
            <li class="head highlight">@lang('sidebar.findExtras')</li>
            <li>
               <select class="input" name="type" aria-label="Type of extra">
                  <option selected disabled value="">@lang('sidebar.typeExtras')</option>
                  @foreach(config('international.last_minute_types') as $id => $nameType)
                     <option value="{{ $id }}">{{ $nameType }}</option>
                  @endforeach
               </select>
            </li>

            <li>
               <input type="text" name="location" placeholder=@lang('sidebar.location') aria-label="Location" required>
               <small class="error">@lang('sidebar.errorLocation')</small>
            </li>

            <li>
               <input type="text" name="date" placeholder="DATE (mm/dd/yyyy)" aria-label="Date (mm/dd/yyyy)" value="{{ date('m/d/Y') }}" pattern="month_day_year" data-abide-validator="after_now" required>
               <small class="error">@lang('sidebar.errorDate')</small>
            </li>

            <li>
               <button class="submit-button right">@lang('sidebar.search')</button>
               <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </li>

         </ul>
      </form>
   @endif
</div>
