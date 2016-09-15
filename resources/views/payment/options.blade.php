@extends('layouts.master', ["title" => trans('profile.title.professional', ["name" => $user->username]), "footer" => false])
@section('content')

   <div class="row collapse profile profile-container">
      @include('user.sidebar')

      <div class="medium-10 small-12 columns panel-main">

         <div class="row">
            <span class="profile-date"><a href="{{ route('calendar', Auth::user()->id) }}">{{ strtoupper(date('h:i A D j M Y')) }}</a></span>
         </div>
         <div class="options-container" style="color:white;">
            <h1 style="color:white;">PAYMENT OPTIONS</h1>
            <h2 style="color:white;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi exercitationem atque.</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro rem, ex deleniti nemo ullam placeat enim qui cum officiis dolor deserunt consequatur nam culpa quaerat, dignissimos at! Asperiores tempora, non.</p>
            <p>
               Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro rem, ex deleniti nemo ullam placeat enim qui cum officiis dolor deserunt consequatur nam culpa quaerat, dignissimos at! Asperiores tempora, non.
               Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro rem, ex deleniti nemo ullam placeat enim qui cum officiis dolor deserunt consequatur nam culpa quaerat, dignissimos at! Asperiores tempora, non.
               Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro rem, ex deleniti nemo ullam placeat enim qui cum officiis dolor deserunt consequatur nam culpa quaerat, dignissimos at! Asperiores tempora, non.
            </p>
            <p>
               Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro rem, ex deleniti nemo ullam placeat enim qui cum officiis dolor deserunt consequatur nam culpa quaerat, dignissimos at! Asperiores tempora, non.
            </p>

            <div>
               <button><a type="submit" href="{{ route('optionsPaymentCash', ['username' => Auth::user()->id, 'data0' => $data0, 'data1' => $data1]) }}">JE PAYE EN ESPECE</a></button>
               <button>JE PAYE EN LIGNE</button>
               <button style="width: 300px;">JE PAYE PAR VIREMENT BANCAIRE</button>
            </div>
         </div>
      </div>
   </div>

@endsection
