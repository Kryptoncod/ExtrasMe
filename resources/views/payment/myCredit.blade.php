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
               <h2>RECHARGE YOUR CREDIT</h2>
            </div>
         </div>

         <div class="credit-container">
            <form action="{{ route('confirm', Auth::user()->id) }}" method="get">
               <table class="credit-table">
                  <thead>
                     <tr>
                        <td style="border-bottom: none;">
                        </td>
                        <td>
                           NOMBRE DE POSTE EN LIGNE
                        </td>
                        <td>
                           PRIX
                        </td>
                        <td>
                           PRIX PAR ANNONCE
                        </td>
                     </tr>
                  </thead>
                  <tr>
                     <td>
                        <input type="radio" name="what_payment" value="25 227">
                     </td>
                     <td>
                        25
                     </td>
                     <td>
                        227 CHF
                     </td>
                     <td>
                        9.08 CHF
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <input type="radio" name="what_payment" value="50 433">
                     </td>
                     <td>
                        50
                     </td>
                     <td>
                        433 CHF
                     </td>
                     <td>
                        8.66 CHF
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <input type="radio" name="what_payment" value="100 743">
                     </td>
                     <td>
                        100
                     </td>
                     <td>
                        743 CHF
                     </td>
                     <td>
                        7.43 CHF
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <input type="radio" name="what_payment" value="250 1548">
                     </td>
                     <td>
                        250
                     </td>
                     <td>
                        1548 CHF
                     </td>
                     <td>
                        6.19 CHF
                     </td>
                  </tr>
               </table>
               <button>VALIDEZ VOTRE PAIEMENT</button>
            </form>
           
         </div>

         <div class="row section-title">
            <div class="small-12 columns">
               <h2>YOUR INVOICE</h2>
            </div>
         </div>

         <div class="your-invoice-container">
            <div class="due-invoice">
               <h2>BELOW HERE ARE YOUR DUE INVOICE</h2>
               @if(!empty($dueInvoices))
                  @foreach($dueInvoices as $dueInvoice)
                     <div class="invoice">
                        <div>
                           <label>
                              FACTURE DU {{ Carbon\Carbon::parse($dueInvoice->created_at)->format('d/m/Y') }}
                           </label>
                        </div>
                        <div>
                           <button>PREVIEW</button>
                           <button>DOWNLOAD</button>
                        </div>
                     </div>
                  @endforeach
               @else
                  <div class="invoice">
                     <div>
                        <label>
                           You don't have due invoices.
                        </label>
                     </div>
                  </div>
               @endif
            </div>
            <div class="due-invoice">
               <h2>YOUR PAST INVOICE</h2>
               @if(!empty($pastInvoices))
                  @foreach($pastInvoices as $pastInvoice)
                     <div class="invoice">
                        <div>
                           <label>
                              FACTURE DU {{ Carbon\Carbon::parse($pastInvoice->created_at)->format('d/m/Y') }}
                           </label>
                        </div>
                        <div>
                           <button>PREVIEW</button>
                           <button>DOWNLOAD</button>
                        </div>
                     </div>
                  @endforeach
               @else
                  <div class="invoice">
                     <div>
                        <label>
                           You don't have past invoices.
                        </label>
                     </div>
                  </div>
               @endif
            </div>
         </div>

      </div>

   </div>

@endsection
