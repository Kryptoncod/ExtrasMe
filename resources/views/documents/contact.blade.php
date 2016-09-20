@extends('layouts.master')
@section('content')
   <div style="background-color: #040D2A">
      <div class="form" style="padding : 0; margin : 0; width: 100%; margin:auto;">
      
         <div style="width: 100%; background: url(images/section1_image-mirroir.jpg) center center no-repeat; background-size: cover;">
            <div style="padding-top:80px; width: 80%; margin:auto;">
               <h1 class="form-title" style="font-family:'ostrich'; letter-spacing:10px;text-align:left; margin:0;">@lang('index.contactUs.contactDetails')</h1>
            </div>
         </div>

         <div class="container">
            <div class="row">
               <div class="col-md-6">
                  @lang('index.contactUs.extrame')
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection
