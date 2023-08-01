@extends('admin.layouts.master')
@section('head_title'){{__('Edit Banner')}}@endsection
@section('content')
@include('admin.layouts.inc.breadcrumb', ['array' => [
    [
        'name'  =>  __('Banners'),
        'route' =>  'banners.index',
    ],
    [
        'name'  =>  __('Edit Banner'),
        'route' =>  'banners.edit',
    ],
],'button' => [
        'title' => __('Back To Banners'),
        'route' =>  'banners.index',
        'icon'  => 'arrow-left'
]])
<div class="card">
    <div class="card-header">
        <h5 class="card-title"> @lang("Edit Banner") </h5>
    </div>
    <div class="card-body table-responsive">
        <form class="form-horizontal" action="{{route('app.banners.update', $banner->id)}}" method="post" enctype="multipart/form-data">
            <fieldset>
                @csrf
                @method('PUT')
                <div class="form-body">
                    <div class="form-group row">
                        {!! Inputs('text', 'link', 'Link', 'form-control', old('link', $banner->link??'')) !!}
                    </div>
                    <div class="form-group row">
                        {!! Inputs('file', 'image', 'Image', 'file-input image form-control', $banner->image_path) !!}
                    </div>
                </div>
                <div class="text-right">
                    {!! BackButton('Back', route('app.banners.index')) !!}
                    {!! SubmitButton('Update') !!}
                </div>
            </fieldset>
        </form>
    </div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Dashboard\Banners\UpdateRequest') !!}
    <script>
        $(".image").fileinput({
            allowedFileExtensions: ['jpg', 'jpeg', 'png', 'gif'],
            initialCaption: "@lang('No File Selected')",
            overwriteInitial: false,
            initialPreview: [
                "{{$banner->image_path}}"
            ],
            initialPreviewAsData: true,
            initialPreviewFileType: 'image',
            initialPreviewConfig: [
                {caption: "{{$banner->image}}", url: _url_+"app/banners/remove_image/{{$banner->id}}"}
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
