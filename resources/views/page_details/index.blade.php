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

<div class="row">

    <div class="col-md-12">
        <div class="d-flex">
            <h1 class="flex-grow-1 float-left">Page Details</h1>
            <a href="{{route('admin.page.details.create',$pageId)}}" class="btn btn-success align-self-center" role="button">Create Section</a>
        </div>
        <div class="card">

            <div class="card-body">
                <div class="row table-responsive">
                    <form action="{{ url('backend/banners/sort-order') }}" class="sort-form" method="post">
                        @csrf
                        <table class="sortable table table-bordered draggable">
                            <thead>
                                <tr>
                                    <th style="width:10px;"></th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($banners as $k=>$b)
                                <tr>
                                    <td>
                                        <input type="hidden" name="data[]" value="{{$b->id}}">
                                        <input type="hidden" name="table" value="page_details">
                                        <a href="javascript:"><i class="fa fa-sort"></i></a>
                                    </td>
                                    <td>
                                        {{ $b->title }}
                                </td>
                                    <td>
                                        <a href="{{ url('backend/change-status/page_details/'.$b->id,$b->active) }}">

                                            <span class="span-status {{ $b->active == 1 ? 'active-span-bg': 'disabled-span-bg' }}">
                                                {{ $b->active == 1 ? __('Active') : __('Blocked') }}
                                            </span>
                                            </a>
                                    </td>
                                    <td class="sortable-handle">
                                        <a href="{{ route('admin.page.details.edit', [$b->id]) }}"

                                           class="btn btn-icon btn-round btn-warning">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <button type="submit"
                                                onclick="event.preventDefault(); setUrl('{{ route('admin.page_details.destroy', $b->id) }}'); deleteConfirm('destroy', 'You are about to delete a banner, Are you sure?')"

                                                class="btn btn-icon btn-round btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </form>
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
<!-- The Modal -->
<div class="modal" id="img-viewer">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="top:100px;">
            <!-- Modal Header -->
            <div class="modal-header border-0" style="margin:0 !important;padding:10px !important;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body preview-image text-center">

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
            $(function () {
            $(".sortable").sortable({
            items: 'tbody tr',
                    cursor: 'pointer',
                    axis: 'y',
                    dropOnEmpty: false,
                    start: function (e, ui) {
                    ui.item.addClass("selected");
                    },
                    stop: function (e, ui) {
                    ui.item.removeClass("selected");
                    $(this).find("tr").each(function (index) {
                    if (index == 0) {
                    commonAjax('.sort-form');
                    }
                    });
                    }
            });
            });
    function commonAjax(form) {
    //sort-form
    var url = $(form).attr('action');
    var request = $.ajax({
    url: url,
            type: "POST",
            data: $(form).serialize(),
            dataType: "json"
    });
    request.done(function (msg) {
    if (msg.status == 1) {
    $.toaster({priority: 'success', title: 'Success', message: msg.message});
    } else {
    $.toaster({priority: 'error', title: 'Fail', message: msg.message});
    }
    });
    request.fail(function (jqXHR, textStatus) {
    $.toaster({priority: 'error', title: 'Fail', message: "Request failed: " + textStatus});
    });
    }
    function setUrl($url){
    $('form#destroy').attr('action', $url);
    }
</script>
@endsection