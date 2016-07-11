@extends('layouts.master', ["title" => trans('profile.title.professional', ["name" => $user->username]), "footer" => false])
@section('content')

   <div class="row collapse profile profile-container">
      @include('user.sidebar', ['nav' => ['MY CREDIT' => ''], 'formType' => 1])

      <div class="medium-10 small-12 columns panel-main">

         <div class="row">
            <span class="profile-date">{{ strtoupper(date('h:i A D j M Y')) }}</span>
         </div>

         <div class="row account-resume">
            <div class="columns medium-3 medium-uncentered small-centered picture-column small-7">
               <img class="profile-picture" src="{{ asset('../resources/assets/images/user-professional.png') }}" alt="" />
            </div>

            <div class="medium-7 small-12 medium-uncentered small-centered columns">
               <ul class="personal-informations">
                  <li class="title">{{ strtoupper($professional->company_name) }}</li>

                  <li><span class="info-label">EMAIL:</span>
                  {{ strtoupper($user->email) }}</li>

                  <li><span class="info-label">CONTACT NUMBER:</span>
                  {{ strtoupper($professional->phone) }}</li>

                  <li><span class="info-label">REFERENCE PERSON:</span>
                  {{ strtoupper($professional->first_name.' '.$professional->last_name) }}</li>

                  <li><span class="info-label">SECTOR:</span>
                  {{ strtoupper($professional->category) }}</li>

                  <li><span class="info-label">CREDITS LEFT:</span>
                  {{ strtoupper($professional->credit) }}</li>
               </ul>
            </div>
         </div>

         <div class="row details-button">
            <a href="">MORE DETAILS</a>
         </div>

         <div class="row section-title">
            <div class="small-12 columns">
               <h2>LOOKING FOR EXTRAS?</h2>
            </div>
         </div>

         <div class="row">
            <form data-abide class="extra-search-form" action="{{ route('extra_submit') }}" method="post">
               <div class="large-8 small-12 columns">

                  <div class="row">
                     <div class="large-3 columns">
                        <label for="lastminute" class="right inline">BROADCASTING <span data-tooltip aria-haspopup="true" class="has-tip level-error" title="Last-minute extras cost 3 credits and are broadcasted to every student">?</span> :</label>
                     </div>
                     <div class="large-9 columns">
                        <input name="broadcast" id="lastMinuteRadio" class="pretty" value="last_minute" type="radio" required>
                        <label class="pretty-label" for="lastMinuteRadio">LAST MINUTE</label>


                        <input name="broadcast" id="normalRadio" class="pretty" value="normal" checked type="radio" required>
                        <label class="pretty-label" for="normalRadio">NORMAL</label>

                        <small class="error">Broadcasting is required.</small>
                     </div>
                  </div>

                  <div class="row">
                     <div class="large-3 columns">
                        <label for="type" class="right inline">TYPE OF EXTRA:</label>
                     </div>
                     <div class="large-9 end columns">
                        <select class="input" id="type" name="type" aria-label="Type of extra" required>
                           <option selected disabled value="">Select</option>
                           @foreach(config('international.last_minute_types') as $id => $name)
                              <option value="{{ $id }}">{{ $name }}</option>
                           @endforeach
                        </select>
                        <small class="error">Type is required.</small>
                     </div>
                  </div>

                  <div class="row">
                     <div class="large-3 columns">
                        <label for="date" class="right inline">DATE:</label>
                     </div>
                     <div class="large-9 end columns">
                        <input type="text" name="date" id="date" placeholder="mm/dd/yyyy" value="{{ date('m/d/Y') }}" pattern="month_day_year" required>
                        <small class="error">Date is required and must be mm/dd/yyyy (e.g 07/29/2016).</small>
                     </div>
                  </div>

                  <div class="row">
                     <div class="large-3 columns">
                        <label for="time" class="right inline">TIME:</label>
                     </div>
                     <div class="large-9 end columns">
                        <input type="text" name="time" id="time" placeholder="HH:MM" required pattern="time" />
                        <small class="error">Time is required and must be HH:MM (e.g 17:51).</small>
                     </div>
                  </div>

                  <div class="row">
                     <div class="large-3 columns">
                        <label for="duration" class="right inline">DURATION:</label>
                     </div>
                     <div class="large-9 end columns">
                        <div class="row collapse">
                           <div class="small-10 columns">
                              <input type="number" value="1" min="0" name="duration" id="duration" pattern="abovezero" required />
                              <small class="error">Duration is required and must be above 0.</small>
                           </div>
                           <div class="small-2 columns">
                              <span class="postfix">Hr(s)</span>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="row">
                     <div class="large-3 columns">
                        <label for="salary" class="right inline">SALARY:</label>
                     </div>
                     <div class="large-9 end columns">
                        <div class="row collapse input-wrapper">
                           <div class="small-10 columns">
                              <input type="number" min="0" name="salary" id="salary" pattern="abovezero" required />
                              <small class="error">Salary is required and must be above 0.</small>
                           </div>
                           <div class="small-2 columns">
                              <span class="postfix">CHF/Hr</span>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="row">
                     <div class="large-3 columns">
                        <label for="benefits" class="right inline">BENEFITS:</label>
                     </div>
                     <div class="large-9 end columns">
                        <textarea type="text" name="benefits" id="benefits" required ></textarea>
                        <small class="error">Benefits are required.</small>
                     </div>
                  </div>

                  <div class="row">
                     <div class="large-3 columns">
                        <label for="requirements" class="right inline">REQUIREMENTS:</label>
                     </div>
                     <div class="large-9 end columns">
                        <textarea type="text" name="requirements" id="requirements" required ></textarea>
                        <small class="error">Requirements are required.</small>
                     </div>
                  </div>

                  <div class="row">
                     <div class="large-3 columns">
                        <label for="informations" class="right inline">OTHER INFORMATION:</label>
                     </div>
                     <div class="large-9 end columns">
                        <textarea type="text" name="informations" id="informations" ></textarea>
                     </div>
                  </div>

               </div>

               <div class="small-12 large-4 columns">
                  <div class="row">
                     <div class="small-centered columns">
                        <button type="submit" class="submit-button">SUBMIT EXTRA</button>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                     </div>
                  </div>
               </div>

            </form>
         </div>

         @if(!empty($extras))
            <div class="row section-title">
               <div class="small-12 columns">
                  <h2>MY EXTRAS</h2>
               </div>
            </div>

            <div class="row">
               <div class="small-12 columns">
                  <ul class="large-block-grid-3 medium-block-grid-2 small-block-grid-1">

                     @foreach ($extras as $extra)
                        <li>@include('user.card', ["description" => "The pauker hotel is looking for extras in ".
                                                                 $extra->type.
                                                                 ' for '.$extra->date.' at '.$extra->date_time,
                                                "title" => "The pauker hotel",
                                                "image" => asset("../resources/assets/images/extra-card-example.png"),
                                                "id"  => $extra->id])
                        </li>
                     @endforeach

                  </ul>
               </div>
            </div>
         @endif

      </div>

   </div>

@endsection
