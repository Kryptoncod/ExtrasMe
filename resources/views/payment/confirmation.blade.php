@extends('layouts.master', ["title" => trans('profile.title.professional', ["name" => $user->username]), "footer" => false])
@section('content')

   <div class="row collapse profile profile-container">
      @include('user.sidebar')

      <div class="medium-10 small-12 columns panel-main">

         <div class="row">
            <span class="profile-date"><a href="{{ route('calendar', Auth::user()->id) }}">{{ strtoupper(date('h:i A D j M Y')) }}</a></span>
         </div>

         <div class="row account-resume">
            <div class="columns medium-3 medium-uncentered small-centered picture-column small-7">
               @if(file_exists("uploads/pp/".$user->id.".png"))
                  <img class="profile-picture" src=" uploads/pp/{{$user->id}}.png" alt="" />
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
               <h2>CONFIRM YOUR PAYMENT</h2>
            </div>
         </div>
         <div class="confirm-container">
            <h4>Vous avez selectionné <span style="color: blue">{{ $data[0] }}</span> annonces en ligne pour <span style="color: blue">{{ $data[1] }}</span> CHF</h4>
            <form action="{{ route('options', ['username' => Auth::user()->id, 'data0' => $data[0], 'data1' => $data[1]]) }}" method="get">
               <label>ADRESS MAIL:</label>
               <input type="text" name="mail">
               <label>PASSWORD:</label>
               <input type="password" name="password">
               <button>PAYER MAINTENANT</button>
            </form>
         </div>

      </div>

   </div>

@endsection
