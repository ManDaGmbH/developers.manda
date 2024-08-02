@csrf
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="row clearfix">
    <div class="col-md-12">
        <div class="form-group form-group-default required" aria-required="true">
            <label for="title" class="col-md-12 col-form-label text-md-left">Title</label>
            <input type="text" class="form-control " name="title" value="{{ $page->title }}" required="" autocomplete="off" autofocus="">
        </div>
    </div>
    <div class="col-md-12">
        <label for="section" class="col-md-12 col-form-label text-md-left">Content <span class="required">*</span></label>
        <textarea class="section form-control" name="section" required="">{{ $page->section }}</textarea>
    </div>

</div>
<div class="form-group row mt-2">
    <div class="col-md-12 offset-md-12 text-right">
        <button id="save-form" type="submit" class="btn btn-primary">
            @isset($create)
            {{ __('Create') }}
            @else
            {{ __('Update') }}
            @endisset
        </button>
    </div>
</div>