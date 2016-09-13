@extends('layouts.master')
@section('content')
   <div style="background-color: #040D2A">
      <div class="form" style="padding : 0; margin : 0; width: 100%; margin:auto;">
      
            <div style="width: 100%; background: url(images/section1_image-mirroir.jpg) center center no-repeat; background-size: cover;">
               <div style="padding-top:80px; width: 80%; margin:auto;">
                  <h1 class="form-title" style="font-family:'ostrich'; letter-spacing:10px;text-align:left; margin:0;">@lang('index.missionStatement.title')</h1>
               </div>
            </div>
      
         <div class="row">
            <div class="small-12 medium-centered columns" style="margin-top:3rem;">
               <p style="color : white; text-align:center; font-family:'grotesqueregular'; letter-spacing:2px;">@lang('index.missionStatement.content')</p>
            </div>
         </div>
      
      </div>
   </div>
@endsection
