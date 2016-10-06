@extends('layouts.master', ["title" => trans('profile.title.favExtras'), "footer" => false])
@section('content')

   <div class="row collapse profile profile-container">
      @include('user.sidebar')

      <div class="medium-10 small-12 columns panel-main">

         <div class="row">
            <span class="profile-date"><a href="{{ route('calendar', Auth::user()->id) }}">{{ strtoupper(date('h:i A D j M Y')) }}</a></span>
         </div>
         
         <div class="extrasme-app-container">
            <div class="title-app-container">
               <h2 class="section-title" style="color: black; border:none;">@lang('index.section3.content')</h2>
            </div>
            <div class="img-app-container">
               <img src="{{asset('images/section3_image_small.jpg')}}">
            </div>
         </div>
      </div>
   </div>

@endsection

