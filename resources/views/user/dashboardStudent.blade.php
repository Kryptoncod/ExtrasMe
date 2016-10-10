@extends('layouts.master', ["title" => trans('profile.title.favExtras'), "footer" => false])
@section('content')

   <div class="row collapse profile profile-container">
      @include('user.sidebar')

      <div class="medium-10 small-12 columns panel-main">

         <div class="row">
            <span class="profile-date"><a href="{{ route('calendar', Auth::user()->id) }}">{{ strtoupper(date('h:i A D j M Y')) }}</a></span>
         </div>
         <div class="dashboard-container">
            <div class="dashboard-rightpan">
               <div class="two-blocks" style="margin-top:30px; margin-bottom:30px;">
                  <div class="one-block">
                     <h2>@lang('dashboardStudent.totalEarned')</h2>
                     <div class="stat-content" style=" flex-direction:column;">
                        <div style="display:flex; justify-content:center; width: 80%; margin: 0 auto 0 auto;">
                           <blockquote>{{ $dashboard->total_earned }}</blockquote>
                        </div>
                        <div style="display:flex; justify-content:flex-end; width: 80%; margin: 0 auto 0 auto;">
                           <blockquote style="font-size: 30px;">CHF</blockquote>
                        </div>
                     </div>
                  </div>
                  @if($timeLeft <= 5)
                     <a class="warning_register"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                     <div class="warning_box">
                        <p style="color: white;">@lang('dashboardStudent.numberHoursLeft')</p>
                     </div>
                     </a></li>
                  @endif
                  <div class="one-block">
                     <h2>@lang('dashboardStudent.totalHours')</h2>
                     <div class="stat-content">
                        <div style="display:flex; justify-content:center; flex-direction: column; margin-left: 40px;">
                           <blockquote style="height: 70px;">{{ $dashboard->total_hours }}</blockquote>
                        </div>
                        <div style="display:flex; justify-content:center; flex-direction:column;">
                           <blockquote style="font-size: 30px; height: 70px;">HRS</blockquote>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="two-blocks" style="margin-bottom:50px;">
                  <div class="one-block">
                     <h2>@lang('dashboardStudent.numberExtras')</h2>
                     <div class="stat-content" style="flex-direction:column;">
                        <div style="margin:auto; width: 170px;">
                           <div>
                              <blockquote style="letter-spacing: 0; margin-bottom: 10px;">{{ $dashboard->numbers_extras }}</blockquote>
                           </div>
                           <div>
                              <blockquote style="font-size:45px;letter-spacing: 2; margin-bottom: 10px;">EXTRAS</blockquote>
                           </div>
                           <div>
                              <blockquote style="font-size:25px;letter-spacing: 0;">IN <span style="margin-left:5px; margin-right: 5px;"> {{ $dashboard->numbers_establishement }} </span> ESTABLISHMENTS</blockquote>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="one-block">
                     <h2>@lang('dashboardStudent.profileStrength')</h2>
                     <div class="stat-content">
                        <div style="margin:auto; width: 70px;">
                           <blockquote style="letter-spacing: 0; width: 20px; margin:auto;">{{ $dashboard->level }}</blockquote>
                           <div style="width: 100%; margin:auto; border: 1px solid white;"></div>
                           <blockquote style="letter-spacing: 0;width: 20px; margin:auto;">5</blockquote>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         
      </div>
   </div>

@endsection

