            @csrf
            @isset($isChangepass)
            <!-- START Form Control-->
            <div class="form-group @error('password'){{'has-error'}} @enderror">
              <div class="controls" style="position:relative">
                <input type="password" id="current-password" name="currentpassword" placeholder="Provide Your Current Password" required class="form-control @error('currentpassword'){{'error'}} @enderror" autocomplete="off">
                 <span toggle="#current-password" class="fa fa-fw fa-eye field-icon toggle-password" style="position: absolute;display: inline;right: 5px;
    top: 35%;"></span>
              </div>
            </div>
            @error('currentpassword')
            <label id="current-password-error" class="error" for="current-password">{{$message}}</label>
            @enderror
            <!-- END Form Control-->
            @endisset

            <!-- START Form Control-->
            <div class="form-group animate__animated animate__backInLeft @error('password'){{'has-error'}} @enderror">
              <div class="controls" style="position:relative">
                <input type="password" id="password" name="password" placeholder="Type New Password" required class="pr-password form-control @error('password'){{'error'}} @enderror" autocomplete="off">
                 <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password" style="position: absolute;display: inline;right: 5px;
    top: 35%;"></span>
              </div>
            </div>
            @error('password')
            <label id="password-error" class="error" for="password">{{$message}}</label>
            @enderror
            <!-- END Form Control-->

            <!-- START Form Control-->
            <div class="form-group animate__animated animate__backInRight @error('password_confirmation'){{'has-error'}} @enderror">
              
              <div class="controls" style="position:relative">
                <input id="password-confirmation" type="password" name="password_confirmation" placeholder="Confirm Password" required class="form-control @error('password_confirmation'){{'error'}} @enderror" autocomplete="off">
                   <span toggle="#password-confirmation" class="fa fa-fw fa-eye field-icon toggle-password" style="position: absolute;display: inline;right: 5px;
    top: 35%;"></span>
              </div>
            </div>
            @error('password_confirmation')
            <label id="confirm-password-error" class="error" for="password_confirmation">{{$message}}</label>
            @enderror
            <!-- END Form Control-->