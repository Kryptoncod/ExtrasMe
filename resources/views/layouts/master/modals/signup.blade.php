<div id="signupModal" class="reveal-modal" data-reveal aria-labelledby="signupModalTitle" aria-hidden="true" role="dialog" style="top:200px;">
   <h1 id="signupModalTitle" style="color:white;">@lang('global.signUp')</h2>
     <div class="modal-buttons" >
       <span class="button" style="padding:25px;">
			<p>@lang('index.notDeploy')</p>
			<form action="{{ route('register_candidate') }}" method="post">
				<input type="text" name="email" id="email" required />
				<button type="submit" class="submit-button">@lang('index.validate')</button>
            	<input type="hidden" name="_token" value="{{ csrf_token() }}">
			</form>
       </span>
     </div>
</div>
