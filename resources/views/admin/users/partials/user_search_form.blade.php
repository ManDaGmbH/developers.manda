<div class="clearfix"></div>
<div class="row ">
    <div class="col-md-12">
        <div class="card">
            <h4 class="bold" style="padding:0px 10px;font-size:18px;"><a class="toggler" href="#" onClick="toggleSearch('searchfields')">{{ __('Advanced Search') }}<span class="pull-right"><i class="fa fa-chevron-down"></i></span></a></h4>
            <?php
            $display = 'display:none;';
            $requestData = [
                "first_name" => null,
                "last_name" => null,
                "email" => null,
                "role" => null,
                "status" => null,
            ];
            if (Request::all()) {
                $requestData = Request::all();
                $isData = 1;
            }
            if(isset($isData)) {
                $display = '';
            }
            
//            dump($requestData);exit;
            extract($requestData, EXTR_PREFIX_ALL, "ex");
            ?>
            <div class="card-body" style="{{ $display }}" id="searchfields">
                <form method="post" id="searchform" accept-charset="utf-8" action="{{route('admin.users.index')}}">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="sort_field" class="sort_field" value="">
                        <input type="hidden" name="sort_order" class="sort_order" value="">
                        <div class="col-lg-3">
                            <input autofocus="" type="text" name="first_name" value="{{ $ex_first_name }}" class=" searchfield form-control" placeholder="First Name" id="account-name">     
                        </div>
                        <div class="col-lg-3">
                            <input type="text" name="last_name" value="{{ $ex_last_name }}" class=" searchfield form-control" placeholder="Last Name" id="account-name">     
                        </div>
                        <div class="col-lg-2">
                            <input type="text" name="email" class="searchfield form-control" placeholder="Email" id="email" value="{{ $ex_email }}">     
                        </div>
                        <div class="col-lg-2">
                            <select name="role" class="form-control" >
                                <option value="">Select Role</option>
                                @foreach($roles as $role)
                                <option <?= $ex_role == $role->id ? 'selected' : '' ?> value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="col-lg-2">
                            <select name="status" class="form-control" >
                                <option value="">Select Status</option>
                                <option value="1" <?= ($ex_status) ? 'selected' : '' ?> >Active</option>
                                <option value="0" <?= ($ex_status == '0') ? 'selected' : '' ?>>Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <input type="reset" name="reset" class="btn btn-success" style="margin-top:25px;" value="Reset" onClick="resetForm('searchform')">
                            <input type="submit" name="search" class="btn btn-primary" style="margin-top:25px;" value="Search" id="searchBnt">
                            <br>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    

</script>
