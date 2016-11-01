<div id="paymentTransferModal" class="reveal-modal" data-reveal aria-labelledby="paymentTransferModalTitle" aria-hidden="true" role="dialog" style="top:80px;">
   <h1 id="paymentTransferModalTitle" style="color:white;">@lang('payment.option.modalTransfer.title')</h1>
     <div class="modal-buttons">
       <span class="button">
			<p>@lang('payment.option.modalTransfer.content')</p>
      <div style="width: 100%; margin-top:20px;">
        <img style="margin: auto; max-width: 100%;" src="{{asset('images/iban.jpg')}}">
      </div>
			<form style="margin-top: 20px;">
				<button type="submit" class="submit-button"><a href="{{ route('optionsPaymentTransfer', ['username' => Auth::user()->id]) }}">@lang('payment.option.modalTransfer.validate')</a></button>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
			</form>
       </span>
     </div>
</div>
