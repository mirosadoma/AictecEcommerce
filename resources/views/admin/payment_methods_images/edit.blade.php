@extends('admin.layouts.master')
@section('head_title'){{__('Edit Payment Methods Image')}}@endsection
@section('content')
@include('admin.layouts.inc.breadcrumb', ['array' => [
    [
        'name'  =>  __('Payment Methods Images'),
        'route' =>  'payment_methods_images.index',
    ],
    [
        'name'  =>  __('Edit Payment Methods Image'),
        'route' =>  'payment_methods_images.edit',
    ],
],'button' => [
        'title' => __('Back To Payment Methods Images'),
        'route' =>  'payment_methods_images.index',
        'icon'  => 'arrow-left'
]])
<div class="card">
    <div class="card-header">
        <h5 class="card-title"> @lang("Edit Payment Methods Image") </h5>
    </div>
    <div class="card-body table-responsive">
        <form class="form-horizontal" action="{{route('app.payment_methods_images.update', $payment_methods_image->id)}}" method="post" enctype="multipart/form-data">
            <fieldset>
                @csrf
                @method('PUT')
                <div class="form-body">
                    <div class="form-group row">
                        {!! Inputs('file', 'image', 'Image', 'file-input image form-control', $payment_methods_image->image_path) !!}
                    </div>
                </div>
                <div class="text-right">
                    {!! BackButton('Back', route('app.payment_methods_images.index')) !!}
                    {!! SubmitButton('Update') !!}
                </div>
            </fieldset>
        </form>
    </div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Dashboard\PaymentMethodsImages\UpdateRequest') !!}
    <script>
        $(".image").fileinput({
            allowedFileExtensions: ['jpg', 'jpeg', 'png', 'gif'],
            initialCaption: "@lang('No File Selected')",
            overwriteInitial: false,
            initialPreview: [
                "{{$payment_methods_image->image_path}}"
            ],
            initialPreviewAsData: true,
            initialPreviewFileType: 'image',
            initialPreviewConfig: [
                {caption: "{{$payment_methods_image->image}}", url: _url_+"app/payment_methods_images/remove_image/{{$payment_methods_image->id}}"}
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
