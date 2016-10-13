@extends('layouts.master', ["title" => trans('profile.title.professional', ["name" => $user->username]), "footer" => false])
@section('content')

   <div class="row collapse profile profile-container" id="optionPayment">
      @include('user.sidebar')

      <div class="medium-10 small-12 columns panel-main">

         <div class="row">
            <span class="profile-date"><a href="{{ route('calendar', Auth::user()->id) }}">{{ strtoupper(date('h:i A D j M Y')) }}</a></span>
         </div>
         <div class="options-container" style="color:white;">
            <h1 style="color:white;">@lang('payment.option.title')</h1>
            <p>@lang('payment.option.content')</p>

            <div>
               <button>@lang('payment.option.online')</button>
               <button style="width: 300px;" data-reveal-id="paymentTransferModal" class="payment-button">@lang('payment.option.transfer')</button>
               <button class="payment-button" data-reveal-id="paymentCashModal">@lang('payment.option.cash')</button>
            </div>
         </div>
      </div>
   </div>

   @include('layouts.master.modals.cashModal')
   @include('layouts.master.modals.transferModal')

@endsection
