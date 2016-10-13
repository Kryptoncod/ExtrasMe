<div class="row section-title">
        <div class="small-12 columns">
          <h2>@lang('account.editProfil')</h2>
        </div>
      </div>
      <div style="display:flex; width: 70%; margin:auto;">
        <form style="width:100%;" data-abide action="{{ route('profile_update', Auth::user()->id) }}" method="POST" id="profile-form">
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
        <div class="image-editor" style="display:flex;">
          <div class="cropit-preview">
            @if(file_exists("uploads/pp/".$user->id.".png"))
              <img class="profile-picture" src="../uploads/pp/{{$user->id}}.png" alt="" style="width:243px; margin-left:1px; margin-top:1px;" />
            @endif
          </div>
            <div class="image-size-label">
            </div>
          <div style="display: flex; flex-direction:column; justify-content: center; margin-left: 20px;">
            <input type="file" class="cropit-image-input" style="color:white;">
            <input type="range" class="cropit-image-zoom-input">
            <input type="hidden" name="image-data" class="hidden-image-data" />
          </div>
        </div>
          <div>
            <label for="name">@lang('student.firstName')</label><input type="text" name="first-name" value="{{$student->first_name}}" required pattern="[a-zA-Z]+">
            <small class="error">First name is required and must contain only alphanumerics characters.</small>
          </div>
          <div>
            <label for="name">@lang('student.lastName')</label><input type="text" name="last-name" value="{{$student->last_name}}" required pattern="[a-zA-Z]+">
            <small class="error">Last name is required and must contain only alphanumerics characters.</small>
          </div>
          <div>
            <label for="email">@lang('student.email')</label><input type="text" name="email" value="{{$user->email}}" required pattern=".+@ehl.ch$">
            <small class="error">Email is required and must end with @ehl.ch.</small>
          </div>
          <div>
            <label for="number">@lang('student.contactNumber')</label><input type="text" name="phone" value="{{$student->phone}}" required pattern="[1-9]+">
            <small class="error">Contact number is required and must be valid</small>
          </div>
          <div id="next-to-password">
            <label for="year">@lang('student.year')</label><select name="school_year">
                 @foreach(config('international.ehl_years') as $id => $year)
                    <option value="{{ $id }}" <?php if($student->school_year == $year){ echo"selected";} ?>>{{ $year }}</option>
                 @endforeach
              </select>
              <small class="error">EHL's year is required.</small>
          </div>
          <div>
            <label for="adress">@lang('student.adress')</label><input type="text" name="adress" value="{{$student->address}}" required pattern="[1-9]+">
            <small class="error">Adress is required and must be valid</small>
          </div>
          <div>
            <label for="city">@lang('student.city')</label><input type="text" name="city" value="{{$student->city}}" required pattern="[1-9]+">
            <small class="error">City is required and must be valid</small>
          </div>
          <div>
            <label for="zipcode">@lang('student.zipcode')</label><input type="text" name="zipcode" value="{{$student->zipcode}}" required pattern="[1-9]+">
            <small class="error">Zipcode is required and must be valid</small>
          </div>
          <div>
            <label for="state">@lang('student.state')</label><input type="text" name="state" value="{{$student->state}}" required pattern="[1-9]+">
            <small class="error">State is required and must be valid</small>
          </div>
          <div>
            <label for="country">@lang('student.country')</label><input type="text" name="country" value="{{$student->country}}" required pattern="[1-9]+">
            <small class="error">Country is required and must be valid</small>
          </div>
          <div id="change-password-div">
            <button style="padding:10px; margin:10px auto 0px auto; background-color:#222;" id="change-password"><a href="{{ url(Auth::user()->id.'/password/reset') }}">@lang('account.modifyPassword')</a></button>
          </div>
          <div style="width:100%;display:flex; margin-top:10px; margin-bottom: 30px;">
            <input type="submit" name="go-register" class="submit-account" value="Update">
          </div>
        </form>
      </div>