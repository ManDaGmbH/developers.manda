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

<div class="d-flex">
            <h1 class="flex-grow-1 float-left">Gallery</h1>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-success align-self-center" role="button">Create Gallery</a>
        </div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row table-responsive">
                    @csrf
                    <table class="sortable table table-bordered draggable">
                        <thead>
                            <tr>
                                <th>Image</th>
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
                                    <?= $b->title ?>
                                </td>
                                <td>
                                    <?= $b->slug ?>
                                </td>
                                <td>
                                    <a href="{{ url('backend/change-status/categories/'.$b->id,$b->active) }}">

                                        <span class="span-status {{ $b->active == 1 ? 'active-span-bg': 'disabled-span-bg' }}">
                                            {{ $b->active == 1 ? __('Active') : __('Blocked') }}
                                        </span>
                                    </a>
                                </td>
                                <td class="sortable-handle">
                                    <a href="{{ route('admin.galleries',$b->id) }}" class="btn btn-warning">
                                        <i class="fa fa-info"></i>
                                    </a>
                                    <a href="{{ route('admin.categories.edit',$b->id) }}" class="btn btn-primary">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <button type="submit"
                                            onclick="event.preventDefault(); setUrl('{{ route('admin.category.destroy', $b->id) }}'); deleteConfirm('destroy', 'You are about to delete a banner, Are you sure?')"

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
//        alert($value);
            var $slug = $value.toLowerCase().replace(' ', '-');
            $('#slug').val($slug);
            }
    function setUrl($url){
    $('form#destroy').attr('action', $url);
    }
</script>
@endsection