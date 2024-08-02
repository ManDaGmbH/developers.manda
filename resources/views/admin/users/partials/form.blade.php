@csrf
<div class="row clearfix">
    <div class="col-md-6">
        <div class="form-group form-group-default required" aria-required="true">
            <label for="first_name" class="col-md-12 col-form-label text-md-left">{{ __('First Name') }}</label>
            <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" 
                   value="@isset($user){{$user->first_name}}@else{{ old('first_name') }}@endisset" 
                   required autocomplete="first_name" autofocus>
            @error('first_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

    </div>
    <div class="col-md-6">
        <div class="form-group form-group-default required">
            <label for="last_name" class="col-md-12 col-form-label text-md-left">{{ __('Last Name') }}</label>
            <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" 
                   value="@isset($user){{$user->last_name}}@else{{ old('last_name') }}@endisset" 
                   required autocomplete="last_name" autofocus>
            @error('last_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

    </div>
</div>

<div class="row clearfix">
    <div class="col-md-6">
        <div class="form-group form-group-default required">
            <label for="email" class="col-md-12 col-form-label text-md-left">{{ __('Email') }}</label>
            <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" 
                   value="@isset($user){{$user->email}}@else{{ old('email') }}@endisset" 
                   required autocomplete="email" autofocus>
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

    </div>
    <div class="col-md-6">
        <div class="form-group form-group-default required">
            <label for="cemail" class="col-md-12 col-form-label text-md-left">{{ __('Confirm Email') }}</label>
            @isset($create)
            <input id="cemail" type="text" class="form-control @error('email_confirmation') is-invalid @enderror" name="email_confirmation" 
                   value="@isset($user){{$user->email_confirmation}}@else{{ old('email_confirmation') }}@endisset" 
                   required autocomplete="email" autofocus>
            @else
            <input id="cemail" type="text" class="form-control @error('email_confirmation') is-invalid @enderror" name="email_confirmation" 
                   value="@isset($user){{$user->email}}@else{{ old('email_confirmation') }}@endisset" 
                   required autocomplete="email" autofocus>
            @endisset    
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

    </div>
</div>
@isset($create)
<!-- <div class="row clearfix">
<div class="col-md-6">
  <div class="form-group form-group-default required">
    <label for="password" class="col-md-12 col-form-label text-md-left">{{ __('Password') }}</label>
    <input id="password" type="password" class="pr-password form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
    <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password" style="position: absolute;display: inline;right: 5px;
top: 26px;"></span>
    @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
   @enderror    
  </div>
</div>
<div class="col-md-6">
  <div class="form-group form-group-default required">
    <label for="password-confirmation" class="col-md-12 col-form-label text-md-left">{{ __('Password Confirmation') }}</label>
    <input id="password-confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" 
        value="@isset($user){{$user->password_confirmation}}@else{{old('password_confirmation') }}@endisset" 
        required autocomplete="password_confirmation" autofocus>
        <span toggle="#password-confirmation" class="fa fa-fw fa-eye field-icon toggle-password" style="position: absolute;display: inline;right: 5px;
top: 26px;"></span>
    @error('password_confirmation')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
    @enderror
  </div>
  
</div>
</div> -->
@elseif(!isset($profile))
<div class="row clearfix">
    <div class="col-md-12">
        <div class="form-group form-group-default required">
            <label for="status" class="col-md-12 col-form-label text-md-left">{{ __('Status') }}</label>
            <select name="status" class="full-width" data-init-plugin="select2">
                <option value="">Select Status</option>
                <option value="1" @isset($user)@if($user->status == 1){{'selected'}}@endif @endisset>Active</option>
                <option value="0" @isset($user)@if($user->status == 0){{'selected'}}@endif @endisset>In-active</option>
            </select>

            @error('status')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
</div>
@endisset
<div class="card"> <!-- Start of Extra Information-->
    <h4 class="bold" style="padding:0px 10px;font-size:14px;"><a class="toggler" href="#" onClick="toggleSearch('detailfields', '0')">{{ __('Extra Information') }}<span class="pull-right"><i class="fa fa-chevron-down"></i></span></a></h4>
    <div class="card-body" style="display:none" id="detailfields">
        <div class="row clearfix">
            <div class="col-md-6">
                <div class="form-group form-group-default">
                    <label for="phone1" class="col-md-12 col-form-label text-md-left">{{ __('Phone1') }}</label>
                    <input id="phone1" type="text" class="phonemask form-control @error('phone1') is-invalid @enderror" name="phone1" 
                           value="@isset($user){{$user->phone1}}@else{{ old('phone1') }}@endisset" 
                           autofocus>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-group-default">
                    <label for="phone2" class="col-md-12 col-form-label text-md-left">{{ __('Phone2') }}</label>
                    <input id="phone2" type="text" class="phonemask form-control @error('phone2') is-invalid @enderror" name="phone2" 
                           value="@isset($user){{$user->phone2}}@else{{ old('phone2') }}@endisset" 
                           autofocus>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-md-6">
                <div class="form-group form-group-default">
                    <label for="address1" class="col-md-12 col-form-label text-md-left">{{ __('Address1') }}</label>
                    <input id="address1" type="text" class="form-control @error('address1') is-invalid @enderror" name="address1" 
                           value="@isset($user){{$user->address1}}@else{{ old('address1') }}@endisset" 
                           autofocus>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-group-default">
                    <label for="address2" class="col-md-12 col-form-label text-md-left">{{ __('Address2') }}</label>
                    <input id="address2" type="text" class="form-control @error('address2') is-invalid @enderror" name="address2" 
                           value="@isset($user){{$user->address2}}@else{{ old('address2') }}@endisset" 
                           autofocus>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-md-4">
                <div class="form-group form-group-default">
                    <label for="city" class="col-md-12 col-form-label text-md-left">{{ __('City') }}</label>
                    <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" 
                           value="@isset($user){{$user->city}}@else{{ old('city') }}@endisset" 
                           autofocus>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group form-group-default">
                    <label for="state" class="col-md-12 col-form-label text-md-left">{{ __('State/Province') }}</label>
                    <input id="state" type="text" class="form-control @error('state') is-invalid @enderror" name="state" 
                           value="@isset($user){{$user->state}}@else{{ old('state') }}@endisset" 
                           autofocus>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group form-group-default">
                    <label for="zip" class="col-md-12 col-form-label text-md-left">{{ __('Zip/Postal Code') }}</label>
                    <input id="zip" type="text" class="form-control @error('zip') is-invalid @enderror" name="zip" 
                           value="@isset($user){{$user->zip}}@else{{ old('zip') }}@endisset" 
                           autofocus>
                </div>
            </div>
        </div>
    </div>
</div><!-- End of extra Information -->

@isset($roles)
<div class="row clearfix lightsection">
    <p class="col-md-1 col-form-label text-md-left p-0"><strong>Roles</strong></p>
    <div class="col-md-11 text-md-left">
        <div class="checkbox check-success mt-0 @error('roles') is-invalid @enderror">
            @foreach($roles as $role)
            <input class="form-check-input form-control @error('roles') is-invalid @enderror" type="checkbox" name="roles[]" value="{{$role->id}}" id="role-{{$role->name}}"

                   @isset($user)@if(in_array($role->id,$user->roles->pluck('id')->toArray())) checked @endif @endisset
                   />
                   <label class="form-check-label" for="role-{{$role->name}}">{{$role->name}}</label>
            @endforeach

        </div>
        @error('roles')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
@if(!isset($create))
<p class="text text-info bold">If you want to update the permissions, click <a href="{{url('/backend/roles')}}">Manage Roles</a></p>
@endif
@isset($user)
@foreach($roles as $role)
@if(in_array($role->id,$user->roles->pluck('id')->toArray()))
@php
$pageName = "";
$count = 1;
@endphp
<div class="checkbox check-success mt-0 @error('roles') is-invalid @enderror">
    <div class="row m-b-10" style="background-color:#ccc;padding: 10px 0px; 0px 0px;">  
        <div class="col-lg-5">
            <p class="m-t-0 m-b-0" style="letter-spacing: 0.06em;
               text-transform: uppercase;font-family: 'Montserrat';color: #000 !important;font-weight: bold !important;font-size: 14px !important;">

                Pages  
            </p>
        </div>     
        <div class="col-lg-7">
            <p class="m-t-0 m-b-0 m-l-10 d-none d-lg-block pull-left" style="letter-spacing: 0.06em;
               text-transform: uppercase;font-family: 'Montserrat';color: #000 !important;font-weight: bold !important;font-size: 14px !important;">
                Permissions
            </p>
            <p class="bold label label-info d-inline p-1 small pull-right mr-2">{{$role->name}}</p>
            <div class="clearfix"></div>
        </div>  
    </div>  
    <div class="row">   
        @foreach($role->permissions->sortBy(['page','id'])  as $value)
        @if($value->page != $pageName)
        @php $unique = 1;  @endphp
        @else
        @php $unique = 0;  @endphp
        @endif
        @if($count%5 == 0)
        <br class="d-none d-md-block"/> <br class=" d-none d-md-block"/>
        @php $count = 1; @endphp
        @endif
        @if($unique == 1)
        <div class="col-lg-5">
            <p class='m-b-10 m-t-20 firstchildnomargin' style="color:#000"> <input disabled class="form-check-input form-control pagechbx parent-{{str_replace(' ','',$value->page)}}" style="display:none" type="checkbox" checked onChange="checkMark(this.checked,'{{str_replace(' ','',$value->page)}}')" id="parent-{{str_replace(' ','',$value->name)}}">
                <label class="form-check-label bold" for="parent-{{str_replace(' ','',$value->name)}}">{{ucwords($value->page)}}</label></p>
        </div>
        @endif




        @if($value->title != "Create" )
        @php $title = "DELETE" @endphp
        @if($value->title == "List")
        @php $title = "READ" @endphp
        @endif
        @if($value->title == "Edit")
        @php $title = "UPDATE" @endphp
        @endif

        <div class="col-lg-2">
            <input disabled permission-title="{{$value->title}}" permission-page="{{$value->page}}" class="rolecheckbox form-check-input {{str_replace(' ','',$value->page)}} form-control  @error('permission') is-invalid @enderror" type="checkbox" name="permission[]" value="{{$value->id}}" id="permission-{{$value->name}}"

                   @isset($role)@if(in_array($value->id,$role->permissions->pluck('id')->toArray())) checked @endif @endisset
                   />
                   <label class="form-check-label m-l-15" for="permission-{{str_replace(' ','',$value->name)}}">{{$title}}</label>
        </div>
        @endif

        @if($value->title == "Create")
        <input disabled permission-title="{{$value->title}}" permission-page="{{$value->page}}" class="rolecheckbox form-check-input {{str_replace(' ','',$value->page)}} form-control  create" type="checkbox" name="permission[]" value="{{$value->id}}" id="permission-{{$value->name}}"

               @isset($role)@if(in_array($value->id,$role->permissions->pluck('id')->toArray())) checked @endif @endisset
               />

               @endif
               @php
               $pageName = $value->page;
               $count++;
               @endphp

               @endforeach
    </div>
</div>
@endif
@endforeach
@endif
@endisset
<div class="form-group row mb-0">
    <div class="col-md-12 offset-md-12">
        @if(!isset($create))
        @php
        $reseturl = "backend/reset-password-manually/".$user->email;
        @endphp
        @if($user->id != Auth::user()->id)
        <a href="@php echo url("$reseturl") @endphp" class="btn btn-info float-left">Reset Password</a>
        @endif
        @endisset
        <button id="save-form" type="submit" class="btn btn-primary float-right">
            @isset($create)
            {{ __('Create') }}
            @else
            {{ __('Update') }}
            @endisset
        </button>
    </div>
</div>
<script>
    $(".toggle-password").click(function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
    input.attr("type", "text");
    } else {
    input.attr("type", "password");
    }
    });

</script>                        