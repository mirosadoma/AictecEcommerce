@extends('admin.layouts.master')
@section('head_title'){{__('Add Banner')}}@endsection
@section('content')
@include('admin.layouts.inc.breadcrumb', ['array' => [
    [
        'name'  =>  __('Banners'),
        'route' =>  'banners.index',
    ],
    [
        'name'  =>  __('Add Banner'),
        'route' =>  'banners.create',
    ],
],'button' => [
        'title' => __('Back To Banners'),
        'route' =>  'banners.index',
        'icon'  => 'arrow-left'
]])
<div class="card">
    <div class="card-header">
        <h5 class="card-title"> @lang("Add Banner") </h5>
    </div>
    <div class="card-body table-responsive">
        <form class="form-horizontal" action="{{route('app.banners.store')}}" method="post" enctype="multipart/form-data">
            <fieldset>
                @csrf
                <div class="form-body">
                    <div class="form-group row">
                        {!! Inputs('text', 'link', 'Link', 'form-control', old('link')) !!}
                    </div>
                    <div class="form-group row">
                        {!! Inputs('file', 'image', 'Image', 'file-input image form-control') !!}
                    </div>
                </div>
                <div class="text-right">
                    {!! BackButton('Back', route('app.banners.index')) !!}
                    {!! SubmitButton('Save') !!}
                </div>
            </fieldset>
        </form>
    </div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Dashboard\Banners\StoreRequest') !!}
    <script>
        $(".image").fileinput({
            allowedFileExtensions: ['jpg', 'jpeg', 'png', 'gif'],
            initialCaption: "@lang('No File Selected')",
        });
    </script>
@endpush
