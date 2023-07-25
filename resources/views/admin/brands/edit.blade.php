@extends('admin.layouts.master')
@section('head_title'){{__('Edit Brand')}}@endsection
@section('content')
@include('admin.layouts.inc.breadcrumb', ['array' => [
    [
        'name'  =>  __('Brands'),
        'route' =>  'brands.index',
    ],
    [
        'name'  =>  __('Edit Brand'),
        'route' =>  'brands.edit',
    ],
],'button' => [
        'title' => __('Back To Brands'),
        'route' =>  'brands.index',
        'icon'  => 'arrow-left'
]])
<div class="card">
    <div class="card-header">
        <h5 class="card-title"> @lang("Edit Brand") </h5>
    </div>
    <div class="card-body table-responsive">
        <form class="form-horizontal" action="{{route('app.brands.update', $brand->id)}}" method="post" enctype="multipart/form-data">
            <fieldset>
                @csrf
                @method('PUT')
                <div class="form-body">
                    <div class="form-group row">
                        {!! Inputs('text', 'name', 'Name', 'form-control', old('name', $brand->name??'')) !!}
                    </div>
                    <div class="form-group row">
                        {!! Inputs('file', 'image', 'Image', 'file-input image form-control', $brand->image_path) !!}
                    </div>
                </div>
                <div class="text-right">
                    {!! BackButton('Back', route('app.brands.index')) !!}
                    {!! SubmitButton('Update') !!}
                </div>
            </fieldset>
        </form>
    </div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Dashboard\Brands\UpdateRequest') !!}
    <script>
        $(".image").fileinput({
            allowedFileExtensions: ['jpg', 'png', 'gif'],
            initialCaption: "@lang('No File Selected')",
            overwriteInitial: false,
            initialPreview: [
                "{{$brand->image_path}}"
            ],
            initialPreviewAsData: true,
            initialPreviewFileType: 'image',
            initialPreviewConfig: [
                {caption: "{{$brand->image}}", url: _url_+"app/brands/remove_image/{{$brand->id}}"}
            ],
        }).on("filepredelete", function(jqXHR) {
            var abort = true;
            if (confirm("{{__('Are you sure you want to delete this image?')}}")) {
                console.log(jqXHR);
                abort = false;
            }
            return abort;
        });
    </script>
@endpush
