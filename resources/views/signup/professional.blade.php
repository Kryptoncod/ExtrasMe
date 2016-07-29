@extends('signup.common', ['title' => 'Professional sign up', 'formTitle' => 'SIGN UP', 'action' => route('register_professional')])
@section('form')

   <div class="form-group">

      <div class="row">
         <div class="small-4 columns">
            <label for="company_name" class="right inline">COMPANY NAME:</label>
         </div>
         <div class="small-6 end columns">
            <input type="text" name="company_name" id="company_name" required pattern="[a-zA-Z]+" />
            <small class="error">Company name is required.</small>
         </div>
      </div>

      <div class="row">
         <div class="small-4 columns">
            <label for="category" class="right inline">CATEGORY:</label>
         </div>
         <div class="small-6 end columns">
            <select name="category" required>
               <option selected disabled value="">Please select ...</option>
               @foreach(config('international.professionals_categories') as $id => $cat)
                  <option value="{{ $id }}">{{ $cat }}</option>
               @endforeach
            </select>
            <small class="error">Category is required.</small>
         </div>
      </div>
   </div>

   <div class="form-group">

      <div class="row">
         <div class="small-4 columns">
            <label for="representative_name" class="right inline">REPRESENTATIVE NAME:</label>
         </div>
         <div class="small-6 end columns">
            <input type="text" name="representative_name" id="representative_name" required pattern="[a-zA-Z]+" />
            <small class="error">Representative name is required.</small>
         </div>
      </div>

      <div class="row">
         <div class="small-4 columns">
            <label for="representative_last_name" class="right inline">REPRESENTATIVE LAST NAME:</label>
         </div>
         <div class="small-6 end columns">
            <input type="text" name="representative_last_name" id="representative_last_name" required pattern="[a-zA-Z]+" />
            <small class="error">Representative last name is required.</small>
         </div>
      </div>

      <div class="row">
         <div class="small-4 columns">
            <label for="contact_number" class="right inline">CONTACT NUMBER:</label>
         </div>
         <div class="small-6 end columns">
            <input type="text" name="contact_number" id="contact_number" required pattern="number" />
            <small class="error">Contact number must contains only numbers.</small>
         </div>
      </div>

      <div class="row">
         <div class="small-4 columns">
            <label for="address" class="right inline">ADDRESS:</label>
         </div>
         <div class="small-6 end columns">
            <input type="text" name="address" id="address" required />
            <small class="error">Address is required and must be valid.</small>
         </div>
      </div>

      <div class="row">
         <div class="small-4 columns">
            <label for="state" class="right inline">STATE:</label>
         </div>
         <div class="small-6 end columns">
            <input type="text" name="state" id="state" required />
            <small class="error">State is required and must be valid.</small>
         </div>
      </div>

      <div class="row">
         <div class="small-4 columns">
            <label for="zipcode" class="right inline">ZIPCODE:</label>
         </div>
         <div class="small-6 end columns">
            <input type="text" name="zipcode" id="zipcode" required />
            <small class="error">Zipcode is required and must be valid.</small>
         </div>
      </div>

      <div class="row">
         <div class="small-4 columns">
            <label for="country" class="right inline">COUNTRY:</label>
         </div>
         <div class="small-6 end columns">
            <select name="country" required>
               <option selected disabled value="">Please select ...</option>
               @foreach(config('international.countries') as $id => $country)
                  <option value="{{ $id }}">{{ $country }}</option>
               @endforeach
            </select>
            <small class="error">Country is required.</small>
         </div>
      </div>

   </div>

   <div class="form-group">

      <div class="row">
         <div class="small-4 columns">
            <label for="email_address" class="right inline">EMAIL ADDRESS:</label>
         </div>
         <div class="small-6 end columns">
            <input type="email" name="email_address" id="email_address" required />
            <small class="error">Email address must be valid.</small>
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
            <label for="conditions" class="inline">I ACCEPT ALL THE CONDITIONS</label>
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
