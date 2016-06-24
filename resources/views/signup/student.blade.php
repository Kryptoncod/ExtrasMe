@extends('signup.common', ['title' => 'Student sign up', 'formTitle' => 'SIGN UP', 'action' => route('register_student')])
@section('form')

   <div class="form-group">

      <div class="row">
         <div class="small-4 columns">
            <label for="name" class="right inline">NAME:</label>
         </div>
         <div class="small-6 end columns">
            <input type="text" name="name" id="name" required pattern="[a-zA-Z]+" />
            <small class="error">Name is required and must contain only alphanumerics characters.</small>
         </div>
      </div>

      <div class="row">
         <div class="small-4 columns">
            <label for="last_name" class="right inline">LAST NAME:</label>
         </div>
         <div class="small-6 end columns">
            <input type="text" name="last_name" id="last_name" required pattern="[a-zA-Z]+" />
            <small class="error">Last name is required and must contain only alphanumerics characters.</small>
         </div>
      </div>

      <div class="row">
         <div class="small-4 columns">
            <label for="gender" class="right inline">GENDER:</label>
         </div>
         <div class="small-6 end columns">
            <input name="gender" id="maleRadio" class="pretty" value="male" type="radio" required>
            <label class="pretty-label" for="maleRadio">MALE</label>


            <input name="gender" id="femaleRadio" class="pretty" value="female" type="radio" required>
            <label class="pretty-label" for="femaleRadio">FEMALE</label>

            <small class="error">Gender is required.</small>
         </div>
      </div>

      <div class="row">
         <div class="small-4 columns">
            <label for="birthdate" class="right inline">BIRTHDATE:</label>
         </div>
         <div class="small-6 end columns">

            <div class="row small-collapse medium-uncollapse">

               <div class="small-4 columns">
                  <select name="day" required>
                     <option selected disabled value="">DAY</option>
                     @for($i = 1; $i <= 31; $i++) {{-- //4 times faster than foreach(range()) --}}
                        <option>{{ sprintf("%02d", $i) }}</option>
                     @endfor
                  </select>
               </div>

               <div class="small-4 columns">
                  <select name="month" required>
                     <option selected disabled value="">MONTH</option>
                     @foreach(['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'] as $id => $month)
                        <option value="{{ $id }}">{{ $month }}</option>
                     @endforeach
                  </select>
               </div>

               <div class="small-4 columns">
                  <select name="year" required>
                     <option selected disabled value="">YEAR</option>
                     @for($i = 2000; $i >= 1900; $i--) {{-- //4 times faster than foreach(range()) --}}
                        <option value="{{ $i }}">{{ $i }}</option>
                     @endfor
                  </select>
               </div>

            </div>

            <small class="error">Birthdate is required.</small>
         </div>
      </div>

      <div class="row">
         <div class="small-4 columns">
            <label for="nationality" class="right inline">NATIONALITY:</label>
         </div>
         <div class="small-6 end columns">
            <select name="nationality" required>
               <option selected disabled value="">PLEASE SELECT ...</option>
               @foreach(config('international.nationalities') as $id => $nationality)
                  <option value="{{ $id }}">{{ $nationality }}</option>
               @endforeach
            </select>
            <small class="error">Nationality is required.</small>
         </div>
      </div>

      <div class="row">
         <div class="small-4 columns">
            <label for="school_year" class="right inline">EHL'S YEAR:</label>
         </div>
         <div class="small-6 end columns">
            <select name="school_year" required>
               <option selected disabled value="">PLEASE SELECT ...</option>
               @foreach(config('international.ehl_years') as $id => $year)
                  <option value="{{ $id }}">{{ $year }}</option>
               @endforeach
            </select>
            <small class="error">EHL's year is required.</small>
         </div>
      </div>

      <div class="row">
         <div class="small-4 columns">
            <label for="phone" class="right inline">PHONE NUMBER:</label>
         </div>
         <div class="small-6 end columns">
            <input type="text" name="phone" id="phone" required pattern="[1-9]+" />
            <small class="error">Phone number is required and must be valid.</small>
         </div>
      </div>

   </div>

   <div class="form-group">

         <div class="row">
            <div class="small-4 columns">
               <label for="email_address" class="right inline">EMAIL ADDRESS:</label>
            </div>
            <div class="small-6 end columns">
               <input type="email" name="email_address" id="email_address" required pattern=".+@ehl.ch$" />
               <small class="error">Email address must end with @ehl.ch.</small>
            </div>
         </div>

      <div class="row">
         <div class="small-4 columns">
            <label for="email_address_confirm" class="right inline">CONFIRM EMAIL ADDRESS:</label>
         </div>
         <div class="small-6 end columns">
            <input type="email" name="email_address_confirmation" id="email_address_confirmation" required data-equalto="email_address" />
            <small class="error">Email addresses must match.</small>
         </div>
      </div>

   </div>

   <div class="form-group">

      <div class="row">
         <div class="small-4 columns">
            <label for="password" class="right inline">PASSWORD:</label>
         </div>
         <div class="small-6 end columns">
            <input type="password" name="password" id="password" required />
            <small class="error">Password must be at least 8 characters.</small>
         </div>
      </div>

      <div class="row">
         <div class="small-4 columns">
            <label for="password_confirm" class="right inline">CONFIRM PASSWORD:</label>
         </div>
         <div class="small-6 end columns">
            <input type="password" name="password_confirmation" id="password_confirmation" required data-equalto="password" />
            <small class="error">Passwords must match.</small>
         </div>
      </div>

   </div>

   <div class="form-group">
      <div class="row">
         <div class="small-offset-1 small-3 columns">
            <input type="checkbox" class="checkbox-right" name="conditions" id="conditions" required>
         </div>
         <div class="small-5 columns end">
            <label for="conditions" class="inline">I ACCEPT ALL OF THE CONDITIONS</label>
            <small class="error">You must accept the conditions.</small>
         </div>
      </div>

      <div class="row">
         <div class="small-offset-1 small-3 columns">
            <input type="checkbox" checked class="checkbox-right" name="newsletters" id="newsletters">
         </div>
         <div class="small-5 columns end">
            <label for="newsletters" class="inline">I WOULD LIKE TO RECEIVE ALL NEWSLETTERS</label>
         </div>
      </div>
   </div>

   <div class="row">
      <div class="small-centered columns">
         <button type="submit" class="submit-button">BEGIN YOUR JOURNEY NOW</button>
         <input type="hidden" name="_token" value="{{ csrf_token() }}">
      </div>
   </div>

@endsection