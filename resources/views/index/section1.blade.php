@extends('index.section', ['number' => 1, 'id' => 'home'])
@section('section-content')

   <div class="row">
      <div class="large-7 medium-8 small-12 columns">
         <h2 class="section-title">@lang('index.section1.title')</h2>
      </div>
   </div>
   <div class="row">
      <div class="large-5 medium-8 small-12 columns">
         <a href="/signup" data-reveal-id="signupModal" class="button signup-button" style="letter-spacing: 12px;">@lang('index.section1.signUp')</a>
      </div>
   </div>
   

@overwrite
