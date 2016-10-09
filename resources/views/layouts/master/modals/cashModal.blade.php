<div id="paymentCashModal" class="reveal-modal" data-reveal aria-labelledby="paymentCashModalTitle" aria-hidden="true" role="dialog" style="top:200px;">
   <h1 id="paymentCashModalTitle" style="color:white;">@lang('payment.option.modalCash.title')</h1>
     <div class="modal-buttons">
       <span class="button">
			<p>@lang('payment.option.modalCash.content')</p>
			<form>
				<button type="submit" class="submit-button"><a type="submit" href="{{ route('optionsPaymentCash', ['username' => Auth::user()->id, 'data0' => $data0, 'data1' => $data1]) }}" >@lang('payment.option.modalCash.validate')</a></button>
            	<input type="hidden" name="_token" value="{{ csrf_token() }}">
			</form>
       </span>
     </div>
</div>