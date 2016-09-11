<div class="row section-title" style="margin-top:0px;">
  <div class="small-12 columns">
    <h2>@lang('account.register')</h2>
  </div>
</div>
<div class="row register-form-container">
  <form method="POST" action="{{ route('register_update' , Auth::user()->id) }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="file-container">
      @if(session()->has('error'))
      <div>{!! session('error') !!}</div>
      @endif
      <input type="file" name="carte-id" id="id-file" class="input-file">
      <div class="fake-input-file">
        <div class="cross-container" id="cross-cont1">
          <i class="icon-plus-symbol" id="cross1"></i>
        </div>
        <div class="file-label" id="id-label">
          <label>@lang('account.id')</label>
        </div>
      </div>
    </div>
    <div class="file-container">
     <input type="file" name="avs" id="avs-file" class="input-file">
     <div class="fake-input-file">
      <div class="cross-container" id="cross-cont2">
        <i class="icon-plus-symbol" id="cross2"></i>
      </div>
      <div class="file-label" id="avs-label"><label>@lang('account.avs')</label></div>
    </div>
  </div>
  <div class="file-container">
   <input type="file" name="permit" id="permit-file" class="input-file">
   <div class="fake-input-file">
    <div class="cross-container" id="cross-cont3">
      <i class="icon-plus-symbol" id="cross3"></i>
    </div>
    <div class="file-label" id="permit-label"><label>@lang('account.workPermit')</label></div>
  </div>
</div>
<div style="width:100%;display:flex;">
  <input type="submit" name="go-register" class="submit-account" value="Update">
</div>
</form>
</div>