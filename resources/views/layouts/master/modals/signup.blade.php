<div id="signupModal" class="reveal-modal" data-reveal aria-labelledby="signupModalTitle" aria-hidden="true" role="dialog" style="top:200px;">
   <h1 id="signupModalTitle" style="color:white;">@lang('global.signUp')</h2>
     <div class="modal-buttons">
       <a href="{{ route('signup_student') }}" style="margin-bottom:30px;" class="button"><p>@lang('modals.iAmStudent')</p></a>
       <a href="{{ route('signup_professional') }}" class="button"><p>@lang('modals.iAmPro')</p></a>
     </div>
</div>
