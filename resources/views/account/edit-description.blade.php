<div class="medium-10 small-12 columns panel-main">
  <div class="row section-title">
    <div class="small-12 columns">
     <h2>EDITER MA DESCRITPION</h2>
   </div>
 </div>

 <div class="details-container" style="max-height: 3000px; opacity: 1;">
  <form action="{{ route('description_update', Auth::user()->id) }}" method="POST" data-abide id="cv-form">
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    <div class="summary-container cv-div">
      <h2>Description</h2>
      <textarea name="description" placeholder="Votre description" rows="4" style="margin:.3125rem 0">@if(!empty($professional->description)){{ $professional->description }}@endif</textarea>
    </div>
    <div style="width:100%;display:flex;">
      <button type="submit" name="go-register" class="submit-account" value="Update">Update</button>
      <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    </div>
  </form>
</div>
</div>
</div>