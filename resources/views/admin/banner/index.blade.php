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
                <div class="card-title pull-left">{{ __('Home Page Slider') }}</div>
            </div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data" action="{{ route('admin.banners.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <label>Image</label>
                            <br>
                            <input type="file" class="dropify" name="image"/>
                            <button type="submit" class="mt-2 pull-right btn btn-success">Add</button>
                        </div>
                    </div>
                    <!--                    <div class="row pt-3">
                                            <div class="col-lg-1 col-md-6 col-sm-12 col-12 d-flex align-items-end justify-content-end" required="">
                                            </div>
                                        </div>-->
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
                    <form action="{{ url('backend/banners/sort-order') }}" class="sort-form" method="post">
                        @csrf
                        <table class="sortable table table-bordered draggable">
                            <thead>
                                <tr>
                                    <th style="width:10px;"></th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($banners as $k=>$b)
                                <tr>
                                    <td>
                                        <input type="hidden" name="data[]" value="{{$b->id}}">
                                        <input type="hidden" name="table" value="banners">
                                        <a href="javascript:"><i class="fa fa-sort"></i></a>
                                    </td>
                                    <td>
                                        <?php
                                        if ($b->image && file_exists(public_path() . '/images/thumbnails/' . $b->image)) {
                                            $img = 'images/thumbnails/' . $b->image;
                                        } else {
                                            $img = 'avatar-2.png';
                                        }
                                        ?>
                                        <img class="preview" width="200px" src="<?= url($img); ?>">
                                    </td>
                                    <td>
                                        <a href="{{ url('backend/change-status/banners/'.$b->id,$b->active) }}">

                                            <span class="span-status {{ $b->active == 1 ? 'active-span-bg': 'disabled-span-bg' }}">
                                                {{ $b->active == 1 ? __('Active') : __('Blocked') }}
                                            </span>
                                        </a>
                                    </td>
                                    <td class="sortable-handle">
                                        <button type="submit"
                                                onclick="event.preventDefault();setUrl('{{ route('admin.banners.destroy', $b->id) }}');deleteConfirm('destroy', 'You are about to delete a banner, Are you sure?')"

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
        $('form#destroy').attr('action',$url);
    }
</script>
@endsection