@extends('admin.layouts.master')
@section('head_title'){{__('Add Payment Methods Image')}}@endsection
@section('content')
@include('admin.layouts.inc.breadcrumb', ['array' => [
    [
        'name'  =>  __('Payment Methods Images'),
        'route' =>  'payment_methods_images.index',
    ],
    [
        'name'  =>  __('Add Payment Methods Image'),
        'route' =>  'payment_methods_images.create',
    ],
],'button' => [
        'title' => __('Back To Payment Methods Images'),
        'route' =>  'payment_methods_images.index',
        'icon'  => 'arrow-left'
]])
<div class="card">
    <div class="card-header">
        <h5 class="card-title"> @lang("Add Payment Methods Image") </h5>
    </div>
    <div class="card-body table-responsive">
        <form class="form-horizontal" action="{{route('app.payment_methods_images.store')}}" method="post" enctype="multipart/form-data">
            <fieldset>
                @csrf
                <div class="form-body">
                    <div class="form-group row">
                        {!! Inputs('file', 'image', 'Image', 'file-input image form-control') !!}
                    </div>
                </div>
                <div class="text-right">
                    {!! BackButton('Back', route('app.payment_methods_images.index')) !!}
                    {!! SubmitButton('Save') !!}
                </div>
            </fieldset>
        </form>
    </div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Dashboard\PaymentMethodsImages\StoreRequest') !!}
    <script>
        $(".image").fileinput({
            allowedFileExtensions: ['jpg', 'jpeg', 'png', 'gif'],
            initialCaption: "@lang('No File Selected')",
        });
    </script>
@endpush
