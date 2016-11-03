@extends('layouts.master', ["title" => trans('profile.title.favExtras'), "footer" => false])
@section('content')

   <div class="row collapse profile profile-container">
      @include('user.sidebar')

      <div class="medium-10 small-12 columns panel-main">

         <div class="row">
            <span class="profile-date"><a href="{{ route('calendar', Auth::user()->id) }}">{{ Carbon\Carbon::now('Europe/Paris')->formatLocalized('%A %d %B %Y') }}</a></span>
         </div>
         <div class="dashboard-container">
            <div class="dashboard-rightpan">
               <div class="two-blocks">
                  <div class="one-block">
                     <h2>@lang('dashboardProfessional.totalEarned')</h2>
                     <div class="stat-content" style=" flex-direction:column;">
                        <div style="display:flex; justify-content:center; width: 80%; margin: 0 auto 0 auto;">
                           <blockquote>{{ $economise }}</blockquote>
                        </div>
                        <div style="display:flex; justify-content:flex-end; width: 80%; margin: 0 auto 0 auto;">
                           <blockquote style="font-size: 30px;">CHF</blockquote>
                        </div>
                     </div>
                  </div>
                  <div class="one-block">
                     <h2>@lang('dashboardProfessional.creditLeft')</h2>
                     <div class="stat-content">
                        <div style="display:flex; justify-content:center; flex-direction: column; margin-left: 40px;">
                           <blockquote style="height: 70px;">{{ $professional->credit }}</blockquote>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="two-blocks">
                  <div class="one-block">
                     <h2>@lang('dashboardProfessional.numberAnnouces')</h2>
                     <div class="stat-content" style="flex-direction:column;">
                        <div style="margin:auto; width: 170px;">
                           <div>
                              <blockquote style="letter-spacing: 0; margin-bottom: 10px;">{{ $numberOfExtras->count() }}</blockquote>
                           </div>
                           <div>
                              <blockquote style="font-size:45px;letter-spacing: 2; margin-bottom: 10px;">EXTRAS</blockquote>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="one-block">
                     <h2>@lang('dashboardProfessional.remainingDays')</h2>
                     <div class="stat-content">
                        <div style="margin:auto; width: 70px;">
                           @if($daysLeft->first() != null)
                              <blockquote style="letter-spacing: 0; width: 20px; margin:auto;">{{ 365 - $daysLeft->first()->updated_at->diffInDays(Carbon\Carbon::now()) }}</blockquote>
                           @else
                              <blockquote style="letter-spacing: 0; margin:auto;">No invoices yet</blockquote>
                           @endif
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         
      </div>
   </div>

@endsection

