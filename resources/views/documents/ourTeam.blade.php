@extends('layouts.master')
@section('content')
   <div style="background-color: #040D2A">
      <div class="form" style="padding : 0; margin : 0; width: 100%; margin:auto;">
      
         <div style="width: 100%; background: url(images/section1_image-mirroir.jpg) center center no-repeat; background-size: cover;">
            <div style="padding-top:80px; width: 80%; margin:auto;">
               <h1 class="form-title" style="font-family:'ostrich'; letter-spacing:10px;text-align:left; margin:0;">@lang('footer.ourTeam')</h1>
            </div>
         </div>

         <div class="container">
            <div class="row" style="margin-top: 2rem;">
               <div class="columns medium-4 medium-uncentered" style="margin-bottom: 2rem;">
                  <img src="{{ asset('images/mayeul.jpg') }}" style="width:100%; height: 230px;">
                  <div style="color:white; background-color:#222; margin: 0">
                     <span class="title" style="padding:.5rem;">@lang('index.ourTeam.mayeul.title')</span>
                  </div>
                  <div style="color:white; background-color:#000; margin: 0;">
                     <p class="description" style="margin:0; padding: .5rem;">
                        @lang('index.ourTeam.mayeul.content')
                     </p>
                  </div>
               </div>
               <div class="columns medium-4 medium-uncentered" style="margin-bottom: 2rem;">
                  <img src="{{ asset('images/benjamin.png') }}" style="width:100%;  height: 230px;">
                  <div style="color:white; background-color:#222; margin: 0">
                     <span class="title" style="padding:.5rem;">@lang('index.ourTeam.benjamin.title')</span>
                  </div>
                  <div style="color:white; background-color:#000; margin: 0">
                     <p class="description" style="margin:0; padding: .5rem;">
                        @lang('index.ourTeam.benjamin.content')
                     </p>
                  </div>
               </div>
               <div class="columns medium-4 medium-uncentered" style="margin-bottom: 2rem;">
                  <img src="{{ asset('images/paul.jpg') }}" style="width:100%;  height: 230px;">
                  <div style="color:white; background-color:#222; margin: 0">
                     <span class="title" style="padding:.5rem;">@lang('index.ourTeam.paul.title')</span>
                  </div>
                  <div style="color:white; background-color:#000; margin: 0">
                     <p class="description" style="margin:0; padding: .5rem;">
                        @lang('index.ourTeam.paul.content')
                     </p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection
