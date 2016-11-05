<div class="extra-card" id="load-card">
	@if(file_exists("uploads/pp/".$extra->professional->user_id.".png"))
   		<img src="{{ asset('uploads/pp/'.$extra->professional->user_id.'.png') }}" alt=""/>
   	@else
   		<img src="{{ asset('images/user-professional.png') }}" alt=""/>
   	@endif
   <span class="title">@lang('card.title', array('title' => $extra->professional->company_name))</span>
   <p class="description">@lang('card.description', array('name' => $extra->professional->company_name, 'type' => $extra->type, 'date' => $extra->dateStartExtra(), 'time' => $extra->timeStartExtra()))</p>
</div>
