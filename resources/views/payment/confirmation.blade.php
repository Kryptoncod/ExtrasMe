@extends('layouts.master', ["title" => trans('profile.title.professional', ["name" => $user->username]), "footer" => false])
@section('content')

   <div class="row collapse profile profile-container">
      @include('user.sidebar')

      <div class="medium-10 small-12 columns panel-main">

         <div class="row">
            <span class="profile-date"><a href="{{ route('calendar', Auth::user()->id) }}">{{ Carbon\Carbon::now('Europe/Paris')->formatLocalized('%A %d %B %Y') }}</a></span>
         </div>

         <div class="row account-resume">
            <div class="columns medium-3 medium-uncentered small-centered picture-column small-7">
               @if(file_exists("uploads/pp/".$user->id.".png"))
                  <img class="profile-picture" src="{{ asset('uploads/pp/'.$user->id.'.png') }}" alt="" />
               @else
                  <img class="profile-picture" src="{{ asset('images/user-professional.png') }}" alt="" />
               @endif
            </div>

            <div class="medium-7 small-12 medium-uncentered small-centered columns">
               <ul class="personal-informations">
                  <li class="title">YOUR CREDIT : <br>{{ strtoupper($professional->company_name) }}</li>

               @if(Auth::user()->id == $username)
                  <li><span class="info-label">@lang('professional.email')</span>
                  {{ strtoupper($user->email) }}</li>

                  <li><span class="info-label">@lang('professional.contactNumber')</span>
                  {{ strtoupper($professional->phone) }}</li>
               @endif

                  <li><span class="info-label">@lang('professional.referencePerson')</span>
                  {{ strtoupper($professional->first_name.' '.$professional->last_name) }}</li>

                  <li><span class="info-label">@lang('professional.sector')</span>
                  {{ strtoupper($professional->category) }}</li>

               @if(Auth::user()->id == $username)
                  <li><span class="info-label">@lang('professional.creditLeft')</span>
                  {{ strtoupper($professional->credit) }}</li>
               @endif
               </ul>
            </div>
         </div>
         <div class="row section-title">
            <div class="small-12 columns">
               <h2>@lang('payment.confirmation.title')</h2>
            </div>
         </div>
         <div class="confirm-container">
            <h4>@lang('payment.confirmation.select', array('number' => session()->get('what_payment')[0], 'price' => session()->get('what_payment')[1]))</h4>
            <form action="{{ route('options', Auth::user()->id) }}" method="get">
               <label>@lang('payment.confirmation.emailAddress')</label>
               <input type="text" name="mail">
               <label>@lang('payment.confirmation.password')</label>
               <input type="password" name="password">
               <button>@lang('payment.confirmation.pay')</button>
               <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
         </div>

      </div>

   </div>

@endsection
