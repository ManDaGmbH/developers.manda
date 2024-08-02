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
                <div class="card-title pull-left">{{ __('Edit Page') }}</div>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('admin.pages.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <label>Title</label>
                            <input type="hidden" value="{{ $page->id }}" name="id"/>
                            <input type="text" onchange="makeSlug(this.value)" value="{{ $page->title }}" class="form-control" name="page[title]"/>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <label>Slug</label>
                            <input type="text" class="form-control" value="{{ $page->slug }}" id="slug" name="page[slug]"/>
                        </div>
                    </div>
                    <div class="row">
                    </div>
                    <button type="submit" class="mt-2 pull-right btn btn-success">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
{{--@endcan--}}

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