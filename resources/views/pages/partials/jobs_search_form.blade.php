<div class="clearfix"></div>
<div class="row ">
    <div class="col-md-12">
        <div class="card">
            <h4 class="bold" style="padding:0px 10px;font-size:18px;"><a class="toggler" href="#" onClick="toggleSearch('searchfields')">{{ __('Advanced Search') }}<span class="pull-right"><i class="fa fa-chevron-down"></i></span></a></h4>
            <?php
            $display = 'display:none;';
            $requestData = [
                "status" => null,
                "from_date" => null,
                "to_date" => null,
                "jobnumber" => null,
                "technician_name" => null,
                "customer_name" => null,
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
                <form method="post" id="searchform" accept-charset="utf-8" action="javascript:">
                    @csrf
                    <div class="row">
                        <div class="col-lg-2">
                            <select name="status" class="form-control" >
                                <option value="">Select Status</option>
                                <option value="1" <?= ($ex_status) ? 'selected' : '' ?> >New</option>
                                <option value="0" <?= ($ex_status == '0') ? 'selected' : '' ?>>Pending</option>
                            </select>
                        </div>
                        <div class="col-lg-2">
                            <input autofocus="" type="text" name="from_date" value="{{ $ex_from_date }}" class=" searchfield form-control datepicker" placeholder="From Date" id="from-date">     
                        </div>
                        <div class="col-lg-2">
                            <input autofocus="" type="text" name="to_date" value="{{ $ex_to_date }}" class=" searchfield form-control datepicker" placeholder="To Date" id="to-date">     
                        </div>
                        <div class="col-lg-2">
                            <input type="text" name="jobnumber" value="{{ $ex_jobnumber }}" class=" searchfield form-control" placeholder="Job#" id="job-number">     
                        </div>
                        <div class="col-lg-2">
                            <input type="text" name="technician_name" class="searchfield form-control" placeholder="Technician Name" id="technician_name" value="{{ $ex_technician_name }}">     
                        </div>
                        <div class="col-lg-2">
                            <input type="text" name="customer_name" class="searchfield form-control" placeholder="Customer Name" id="customer_name" value="{{ $ex_customer_name }}">     
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
