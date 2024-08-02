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
    <div class="col-md-6">
        <div class="form-group form-group-default required" aria-required="true">
            <label for="title" class="col-md-12 col-form-label text-md-left">Title</label>
            <input type="text" class="form-control " onchange="makeSlug(this.value)" name="category[title]" value="{{ $category->title }}" required="" autocomplete="off" autofocus="">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group form-group-default required" aria-required="true">
            <label for="slug" class="col-md-12 col-form-label text-md-left">Slug</label>
            <input type="text" id="slug" class="form-control " name="category[slug]" value="{{ $category->slug }}" required="" autocomplete="off" autofocus="">
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group form-group-default required" aria-required="true">
            <label for="title" class="col-md-12 col-form-label text-md-left">Description</label>
            <textarea style="height:100px !important;" class="section form-control" name="category[description]" required="" rows="5">{{ $category->description }}</textarea>

        </div>
    </div>
    <div class="col-lg-12">
        <label>Image</label>
        <br>
        <input type="file" class="dropify" data-default-file="{{ ($category->image)?asset('images/thumbnails/'.$category->image):'' }}" name="image" 
               @isset($create)
               required=""
               @endisset
               />
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
<script type="text/javascript">
    function makeSlug($value) {
        var $slug = $value.toLowerCase().replace(' ', '-');
        $('#slug').val($slug);
    }
</script>