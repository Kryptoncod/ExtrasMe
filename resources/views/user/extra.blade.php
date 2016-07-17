@extends('layouts.master', ["title" => trans('profile.title.student', ["name" => $user->username]), "footer" => false])
@section('content')

   <div class="row collapse profile profile-container">
      @include('user.sidebar', ['nav' => ['MY PAST EXPERIENCE' => ''], 'formType' => 0])

      <div class="medium-10 small-12 columns panel-main" style="display:flex; color:white; padding-top:50px;">
        @if(empty($extras))
          <p class="empty-notice">Sorry, no extra available at the moment. Come back later</p>
        @else

        <div style="display:flex; flex-direction:column; width:40%">
          <ul>
              @for($i=0; $i < count($extras); $i++)
                    <div style="width:100%; height:1px; background-color:white;"></div>
                    <li data-cardid="{{$i+1}}" class="showCard" style="list-style-type:none; padding-top:20px; padding-bottom :20px; cursor:pointer;">{{ $extras[$i]->type }} Extra: {{ $professional[$i] }}</li>
                     <div style="width:100%; height:1px; background-color:white;"></div>
              @endfor
          </ul>
        </div>
        <div style="display:flex; flex-direction:column; width:60%; align-items:center" id="card-container">
        
      </div>
@endif
   </div>
</div>
   <script type="text/javascript">
     var url = "{{ route('getCard') }}"
   </script>
@endsection
