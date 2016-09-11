<div class="row section-title" style="margin-top:0px;">
  <div class="small-12 columns">
    <h2>@lang('account.register')</h2>
  </div>
</div>
<div style="width: 70%; display: flex; justify-content:center; flex-direction:column; margin:auto;">
	<h3 style="color: white;margin:auto; text-align: center;">@lang('account.register')</h3>
	<a href="{{ route('modif_files' , Auth::user()->id) }}" style="margin:auto; margin-top: 20px;" id="modif-files"><button  style="width:300px;  background-color: #222; padding :10px; ">@lang('account.modifyFiles')</button></a>
</div>