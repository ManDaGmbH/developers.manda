@if(session()->has('error'))
	<div class="alert alert-danger" role="alert">
        <button class="close" data-dismiss="alert"></button>
        {{Session::get('error')}}
    </div>
@endif
@if(session()->has('success'))
              <div class="alert alert-success" role="alert">
                    <button class="close" data-dismiss="alert"></button>
                    {{Session::get('success')}}
                </div>
 @endif