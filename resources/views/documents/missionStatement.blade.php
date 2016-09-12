@extends('layouts.master')
@section('content')
   <div class="form">

      <div class="row">
         <div class="small-centered columns">
            <h1 class="form-title">@lang('index.missionStatement.title')</h1>
         </div>
      </div>

      <div class="row">
         <div class="small-12 medium-centered columns">
            <p>@lang('index.missionStatement.content')</p>
         </div>
      </div>

   </div>
@endsection
