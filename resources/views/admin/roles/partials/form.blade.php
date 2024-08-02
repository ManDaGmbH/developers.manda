@csrf

                        <div class="row clearfix">
                        <div class="col-md-7 offset-md-3">
                          <div class="form-group form-group-default required" aria-required="true">
                            <label for="name" class="col-md-12 col-form-label text-md-left">{{ __('Role Name') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" 
                                value="@isset($role){{$role->name}}@else{{old('name')}}@endisset" 
                                required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                          </div>
                          
                        </div>
                      </div>
<div class="form-group row lightsection">
                            <!-- <p class="col-md-3 offset-md-5 col-form-label m-t-0 m-b-10"><strong>Permissions</strong></p> -->
                            <div class="col-md-12 offset-md-0">
          
            @php
                $pageName = "";
                $count = 1;
            @endphp
            

            <div class="checkbox check-success mt-0 @error('roles') is-invalid @enderror">
                        <p class="bold text-center" for="megapage" style="color: #000 !important;font-weight: bold !important;font-size: 16px !important;">Permissions</p>
                        <div class="row m-b-10" style="background-color:#ccc;padding: 10px 0px; 0px 0px;">  
                        <div class="col-lg-6">
                         <p class="m-t-0 m-b-0" style="color: #000 !important;font-weight: bold !important;font-size: 14px !important;">
                            <input class="form-check-input form-control" id="megapage" style="display:none" type="checkbox" checked onChange="checkuncheckpage(this.checked)" id="">
                            <label class="form-check-label bold" for="megapage" style="color: #000 !important;font-weight: bold !important;font-size: 12px !important;">Pages</label>   
                        </p>
                        </div>     
                        <div class="col-lg-6">
                            <!-- <p class="m-t-0 m-b-0 m-l-10 d-none d-lg-block" style="letter-spacing: 0.06em;
    text-transform: uppercase;font-family: 'Montserrat';color: #000 !important;font-weight: bold !important;font-size: 14px !important;">
                            
                            Permissions
                        </p> -->
                        <div class="row" style="margin-left: -10px;">
                            <div class="col-lg-4">
                                <input class="allread form-check-input  form-control " type="checkbox" id="all-read" />
                                <label style="font-size: 12px;font-weight: bold;letter-spacing: normal;font-family: arial;color: #000;" class="form-check-label m-l-15" for="all-read">Read</label>
                            </div>

                            <div class="col-lg-4">
                                <input class="allupdate form-check-input  form-control " type="checkbox" id="all-update" />
                                <label style="font-size: 12px;font-weight: bold;letter-spacing: normal;font-family: arial;color: #000;" class="form-check-label m-l-15" for="all-update">Update</label>
                            </div>

                            <div class="col-lg-4">
                                <input class="alldelete form-check-input  form-control " type="checkbox" id="all-delete" />
                                <label style="font-size: 12px;font-weight: bold;letter-spacing: normal;font-family: arial;color: #000;" class="form-check-label m-l-15" for="all-delete">Delete</label>
                            </div>
                        </div>
                        </div>  
                        </div>  
                        <div class="row">   
            @foreach($permission as $value)
               @if($value->page != $pageName)
                @php $unique = 1;  @endphp
               @else
               @php $unique = 0;  @endphp
               @endif
               @if($count%5 == 0)
               <br /> <br/ >
               @php $count = 1; @endphp
               @endif
               @if($unique == 1 && $value->title != "Create")
               <div class="col-lg-6">
                <p class='m-b-10 m-t-20 firstchildnomargin' style="color:#000"> <input class="form-check-input form-control pagechbx parent-{{str_replace(' ','',$value->page)}}" style="display:none" type="checkbox" checked onChange="checkMark(this.checked,'{{str_replace(' ','',$value->page)}}')" id="parent-{{str_replace(' ','',$value->name)}}">
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
                        <input permission-title="{{$value->title}}" permission-page="{{$value->page}}" class="rolecheckbox form-check-input {{str_replace(' ','',$value->page)}} form-control {{$value->title}}  @error('permission') is-invalid @enderror" type="checkbox" name="permission[]" value="{{$value->id}}" id="permission-{{$value->name}}"

                                            @isset($role)@if(in_array($value->id,$role->permissions->pluck('id')->toArray())) checked @endif @endisset
                                            />
                                            <label class="form-check-label m-l-15" for="permission-{{str_replace(' ','',$value->name)}}">{{$title}}</label>
                   </div>
                @endif

                @if($value->title == "Create")
                 <input permission-title="{{$value->title}}" permission-page="{{$value->page}}" class="rolecheckbox form-check-input {{str_replace(' ','',$value->page)}} form-control {{$value->title}} create" type="checkbox" name="permission[]" value="{{$value->id}}" id="permission-{{$value->name}}"

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
           


            
        </div>
        </div>
    
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">
            @isset($role)
            Update
            @else
            Create
            @endisset
        </button>
    </div>
</div>

<script>
    function checkMark(isChecked,className){
        $("."+className).prop('checked',isChecked);
    }

    function checkuncheckpage(isChecked) {
        $('.pagechbx').prop('checked',isChecked);
        $('.rolecheckbox').prop('checked',isChecked);
        $('.allread').prop('checked',isChecked);
        $('.allupdate').prop('checked',isChecked);
        $('.alldelete').prop('checked',isChecked);
    }
    $(document).ready(function(){
        var nochecked = 0;
        $( ".rolecheckbox" ).each(function( index ) {
                var classname = $(this).attr('class').split(' ')[2];
                if($(this).is(':checked') == false) {
                    $('.parent-'+classname).prop('checked',false);
                } else {
                    nochecked = 1;
                }
                $('.parent-'+classname).show();
                if(nochecked == 0) {
                    $('.parent-'+classname).prop('checked',false);
                }
        });
        $( ".pagechbx" ).each(function( index ) {
            if($(this).is(':checked') == false) {
                    $('#megapage').prop('checked',false);
            } 
        });
    });

    $( ".pagechbx" ).change(function(){
                if($(this).is(':checked') == false) {
                    $('#megapage').prop('checked',false);
                } else {
                    var notchecked = 0;
                    $( ".pagechbx" ).each(function( index ) {
                        if($(this).is(':checked') == false) {
                                notchecked = 1;
                        } 
                        
                    });
                    if(notchecked == 0) {
$('#megapage').prop('checked',true);
                        }
                }
    });
    $(".rolecheckbox").change(function(){
        var page = $(this).attr('permission-page');
        var title = $(this).attr('permission-title');
        if(title == "Edit") {
            if($(this).is(':checked') == false) {
                $("."+page + ".create").prop('checked',false);

            } else {
                $("."+page + ".create").prop('checked',true);
            }
        } 

        var nochecked = 1;
        var classname = $(this).attr('class').split(' ')[2];
        $( "."+classname ).each(function( index ) {
                if($(this).is(':checked') == false) {
                    nochecked = 0;
                } 
                if(nochecked == 1) {
                    $('.parent-'+classname).prop('checked',true);

                } else {
                    $('.parent-'+classname).prop('checked',false);
                    
                }
        });
        if($(this).is(":checked") == false) {
            $(".parent-"+($(this).attr('class').split(' ')[2])).prop('checked',false);
        }

        var allchecked = 1;
        
        $( "."+title ).each(function( index ) {
            if($(this).is(':checked') == false) {
                allchecked = 0;
            }
        });
        if(title == "List") {
            var allcheckedclass = "allread";
        } else if(title == "Edit" || title == "Create") {
            var allcheckedclass = "allupdate";
        } else {
            var allcheckedclass = "alldelete";
        }
        if(allchecked == 0) {
            $("."+allcheckedclass).prop('checked',false);
        } else {
            $("."+allcheckedclass).prop('checked',true);
        }
    });

    $(".rolecheckbox").change(function() {
         if($(this).is(':checked') == false) {
            $('#megapage').prop('checked',false);
        } else {
            var checked=1;
           $(".rolecheckbox").each(function( index ) {
                if($(this).is(':checked') == false){
                    checked=0;
                } 
            });
            if(checked == 1) {
                    $('#megapage').prop('checked',true);
                } 
        }
        
    });

    $(".allread").change(function(){
       if($(this).is(':checked') == false){
            $(".List").prop('checked',false);
        }else {
            $(".List").prop('checked',true);
        }
    });

    $(".allupdate").change(function(){
       if($(this).is(':checked') == false){
            $(".Edit").prop('checked',false);
            $(".Create").prop('checked',false);
        }else {
            $(".Edit").prop('checked',true);
            $(".Create").prop('checked',true);
        }
    });

    $(".alldelete").change(function(){
       if($(this).is(':checked') == false){
            $(".Delete").prop('checked',false);
            }else {
            $(".Delete").prop('checked',true);
        }
    });

    $(document).ready(function(){
        var allchecked = 1;
        var title = "List";
        
        $( "."+title ).each(function( index ) {
            if($(this).is(':checked') == false) {
                allchecked = 0;
            }
        });
        if(title == "List") {
            var allcheckedclass = "allread";
        } 
        if(allchecked == 0) {
            $("."+allcheckedclass).prop('checked',false);
        } else {
            $("."+allcheckedclass).prop('checked',true);
        }

        var allchecked = 1;
        var title = "Edit";
        
        $( "."+title ).each(function( index ) {
            if($(this).is(':checked') == false) {
                allchecked = 0;
            }
        });
        if(title == "Edit" || title == "Create") {
            var allcheckedclass = "allupdate";
        } 
        if(allchecked == 0) {
            $("."+allcheckedclass).prop('checked',false);
        } else {
            $("."+allcheckedclass).prop('checked',true);
        }

        var allchecked = 1;
        var title = "Delete";
        
        $( "."+title ).each(function( index ) {
            if($(this).is(':checked') == false) {
                allchecked = 0;
            }
        });
        if(title == "Delete") {
            var allcheckedclass = "alldelete";
        } 
        if(allchecked == 0) {
            $("."+allcheckedclass).prop('checked',false);
        } else {
            $("."+allcheckedclass).prop('checked',true);
        }
    });
</script>