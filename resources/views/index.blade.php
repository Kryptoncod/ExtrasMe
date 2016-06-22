@extends('layouts.master')
@section('content')

{{ $api or '' }}

   @include('index.section1')
   @include('index.section2')
   @include('index.section3')
   @include('index.section4')

   <ul class="index-side-nav hide-for-small-only">
      <li><a href="#home"></a></li>
      <li><a href="#details"></a></li>
      <li><a href="#apps"></a></li>
      <li><a href="#partners"></a></li>
   </ul>

@endsection
