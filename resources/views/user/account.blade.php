@extends('layouts.master', ["title" => trans('profile.title.student', ["name" => $user->username]), "footer" => false])
@section('content')
  <div class="row collapse profile profile-container">
    @include('user.sidebar')
    
      <div class="medium-10 small-12 columns panel-main">
        @if(Session::has('message'))
          @if(count($errors) > 0)
            <div class="erreur-update" style="background-color: #960E0E;">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</div>
          @elseif(Session::get('message') != "")
            <div class="erreur-update" style="background-color: #00B143;">{{Session::get('message')}}</div>
          @else
             <div class="erreur-update" style="background-color: #960E0E;">@lang('account.fileNeeded')</div>
          @endif
        @endif
      @if(Auth::user()->type == 0)
        @if(!$student->registration_done)
          @include('account.file-upload')
          @include('account.edit-cv')
          @include('account.edit-profile')
        @else
          @include('account.edit-cv')
          @include('account.edit-profile')
          @include('account.edit-file-upload')
        @endif

      @else
        @include('account.edit-profile-pro')
        @include('account.edit-description')
      @endif
      </div>
  </div>
@endsection