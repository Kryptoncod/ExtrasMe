<div class="extra-card" id="load-card">
   <img src="{{ $image }}" alt=""/>
   <span class="title">@lang('card.title', array('title' => $extra->professional->company_name))</span>
   <p class="description">@lang('card.description', array('name' => $extra->professional->company_name, 'type' => $extra->type, 'date' => $extra->dateExtra(), 'time' => $extra->timeExtra()))</p>
</div>
