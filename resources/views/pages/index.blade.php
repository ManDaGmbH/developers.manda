@extends('master')

@section('content')
<style>
    .editable-clear-x{
        display: none !important;
    }
    .form-control{
        padding:.6rem 1rem !important;
    }
    .table-responsive th,
    .table-responsive td {
        white-space: nowrap;
        border: 1px solid #ebedf2 !important;
    }
    .modal-lg{
        width: 1250px !important;
    }
</style>
{{--@can('banner.index', 'update')--}}
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title pull-left">{{ __('Create New Page') }}</div>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('admin.pages.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <label>Title</label>
                            <input type="text" onchange="makeSlug(this.value)" class="form-control" name="page[title]"/>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <label>Slug</label>
                            <input type="text" class="form-control" id="slug" name="page[slug]"/>
                        </div>
                    </div>
                    <div class="row">
                    </div>
                    <button type="submit" class="mt-2 pull-right btn btn-success">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>
{{--@endcan--}}

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title pull-left">{{ __('Home slider images') }}</div>
            </div>
            <div class="card-body">
                <div class="row table-responsive">
                    @csrf
                    <table class="sortable table table-bordered draggable">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($banners as $k=>$b)
                            <tr>
                                <td>
                                    <?= $b->title ?>
                                </td>
                                <td>
                                    <?= $b->slug ?>
                                </td>
                                <td>
                                    <a href="{{ url('backend/change-status/pages/'.$b->id,$b->active) }}">

                                        <span class="span-status {{ $b->active == 1 ? 'active-span-bg': 'disabled-span-bg' }}">
                                            {{ $b->active == 1 ? __('Active') : __('Blocked') }}
                                        </span>
                                    </a>
                                </td>
                                <td class="sortable-handle">
                                    <a href="{{ route('admin.page.details',$b->id) }}" class="btn btn-warning">
                                        <i class="fa fa-info"></i>
                                    </a>
                                    <a href="{{ url('backend/pages/edit/'.$b->id) }}" class="btn btn-primary">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <button type="submit"
                                            onclick="event.preventDefault(); setUrl('{{ route('admin.pages.destroy', $b->id) }}'); deleteConfirm('destroy', 'Associated data with this page will also be deleted, Are you sure?')"

                                            class="btn btn-icon btn-round btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <form 
                        id="destroy"
                        method="post" id="destroy" 
                        action="">
                        @csrf
                        @method('DELETE')
                    </form>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
@if(Session::has('outcome'))
<script>
    $(function () {
    $.toaster({priority: 'success', title: 'Success', message: "{{Session::get('outcome')}}"});
    })

</script>
@endif
<script type="text/javascript">
            function makeSlug($value){
            var $slug = $value.trim().toLowerCase().replaceAll(' ', '-');
            $('#slug').val($slug);
            }
             function setUrl($url){
        $('form#destroy').attr('action',$url);
    }
</script>
@endsection