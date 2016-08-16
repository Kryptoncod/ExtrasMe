@extends('layouts.master', ["title" => trans('profile.title.favExtras'), "footer" => false])
@section('content')

   <div class="row collapse profile profile-container">
      @include('user.sidebar')

      <div class="medium-10 small-12 columns panel-main">

         <div class="row">
            <span class="profile-date">{{ strtoupper(date('h:i A D j M Y')) }}</span>
         </div>
         <div style="background : url(../assets/images/section3_image.jpg)">
            <div class="row">
               <div class="large-4 medium-6 small-12 columns">
                  <h2 class="section-title">EXTRASME</h2>
               </div>
            </div>

            <div class="row">
               <div class="large-4 medium-6 small-12 columns">
                  <p>Easy to use yet capable of so much, IOS 8 was engineered to work hand in hand with the advanced technologies built into iPhone.</p>
               </div>
            </div>

            <div class="row">
               <div class="large-4 medium-6 small-12 columns">
                  <a href="http://apple.com">Learn more about IOS 8</a>
               </div>
            </div>

            <div class="row">
               <div class="large-4 medium-6 small-12 columns">
                  <h3 class="sub-title">IOS 9 coming this fall.</h3>
               </div>
            </div>

            <div class="row">
               <div class="large-4 medium-6 small-12 columns">
                  <a href="http://apple.com">Get a preview of the next release of IOS</a>
               </div>
            </div>

            <div class="row app-stores">
               <div class="large-2 medium-3 small-6 columns">
                  <a href="https://apple.com"><img alt="Get it on App Store" src="../assets/images/App_Store.svg" /></a>
               </div>
               <div class="large-2 medium-3 small-6 columns end">
                  <a href="https://play.google.com"><img alt="Get it on Google Play" src="https://developer.android.com/images/brand/en_generic_rgb_wo_45.png" /></a>
               </div>
            </div>
         </div>
      </div>
   </div>

@endsection

