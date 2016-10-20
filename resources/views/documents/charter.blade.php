@extends('layouts.master')
@section('content')
   <div style="background-color: #040D2A">
      <div class="form" style="padding : 0; margin : 0; width: 100%; margin:auto;">
      
            <div style="width: 100%; background: url(images/annexe_test.jpg) center center no-repeat; background-size: cover;">
               <div style="padding-top:200px; width: 80%; margin:auto;">
                  <h1 class="form-title" style="font-family:'ostrich'; letter-spacing:10px;text-align:left; margin:0;">@lang('charte.title')</h1>
               </div>
            </div>
      
         <div class="row">
            <div class="small-12 medium-centered columns" style="margin-top:3rem;">
               <p style="color : white; text-align:center; font-family:'grotesqueregular'; letter-spacing:2px;">@lang('charte.content')</p>
            </div>
         </div>
      
      </div>
      <div>
         <form method="get">
            <div class="form-group">
               <div class="row">
                  <div class="small-offset-1 small-3 columns">
                     <input type="checkbox" class="checkbox-right" name="conditions" id="conditions">
                  </div>
                  <div class="small-5 columns end">
                     <label for="conditions" class="inline">I ACCEPT ALL OF THE CONDITIONS</label>
                  </div>
                  {!! $errors->first('conditions', '<small class="help-block">:message</small>') !!}
               </div>

               <div class="row" style="display: flex;">
                     <button style="margin: auto; margin-top: 20px; margin-bottom: 20px;" type="submit" class="submit-button" formaction="{{ route('index') }}">@lang('charte.previous')</button>
                     <button style="margin: auto; margin-top: 20px; margin-bottom: 20px;" type="submit" class="submit-button" formaction="{{ route('verification_conditions') }}">@lang('charte.next')</button>
                     <input type="hidden" name="_token" value="{{ csrf_token() }}">
               </div>
            </div>
         </form>
      </div>
   </div>
@endsection
