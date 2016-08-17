@extends('layouts.master', ["title" => trans('profile.title.favExtras'), "footer" => false])
@section('content')

   <div class="row collapse profile profile-container">
      @include('user.sidebar')

      <div class="medium-10 small-12 columns panel-main">

         <div class="row">
            <span class="profile-date">{{ strtoupper(date('h:i A D j M Y')) }}</span>
         </div>
         <div class="dashboard-container">
            <div class="dashboard-leftpan">
               <h2 style="padding:20px;">YOUR EXTRAS</h2>
               <div class="search-bar">
                  <label for="search"><i class="icon-search"></i></label>
                  <input type="search" name="search-extras" placeholder="SEARCH" id="search">
               </div>
               <h2 style="margin: auto; margin-top:30px;">APPLIED EXTRAS</h2>
               <hr>
               <div>
                  <div class="extra">
                     <span class="level-logo completed"></span>
                     <h3>21/07 TOUR EIFFEL PARIS</h3>
                  </div>
                  <div class="extra">
                     <span class="level-logo completed"></span>
                     <h3>21/07 TOUR EIFFEL PARIS</h3>
                  </div>
               </div>
               <hr>
               <h2 style="margin: auto;">PAST EXTRAS</h2>
               <hr>
               <div>
                  <div class="extra">
                     <span class="level-logo"></span>
                     <h3>21/07 TOUR EIFFEL PARIS</h3>
                  </div>
                  <div class="extra">
                     <span class="level-logo"></span>
                     <h3>21/07 TOUR EIFFEL PARIS</h3>
                  </div>
                  <div class="extra">
                     <span class="level-logo"></span>
                     <h3>21/07 TOUR EIFFEL PARIS</h3>
                  </div>
               </div>
            </div>
            <div class="dashboard-rightpan">
               <div class="two-blocks">
                  <div class="one-block">
                     <h2>TOTAL AMOUNT EARNED</h2>
                     <div class="stat-content" style=" flex-direction:column;">
                        <div style="display:flex; justify-content:center; width: 80%; margin: 0 auto 0 auto;">
                           <blockquote>{{ $dashboard->total_earned }}</blockquote>
                        </div>
                        <div style="display:flex; justify-content:flex-end; width: 80%; margin: 0 auto 0 auto;">
                           <blockquote style="font-size: 30px;">CHF</blockquote>
                        </div>
                     </div>
                  </div>
                  <div class="one-block">
                     <h2>TOTAL EXTRA HOURS</h2>
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
               <div class="two-blocks">
                  <div class="one-block">
                     <h2>NUMBER OF EXTRAS</h2>
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
                     <h2>PROFILE STRENGTH</h2>
                     <div class="stat-content">
                        <div style="margin:auto; width: 70px;">
                           <blockquote style="letter-spacing: 0; width: 20px; margin:auto;">{{ $dashboard->level }}</blockquote>
                           <div style="width: 100%; margin:auto; border: 1px solid white;"></div>
                           <blockquote style="letter-spacing: 0;width: 35px; margin:auto;">10</blockquote>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         
      </div>
   </div>

@endsection

