<div id="paymentTransferModal" class="reveal-modal" data-reveal aria-labelledby="paymentTransferModalTitle" aria-hidden="true" role="dialog" style="top:200px;">
   <h1 id="paymentTransferModalTitle" style="color:white;">@lang('payment.option.modalTransfer.title')</h1>
     <div class="modal-buttons">
       <span class="button">
			<p>@lang('payment.option.modalTransfer.content')</p>
			<form>
				<button type="submit" class="submit-button"><a href="{{ route('optionsPaymentTransfer', ['username' => Auth::user()->id, 'data0' => $data0, 'data1' => $data1]) }}">@lang('payment.option.modalTransfer.validate')</a></button>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
			</form>
       </span>
     </div>
</div>
