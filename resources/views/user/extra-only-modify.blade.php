@extends('layouts.master', ["title" => trans('profile.title.student', ["name" => $user->username]), "footer" => false])
@section('content')

   <div class="row collapse profile profile-container">
      @include('user.sidebar')

      <div class="medium-10 small-12 columns panel-main">

         <div class="row">
            <span class="profile-date"><a href="{{ route('calendar', Auth::user()->id) }}">{{ Carbon\Carbon::now('Europe/Paris')->formatLocalized('%A %d %B %Y') }}</a></span>
         </div>

         <div class="extra-container">
         <div class="row account-resume">
            <div class="columns medium-3 medium-uncentered small-centered picture-column small-7" style="padding: 0;">
               @if(file_exists("uploads/pp/".$professional->user_id.".png"))
                  <img class="profile-picture" src="{{ asset('uploads/pp/'.$professional->user_id.'.png') }}" alt="" />
               @else
                  <img class="profile-picture" src="{{ asset('images/user-professional.png') }}" alt="" />
               @endif
            </div>

            <div class="medium-7 small-12 medium-uncentered small-centered columns">
               <ul class="personal-informations">
                  <li class="title">{{ strtoupper($professional->company_name) }}</li>

               @if(Auth::user()->id == $username)
                  <li><span class="info-label">@lang('professional.email')</span>
                  {{ strtoupper($email) }}</li>

                  <li><span class="info-label">@lang('professional.contactNumber')</span>
                  {{ strtoupper($professional->phone) }}</li>
               @endif

                  <li><span class="info-label">@lang('professional.referencePerson')</span>
                  {{ strtoupper($professional->first_name.' '.$professional->last_name) }}</li>

                  <li><span class="info-label">@lang('professional.sector')</span>
                  {{ strtoupper($professional->category) }}</li>
               </ul>
            </div>
         </div>
         <form action="{{ route('modify_extra_post', ['username' => Auth::user()->id, 'id' => $extra->id]) }}" method="post">
            <div class="titre-extra">
               <h2>{{$extra->type}} EXTRA : {{$professional->state}}</h2>
            </div>
            <div class="info-container">
                  <table>
                                     <thead>
                                       <tr>
                                         <td colspan="2">
                                           @lang('card-content.keyDetails')
                                         </td>
                                       </tr>
                                     </thead>
                                     <tbody>
                                       <tr>
                                         <td>
                                           @lang('card-content.category')
                                         </td>
                                         <td id="extra_type">
                                           <select class="input" id="type" name="type" aria-label="Type of extra">
                                             <option selected disabled value="">@lang('professional.lookingForExtras.selectType')</option>
                                             @foreach(trans('typeExtra') as $id => $name)
                                                <option value="{{ $id }}" <?php if($extra->type == $name){ echo"selected";} ?>>{{ $name }}</option>
                                             @endforeach
                                          </select>
                                         </td>
                                       </tr>
                                       <tr>
                                         <td>
                                           @lang('card-content.requirements')
                                         </td>
                                         <td id="extra_requirements">
                                           <input type="text" name="requirements" id="requirements" value="{{ $extra->requirements }}"></input>
                                         </td>
                                       </tr>
                                       <tr>
                                         <td>
                                           @lang('card-content.salary')
                                         </td>
                                         <td id="extra_salary">
                                           <input type="number" min="0" name="salary" id="salary" pattern="abovezero" value="{{ $extra->salary }}" />
                                         </td>
                                       </tr>
                                       <tr>
                                         <td>
                                           @lang('card-content.benefits')
                                         </td>
                                         <td id="extra_benefits">
                                           <input type="text" name="benefits" id="benefits" value="{{ $extra->benefits }}" ></input>
                                         </td>
                                       </tr>
                                       <tr>
                                         <td>
                                           @lang('card-content.lang')
                                         </td>
                                         <td>
                                           <select class="input" id="language" name="language" aria-label="Language of extra">
                                             <option selected disabled value="">@lang('professional.lookingForExtras.selectLanguage')</option>
                                             @foreach(config('international.language') as $id => $lang)
                                                <option value="{{ $id }}" <?php if($extra->language == $lang){ echo"selected";} ?>>{{ $lang }}</option>
                                             @endforeach
                                          </select>
                                         </td>
                                       </tr>
                                       <tr>
                                         <td>
                                           @lang('card-content.timeStart')
                                         </td>
                                         <td id="extra_date">
                                            <input type="text" class="span2" id="date" name="dateStart" value="{{ $extra->dateStartExtra().' '.$extra->timeStartExtra() }}">
                                         </td>
                                       </tr>
                                       <tr>
                                         <td>
                                           @lang('card-content.timeFinish')
                                         </td>
                                         <td id="extra_date">
                                            <input type="text" class="span2" id="dateFinish" name="dateFinish" value="{{ $extra->dateFinishExtra().' '.$extra->timeFinishExtra() }}">
                                         </td>
                                       </tr>
                                       <tr>
                                         <td>
                                           @lang('card-content.numberPerson')
                                         </td>
                                         <td id="extra_date">
                                            <input type="number" value="1" min="0" name="numberPerson" id="numberPerson" pattern="abovezero" value="{{ $extra->number_persons }}" />
                                         </td>
                                       </tr>
                                       <tr>
                                         <td style="border-bottom: none;">
                                           @lang('card-content.otherInfo')
                                         </td>
                                         <td style="border-bottom: none;" id="extra_otherInfos">
                                           <input type="text" name="informations" id="informations" value="{{ $extra->informations }}"></input>
                                         </td>
                                       </tr>
                                     </tbody>
                                   </table>
               </div>
               @if($edit_ok == 1)
                <div style="display: flex;">
                   <button style="margin-left: auto;" name="save" value="1">@lang('card-content.save')</button>
                   <button style="margin-left:20px;" name="cancel" value="1">@lang('card-content.cancel')</button>
                   <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </div>
              @endif
              </form>
            </div>
         </div>
      </div>
   </div>

@endsection