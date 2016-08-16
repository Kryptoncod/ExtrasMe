<div class="row section-title">
          <div class="small-12 columns">
            <h2>EDITER MON PROFIL</h2>
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
            <label for="name">COMPANY NAME : </label><input type="text" name="company-name" value="{{$professional->company_name}}" required pattern="[a-zA-Z]+">
              <small class="error">Company name is required and must contain only alphanumerics characters.</small>
            </div>
            <div>
            <label for="name">CATEGORY : </label><select name="category">
                   @foreach(config('international.professionals_categories') as $id => $cat)
                      <option value="{{ $id }}" <?php if($professional->category == $cat){ echo"selected";} ?>>{{ $cat }}</option>
                   @endforeach
                </select>
              <small class="error">Category is required and must contain only alphanumerics characters.</small>
            </div>
            <div>
              <label for="name">REFERENCE FIRST NAME : </label><input type="text" name="first-name" value="{{$professional->first_name}}" required pattern="[a-zA-Z]+">
              <small class="error">First name is required and must contain only alphanumerics characters.</small>
            </div>
            <div>
              <label for="name">REFERENCE LAST NAME : </label><input type="text" name="last-name" value="{{$professional->last_name}}" required pattern="[a-zA-Z]+">
              <small class="error">Last name is required and must contain only alphanumerics characters.</small>
            </div>
            <div>
              <label for="email">REFERENCE EMAIL : </label><input type="text" name="email" value="{{$user->email}}" required>
              <small class="error">Email is required</small>
            </div>
            <div>
              <label for="number">REFERENCE CONTACT NUMBER : </label><input type="text" name="phone" value="{{$professional->phone}}" required pattern="[1-9]+">
              <small class="error">Contact number is required and must be valid</small>
            </div>
            <div>
              <label for="number">ADDRESS : </label><input type="text" name="address" value="{{$professional->address}}" required pattern="[1-9]+">
              <small class="error">Address is required</small>
            </div>
            <div>
              <label for="number">ZIPCODE : </label><input type="text" name="zipcode" value="{{$professional->zipcode}}" required pattern="[1-9]+">
              <small class="error">Zipcode is required</small>
            </div>
            <div>
              <label for="number">STATE : </label><input type="text" name="state" value="{{$professional->state}}">
              <small class="error">Sate is required</small>
            </div>
            <div>
              <label for="number">COUNTRY : </label><select name="country">
                   @foreach(config('international.countries') as $id => $cat)
                      <option value="{{ $id }}" <?php if($professional->country == $cat){ echo"selected";} ?>>{{ $cat }}</option>
                   @endforeach
                </select>
              <small class="error">Country is required and must be valid</small>
            </div>
            <div id="change-password-div">
              <button style="padding:10px; margin:10px auto 0px auto; background-color:#222;" id="change-password">Modifier mon mot de passe</button>
            </div>
            <div style="width:100%;display:flex; margin-top:10px; margin-bottom: 30px;">
              <input type="submit" name="go-register" class="submit-account" value="Update">
            </div>
          </form>
        </div>