@php
$user_label1 = "First Name"; 
$user_label2 = "Last Name"; 
$user_label3 = "Email"; 
$user_label4 = "Status"; 
$user_label5 = "Role"; 
$user_label6 = "Action"; 
@endphp
<div class="container grid-wrapper p-3 mt-2">
  <div class="grid-header">
    <div class="row d-none d-md-flex mb-md-2 p-md-1">
      <div class="col-2">
          <h4 class="small bold m-0">{{$user_label1}}</h4>
      </div>
      <div class="col-2">
          <h4 class="small bold m-0">{{$user_label2}}</h4>
      </div>
      <div class="col-3">
          <h4 class="small bold m-0">{{$user_label3}}</h4>
      </div>
      <div class="col-1">
          <h4 class="small bold m-0">{{$user_label4}}</h4>
      </div>
      <div class="col-2">
          <h4 class="small bold m-0">{{$user_label5}}</h4>
      </div>
      <div class="col-2">
          <h4 class="small bold m-0">{{$user_label6}}</h4>
      </div>

    </div>
  </div>
<div class="grid-body">
    @foreach($users as $user)
    @php 
        $active = '<i style="" class="rounded-circle bg-success" data-toggle="tooltip" data-placement="top" title=""></i>';
        $inactive = '<i style="" class="rounded-circle bg-danger" data-toggle="tooltip" data-placement="top" title=""></i>';
    @endphp
   <div class="row mb-md-0 p-md-1 mb-3 p-1">
    <div class="col-3 col-sm-3 col-md-2">
      <h4 class="d-md-none d-sm-inline bold small m-0 p-0">{{$user_label1}}</h4>
        <p class="m-0 p-1">{{$user->first_name}}</p>
    </div>
    <div class="col-3 col-sm-3 col-md-2">
        <h4 class="d-md-none d-sm-inline bold small m-0 p-0">{{$user_label2}}</h4>
        <p class="m-0 p-1">{{$user->last_name}}</p>
    </div>
    <div class="col-6 col-sm-6 col-md-3">
      <h4 class="d-md-none d-sm-inline bold small m-0 p-0">{{$user_label3}}</h4>
        <p class="m-0 p-1">{{$user->email}}</p>
    </div>
    <div class="col-3 col-sm-3 col-md-1">
      <h4 class="d-md-none d-sm-inline bold small m-0 p-0">{{$user_label4}}</h4>
        <p class="m-0 p-1">
            @if($user->status == 1)@php echo $active @endphp @else @php echo $inactive @endphp @endif
        </p>
    </div>
    <div class="col-5 col-sm-5 col-md-2 ">
      <h4 class="d-md-none d-sm-inline bold small m-0 p-0">{{$user_label5}}</h4>
        <p class="m-0 p-1">
            @if(!empty($user->getRoleNames()))
            @foreach($user->getRoleNames() as $v)
            <span class="label label-info d-inline-block">{{ $v }}</span>
            @endforeach
            @endif
        </p>
    </div>
    <div class="col-4 col-sm-4 col-md-2">
      <h4 class="d-md-none d-sm-inline bold small m-0 p-0">{{$user_label6}}</h4>
      <br class="d-none d-md-none d-sm-block "/>
            @can('user-edit')
            <a href="{{route('admin.users.edit',$user->id)}}" class="btn btn-primary mr-1 pt-1 pb-1 pl-2 pr-2" role="button"><i class="fa fa-pencil"></i></a>   
            @endcan
            @can('user-delete')
            @if($user->id != Auth::user()->id)
            <button class="btn btn-danger pt-1 pb-1 pl-2 pr-2" onClick="event.preventDefault();deleteConfirm('user-delete-form-{{$user->id}}', 'You are about to delete a user, Are you sure?')"><i class="fa fa-trash"></i></button>
            <form class="user-form" id="user-delete-form-{{$user->id}}" style="display:none;" action="{{route('admin.users.destroy',$user->id)}}" method="POST">
                @csrf
                @method('DELETE')
            </form>
            @endif
            @endcan
    </div>
  </div> <!-- End of ROW -->
  @endforeach
</div>
</div>

{{ $users->links() }}
