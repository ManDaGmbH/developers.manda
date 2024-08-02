@php
$recentjobs_label1 = "Status"; 
$recentjobs_label2 = "Date"; 
$recentjobs_label3 = "Job#"; 
$recentjobs_label4 = "Technician";  
$recentjobs_label5 = "Customer";  
@endphp
<div class="container grid-wrapper p-3" style="">
  <div class="grid-header">
    <div class="row d-none d-md-flex mb-md-0 p-md-1">
      <div class="col-1">
          <h4 class="small bold m-0">{{$recentjobs_label1}}</h4>
      </div>
      <div class="col-2">
          <h4 class="small bold m-0">{{$recentjobs_label2}}</h4>
      </div>
      <div class="col-3">
          <h4 class="small bold m-0">{{$recentjobs_label3}}</h4>
      </div>
      <div class="col-3">
          <h4 class="small bold m-0">{{$recentjobs_label4}}</h4>
      </div>
      <div class="col-3">
          <h4 class="small bold m-0">{{$recentjobs_label5}}</h4>
      </div>
    </div>
  </div>
<div class="grid-body">
   <div class="row mb-md-0 p-md-1 mb-3 p-1">
    <div class="col-3 col-sm-3 col-md-1">
      <h4 class="d-md-none d-sm-inline bold small m-0 p-0">{{$recentjobs_label1}}</h4>
        <p class="m-0 p-1">
            <i style="background:#0084ff !important;" class="rounded-circle bg-info" data-toggle="tooltip" data-placement="top" title=""></i>
          </p>
    </div>
    <div class="col-5 col-sm-5 col-md-2">
      <h4 class="d-md-none d-sm-inline bold small m-0 p-0">{{$recentjobs_label2}}</h4>
        <p class="m-0 p-1">06-10-2021</p>
    </div>
    <div class="col-4 col-sm-4 col-md-3">
        <h4 class="d-md-none d-sm-inline bold small m-0 p-0">{{$recentjobs_label3}}</h4>
        <p class="m-0 p-1">JPZ-1010</p>
    </div>
    <div class="col-6 col-sm-6 col-md-3 ">
      <h4 class="d-md-none d-sm-inline bold small m-0 p-0">{{$recentjobs_label4}}</h4>
        <p class="m-0 p-1">Reg Cooper</p>
    </div>
    <div class="col-6 col-sm-6 col-md-3">
      <h4 class="d-md-none d-sm-inline bold small m-0 p-0">{{$recentjobs_label5}}</h4>
        <p class="m-0 p-1">Mark G</p>
    </div>
  </div>
    
   <div class="row mb-md-0 p-md-1 mb-3 p-1">
    <div class="col-3 col-sm-3 col-md-1">
      <h4 class="d-md-none d-sm-inline bold small m-0 p-0">{{$recentjobs_label1}}</h4>
        <p class="m-0 p-1">
               <i  data-toggle="tooltip" data-placement="top" title="" class="rounded-circle bg-warning"></i> 
        </p>
    </div>
    <div class="col-5 col-sm-5 col-md-2">
      <h4 class="d-md-none d-sm-inline bold small m-0 p-0">{{$recentjobs_label2}}</h4>
        <p class="m-0 p-1">06-09-2021</p>
    </div>
    <div class="col-4 col-sm-4 col-md-3">
        <h4 class="d-md-none d-sm-inline bold small m-0 p-0">{{$recentjobs_label3}}</h4>
        <p class="m-0 p-1">JPZ-10100</p>
    </div>
    
    <div class="col-6 col-sm-6 col-md-3 ">
      <h4 class="d-md-none d-sm-inline bold small m-0 p-0">{{$recentjobs_label4}}</h4>
        <p class="m-0 p-1">Reg Cooper</p>
    </div>
    <div class="col-6 col-sm-6 col-md-3">
      <h4 class="d-md-none d-sm-inline bold small m-0 p-0">{{$recentjobs_label5}}</h4>
        <p class="m-0 p-1">Josh A</p>
    </div>
  </div>
</div>
</div>
<!-- <table id="example" class="table table-striped table-bordered nowrap" style="width:100%;background: #fff;
    padding: 15px">
        <thead>
            <tr>
                <th>Job#</th>
                <th>Status</th>
                <th>Technician</th>
                <th>Customer</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>JPZ-1010</td>
                <td><span class="label label-info">New</span></td>
                <td>Reg Cooper</td>
                <td>Josh A</td>
                <td>06-10-2021</td>
            </tr>
            <tr>
                <td>JPZ-1008</td>
                <td><span class="label label-warning">Pending</span></td>
                <td>Reg Cooper</td>
                <td>John Fernando</td>
                <td>06-09-2021</td>
            </tr>
            <tr>
                <td>JPZ-1006</td>
                <td><span class="label label-info">New</span></td>
                <td>John Doe</td>
                <td>Ricky Martin</td>
                <td>06-07-2021</td>
            </tr>
            <tr>
                <td>JPZ-1004</td>
                <td><span class="label label-info">New</span></td>
                <td>Reg Cooper</td>
                <td>Mark G</td>
                <td>06-03-2021</td>
            </tr>
            <tr>
                <td>JPZ-1001</td>
                <td><span class="label label-warning">Pending</span></td>
                <td>Ricky Fernando</td>
                <td>Kerri Sack</td>
                <td>06-01-2021</td>
            </tr>
        
        </tbody>
    </table> -->