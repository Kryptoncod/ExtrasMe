<div id="signinModal" class="reveal-modal" data-reveal aria-labelledby="signupModalTitle" aria-hidden="true" role="dialog" style="top:200px;">
   <h1 id="signupModalTitle" style="color:white; text-align:center;">@lang('global.signIn')</h2>
     <div class="signup-modal-container">
       <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
           {{ csrf_field() }}

           <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
               <label for="email" class="col-md-4 control-label">@lang('auth.emailField')</label>

               <div class="col-md-6">
                   <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                   @if ($errors->has('email'))
                       <span class="help-block">
                           <strong class="error-log">{{ $errors->first('email') }}</strong>
                       </span>
                   @endif
               </div>
           </div>

           <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
               <label for="password" class="col-md-4 control-label">@lang('auth.password')</label>

               <div class="col-md-6">
                   <input id="password" type="password" class="form-control" name="password">

                   @if ($errors->has('password'))
                       <span class="help-block">
                           <strong class="error-log">{{ $errors->first('password') }}</strong>
                       </span>
                   @endif
               </div>
           </div>

           <div class="form-group">
               <div class="col-md-6 col-md-offset-4">
                   <div class="checkbox">
                       <label>
                           <input type="checkbox" name="remember"> @lang('auth.rememberMe')
                       </label>
                   </div>
               </div>
           </div>

           <div class="form-group">
               <div class="col-md-6 col-md-offset-4 login-div">
                   <button type="submit" id="login-submit" class="btn btn-primary">
                       <i class="fa fa-btn fa-sign-in"></i> Login
                   </button>

                   <a class="btn btn-link" href="{{ url('/password/reset') }}" style="color:white;">@lang('auth.frogotYourPassword')</a>
               </div>
           </div>
       </form>
     </div>
</div>
