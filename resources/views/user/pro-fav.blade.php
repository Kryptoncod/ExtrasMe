<h2 class="name-list">{{ strtoupper($professional->company_name) }}</h2>
<hr style="margin-top: 0px;">
<div style="width: 40%;">
   @if(file_exists("uploads/pp/".$professional->user_id.".png"))
      <img class="profile-picture" src="{{ asset('uploads/pp/'.$professional->user_id.'.png') }}" alt="" />
   @else
      <img class="profile-picture" src="{{ asset('images/user-professional.png') }}" alt="" />
   @endif
</div>
<div class="summary-container cv-div" style="margin-top: 20px;">
   <ul class="personal-informations">
      <li><span class="info-label">@lang('professional.referencePerson')</span>
      {{ strtoupper($professional->first_name.' '.$professional->last_name) }}</li>

      <li><span class="info-label">@lang('professional.sector')</span>
      {{ strtoupper($professional->category) }}</li>
   </ul>
</div>
<div>
   @if(sizeof($alreadyFav) == 0)
      <button><a class="submit-button" href="{{ route('add_favorite', ['username' => Auth::user()->id, 'id' => $professional->id]) }}">@lang('favorite.add')</a></button>
   @else
      <button><a class="submit-button" href="{{ route('delete_favorite', ['username' => Auth::user()->id, 'id' => $professional->id]) }}">@lang('favorite.delete')</a></button>
   @endif
</div>