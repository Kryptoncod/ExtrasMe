<div class="row section-title" style="margin-top:0px;">
  <div class="small-12 columns">
    <h2>@lang('account.register')</h2>
  </div>
</div>
<div class="row register-form-container">
  <form method="POST" action="{{ route('register_update' , Auth::user()->id) }}" enctype="multipart/form-data">
    <div class="file-container">
     <input type="file" name="avs" id="avs-file" class="input-file">
     <div class="fake-input-file">
      <div class="cross-container" id="cross-cont1">
        <i class="icon-plus-symbol" id="cross1"></i>
      </div>
      <div class="file-label" id="avs-label"><label>@lang('account.avs')</label></div>
    </div>
  </div>
    <div class="file-container">
      @if(session()->has('error'))
      <div>{!! session('error') !!}</div>
      @endif
      <input type="file" name="carte-nationalite" id="nationalite-file" class="input-file">
      <div class="fake-input-file">
        <div class="cross-container" id="cross-cont2">
          <i class="icon-plus-symbol" id="cross2"></i>
        </div>
        <div class="file-label" id="nationalite-label">
          <label>CARTE DE NATIONALITE</label>
        </div>
      </div>
    </div>
    
  <div class="file-container">
   <input type="file" name="permit" id="permit-file" class="input-file">
   <div class="fake-input-file">
    <div class="cross-container" id="cross-cont3">
      <i class="icon-plus-symbol" id="cross3"></i>
    </div>
    <div class="file-label" id="permit-label"><label>PERMIS DE SEJOUR SUISSE</label></div>
  </div>
</div>
  <div class="file-container">
     <input type="file" name="iban" id="iban-file" class="input-file">
     <div class="fake-input-file">
      <div class="cross-container" id="cross-cont4">
        <i class="icon-plus-symbol" id="cross4"></i>
      </div>
      <div class="file-label" id="iban-label"><label>IBAN</label></div>
    </div>
  </div>
<div style="width:100%;display:flex;">
  <input type="submit" name="go-register" class="submit-account" value="Update">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
</div>
</form>
</div>