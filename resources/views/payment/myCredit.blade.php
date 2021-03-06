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
               <h2>@lang('payment.myCredit.recharge.title')</h2>
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
                           @lang('payment.myCredit.recharge.number')
                        </td>
                        <td>
                           @lang('payment.myCredit.recharge.price')
                        </td>
                        <td>
                           @lang('payment.myCredit.recharge.pricePerPost')
                        </td>
                     </tr>
                  </thead>
                  <tr>
                     <td>
                        <input type="radio" name="what_payment" value="1">
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
                        <input type="radio" name="what_payment" value="2">
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
                        <input type="radio" name="what_payment" value="3">
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
                        <input type="radio" name="what_payment" value="4">
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
               <button>@lang('payment.myCredit.recharge.pay')</button>
               <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
         </div>

         <div class="row section-title">
            <div class="small-12 columns">
               <h2>@lang('payment.myCredit.invoice.title')</h2>
            </div>
         </div>

         <div class="your-invoice-container">
            <div class="due-invoice">
               <h2>@lang('payment.myCredit.invoice.due')</h2>
               @if(!empty($dueInvoices))
                  @foreach($dueInvoices as $dueInvoice)
                     <div class="invoice">
                        <div>
                           <label>
                              @lang('payment.myCredit.invoice.content') {{ Carbon\Carbon::parse($dueInvoice->created_at)->format('d/m/Y') }}
                           </label>
                        </div>
                        <div>
                           <button>@lang('payment.myCredit.invoice.download')</button>
                        </div>
                     </div>
                  @endforeach
               @else
                  <div class="invoice">
                     <div>
                        <label>
                           @lang('payment.myCredit.invoice.noDueInvoice')
                        </label>
                     </div>
                  </div>
               @endif
            </div>
            <div class="due-invoice">
               <h2>@lang('payment.myCredit.invoice.past')</h2>
               @if(!empty($pastInvoices))
                  @foreach($pastInvoices as $pastInvoice)
                     <div class="invoice">
                        <div>
                           <label>
                              @lang('payment.myCredit.invoice.content') {{ Carbon\Carbon::parse($pastInvoice->created_at)->format('d/m/Y') }}
                           </label>
                        </div>
                        <div>
                           <button>@lang('payment.myCredit.invoice.download')</button>
                        </div>
                     </div>
                  @endforeach
               @else
                  <div class="invoice">
                     <div>
                        <label>
                           @lang('payment.myCredit.invoice.noPastInvoice')
                        </label>
                     </div>
                  </div>
               @endif
            </div>
         </div>

      </div>

   </div>

@endsection
