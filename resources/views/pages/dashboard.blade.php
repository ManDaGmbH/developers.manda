@extends('master')
@section('title','Dashboard')
@section('content')

<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="text-center p-t-10" style="font-variant: small-caps;font-size: 26px;">Welcome To {{config('app.name','')}}</h1>
        </div>
    </div>
		{{-- <h2 style="font-weight:bold;margin:0px 0px 10px 0px;">SUMMARY</h2>
		<div class="row text-center">

              <div class="col-lg-4">
               <div class="counter counter-top p-0">
    			      <div class="counter-content">
                  <i class="fa fa-tasks fa-2x text-success pull-left"></i>
      			      <h2 class="timer count-title count-number pull-left ml-1" data-to="20" data-speed="1500"></h2>
      			      <p class="count-text pull-left ml-2">CURRENT JOBS</p>
                  <div class="clearfix"></div>
                </div>  
			         </div>
              </div>
             
         </div>

        <h2 style="font-weight:bold;margin:30px 0px 10px 0px;">JOBS BY TECHNICIANS 
          <br class="d-md-none d-sm-block"/>
          <i  data-toggle="tooltip" data-placement="top" title="" class="rounded-circle bg-success ml-2 mr-2" data-original-title="Less/Equal 5"></i>
          <i  class="rounded-circle bg-warning mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Less/Equal 10"></i>
          <i  class="rounded-circle bg-danger mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Greater 10"></i>
        </h2>
	<div class="row text-center">
	      
              <div class="col-md-4 mb-2 mb-md-0">
                <div class="counter bg-success p-0">
                  <div class="counter-content">
                    <i class="fa fa-user fa-2x pull-left"></i>
                    <h2 class="timer count-title count-number text-white pull-left ml-1" data-to="02" data-speed="1500"></h2>
                    <p class="count-text text-white pull-left ml-2">RICKY FERNANDO</p>
                    <div class="clearfix"></div>
                  </div>  
                </div>
              </div>

              <div class="col-md-4 mb-2 mb-md-0">
               <div class="counter bg-warning p-0">
                  <div class="counter-content">
                    <i class="fa fa-user fa-2x pull-left text-success"></i>
                    <h2 class="timer count-title count-number pull-left ml-1" data-to="06" data-speed="1500"></h2>
                    <p class="count-text pull-left ml-2">JOHN DOE</p>
                    <div class="clearfix"></div>
                  </div>
                </div>
              </div>

              <div class="col-md-4 mb-2 mb-md-0">
                <div class="counter bg-danger p-0">
                  <div class="counter-content">
                    <i class="fa fa-user fa-2x text-warning pull-left"></i>
                    <h2 class="timer count-title count-number text-white pull-left ml-1" data-to="12" data-speed="1500"></h2>
                    <p class="count-text text-white pull-left ml-2">REG COOPER</p>
                    <div class="clearfix"></div>
                  </div>  
                </div>
              </div>
             
         </div>
<h2 style="font-weight:bold;margin:30px 0px 10px 0px;">RECENT JOBS
  <br class="d-md-none d-sm-block"/>
  <i style="background:#0084ff !important;" class="rounded-circle bg-info ml-2 mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="New"></i>
  <i  data-toggle="tooltip" data-placement="top" title="" class="rounded-circle bg-warning mr-2" data-original-title="Pending"></i>
</h2>
    @include('pages.partials.jobs_search_form')
     @include('pages.partials.recentjobs')
</div>--}}

@endsection