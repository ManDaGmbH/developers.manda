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
            <h1 class="flex-grow-1 float-left">Contacts</h1>
        </div>
        <div class="card">

            <div class="card-body">
                <div class="row table-responsive">
                    @csrf
                    <table class="sortable table table-bordered draggable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contacts as $k=>$b)
                            <tr>
                                <td>
                                    <?= $b->name ?>
                                </td>
                                <td>
                                    <?= $b->email ?>
                                </td>
                                <td>
                                    <?= $b->subject ?>
                                </td>
                                <td>
                                    <?= $b->message ?>
                                </td>
                                <td class="sortable-handle">
                                    <button type="submit"
                                            onclick="event.preventDefault(); setUrl('{{ route('admin.contact.destroy', $b->id) }}'); deleteConfirm('destroy', 'Associated data with this page will also be deleted, Are you sure?')"

                                            class="btn btn-icon btn-round btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-2">
                    {{ $contacts->links() }}
                        
                    </div>
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