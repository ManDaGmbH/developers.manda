@php
$role_label1 = "Name";  
$role_label2 = "Action"; 
@endphp
<div class="container grid-wrapper p-3 mt-2">
  <div class="grid-header">
    <div class="row d-none d-md-flex mb-md-2 p-md-1">
      <div class="col-6">
          <h4 class="small bold m-0">{{$role_label1}}</h4>
      </div>
      <div class="col-6">
          <h4 class="small bold m-0">{{$role_label2}}</h4>
      </div>
    </div>
  </div>
<div class="grid-body">
 @foreach ($roles as $key => $role)
 <div class="row mb-md-0 p-md-1 mb-3 p-1">
    <div class="col-6 col-sm-6 col-md-6">
      <h4 class="d-md-none d-sm-inline bold small m-0 p-0">{{$role_label1}}</h4>
        <p class="m-0 p-1">{{$role->name}}</p>
    </div>
    <div class="col-6 col-sm-6 col-md-6">
      <h4 class="d-md-none d-sm-inline bold small m-0 p-0">{{$role_label2}}</h4>
      <br class="d-none d-md-none d-sm-block "/>
            @can('role-edit')
                <a class="btn btn-primary pt-1 pb-1 pl-2 pr-2" href="{{ route('admin.roles.edit',$role->id) }}"><i class="fa fa-pencil"></i></a>
            @endcan
            @if(strtolower($role->name) != "admin")
            @can('role-delete')
            <button class="btn btn-danger pt-1 pb-1 pl-2 pr-2" onClick="event.preventDefault();deleteConfirm('role-delete-form-{{$role->id}}','Users having this role will loose their permsisions , Are you sure you want to delete?').submit()"><i class="fa fa-trash"></i></button>
                <form id="role-delete-form-{{$role->id}}" style="display:none;" action="{{route('admin.roles.destroy',$role->id)}}" method="POST">
                @csrf
                @method('DELETE')
            </form>
            @endcan
            @endif
    </div>
 </div>   
    @endforeach
    </div>
</div>