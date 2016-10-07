@extends('index.section', ['number' => 1, 'id' => 'home'])
@section('section-content')

   <div class="row" style="display: flex;">
      <div class="large-7 medium-8 small-12 columns" style="margin: auto;">
         <h2 class="section-title">@lang('index.section1.title')</h2>
      </div>
   </div>
   <div class="row" style="display: flex; margin-top: 60px;">
      <div class="large-3 medium-8 small-12 columns" style="margin: auto;">
         <a href="/signup" data-reveal-id="signupModal" class="button signup-button" style="letter-spacing: 12px;">@lang('index.section1.signUp')</a>
      </div>
   </div>
   

@overwrite
