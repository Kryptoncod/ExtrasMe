@extends('layouts.master')
@section('content')
   <div style="background-color: #040D2A">
      <div class="form" style="padding : 0; margin : 0; width: 100%; margin:auto;">
      
         <div style="width: 100%; background: url(images/section1_image-mirroir.jpg) center center no-repeat; background-size: cover;">
            <div style="padding-top:80px; width: 80%; margin:auto;">
               <h1 class="form-title" style="font-family:'ostrich'; letter-spacing:10px;text-align:left; margin:0;">@lang('footer.contactUs')</h1>
            </div>
         </div>

         <div class="container">
            <div class="row">
               <div class="medium-6">
                  <h2 style="letter-spacing:10px; text-transform: uppercase; color:#90aaff">@lang('index.contactUs.contactDetails')</h2>
                     <div class="medium-6">
                        <p style="margin-bottom:5px; color:white">@lang('index.contactUs.extrasme')</p>
                     </div>
                     <div class="medium-9">
                        <p style="margin-bottom:5px; color:white">@lang('index.contactUs.address')</p>
                     </div>
                     <div class="medium-9">
                        <p style="margin-bottom:5px; color:white">@lang('index.contactUs.email')</p>
                     </div>
                     <div class="medium-9">
                        <p style="margin-bottom:5px; color:white">@lang('index.contactUs.telephoneNumber')</p>
                     </div>
               </div>
            </div>
            <div class="row">
               <div class="columns medium-6" style="padding:0">
                  <h2 style="letter-spacing:10px; text-transform: uppercase; color:#90aaff">@lang('index.contactUs.mayeul.title')</h2>
                  <div class="medium-9">
                     <p style="margin-bottom:5px; color:white">@lang('index.contactUs.mayeul.position')</p>
                  </div>
                  <div class="medium-9">
                     <p style="margin-bottom:5px; color:white">@lang('index.contactUs.mayeul.email')</p>
                  </div>
               </div>
               <div class="columns medium-6 ">
                  <h2 style="letter-spacing:10px; text-transform: uppercase; color:#90aaff">@lang('index.contactUs.paul.title')</h2>
                  <div class="medium-9">
                     <p style="margin-bottom:5px; color:white">@lang('index.contactUs.paul.position')</p>
                  </div>
                  <div class="medium-9">
                     <p style="margin-bottom:5px; color:white">@lang('index.contactUs.paul.email')</p>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <h2 style="letter-spacing:10px; text-transform: uppercase; color:#90aaff">@lang('index.contactUs.benjamin.title')</h2>
                  <div class="medium-9">
                     <p style="margin-bottom:5px; color:white">@lang('index.contactUs.benjamin.position')</p>
                  </div>
                  <div class="medium-9">
                     <p style="margin-bottom:5px; color:white">@lang('index.contactUs.benjamin.email')</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection
