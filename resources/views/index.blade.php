@extends('layouts.master', ['footer' => false])
@section('content')

{{ $api or '' }}

   <div id="fullpage">
      <div class="section">@include('index.section1')</div>
      <div class="section">@include('index.section2')</div>
      <div class="section">@include('index.section3')</div>
      <div class="section">@include('index.section4')</div>
      <div class="section fp-auto-height">@include('layouts.master.footer')</div>
   </div>

   <ul class="index-side-nav hide-for-small-only">
      <li><a href="#home"></a></li>
      <li><a href="#details"></a></li>
      <li><a href="#apps"></a></li>
      <li><a href="#partners"></a></li>
   </ul>

@endsection
