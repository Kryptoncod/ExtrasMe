@extends('layouts.master', ["title" => trans('profile.title.professional', ["name" => $user->username]), "footer" => false])
@section('content')

   <div class="row collapse profile profile-container">
      @include('user.sidebar')

      <div class="medium-10 small-12 columns panel-main">

         <div class="row">
            <span class="profile-date"><a href="{{ route('calendar', Auth::user()->id) }}">{{ strtoupper(date('h:i A D j M Y')) }}</a></span>
         </div>
         <div class="options-container" style="color:white;">
            <h1 style="color:white;">@lang('payment.option.title')</h1>
            <p>@lang('payment.option.content')</p>

            <div>
               <button><a type="submit" href="{{ route('optionsPaymentCash', ['username' => Auth::user()->id, 'data0' => $data0, 'data1' => $data1]) }}">@lang('payment.option.cash')</a></button>
               <button>@lang('payment.option.online')</button>
               <button style="width: 300px;">@lang('payment.option.transfer')</button>
            </div>
         </div>
      </div>
   </div>

@endsection
