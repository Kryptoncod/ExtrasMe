@extends('index.section', ['number' => 2, 'id' => 'details'])
@section('section-content')

   <div class="row">
      <div class="large-7 medium-8 small-12 columns">
         <h2 class="section-title">@lang('index.section2.title')</h2>
      </div>
   </div>
   <div class="row">
      <div class="large-5 medium-8 small-12 columns">
         <a href="{{ route('missionStatement') }}" class="button">@lang('index.section2.moreInfos')</a>
      </div>
   </div>

@overwrite
