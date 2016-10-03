@extends('layouts.master', ['title' => $title])
@section('content')
   <div class="form" style="background-color: #060b2b;">

      <div class="row">
         <div class="small-centered columns">
            <h1 class="form-title">{{ $formTitle }}</h1>
         </div>
      </div>

      <div class="row">
         <div class="small-12 medium-centered columns">
            <form data-abide action="" method="post">
               @yield('form')
            </form>
         </div>
      </div>

   </div>
@endsection
