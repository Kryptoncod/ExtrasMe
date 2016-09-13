@extends('layouts.master')
@section('content')
   <div class="form" style="padding : 0; margin : 0;">

      <div class="row missionStatement" style="margin:0;">
         <div class="small-centered columns">
            <h1 class="form-title" style="font-family:'ostrich'; letter-spacing:10px; line-height:200px; text-align:left;">@lang('index.missionStatement.title')</h1>
         </div>
      </div>

      <div class="row">
         <div class="small-12 medium-centered columns" style="margin-top:3rem;">
            <p style="color : white; text-align:center; font-family:'grotesqueregular'; letter-spacing:2px;">@lang('index.missionStatement.content')</p>
         </div>
      </div>

   </div>
@endsection
