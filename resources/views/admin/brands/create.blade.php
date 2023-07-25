@extends('admin.layouts.master')
@section('head_title'){{__('Add Brand')}}@endsection
@section('content')
@include('admin.layouts.inc.breadcrumb', ['array' => [
    [
        'name'  =>  __('Brands'),
        'route' =>  'brands.index',
    ],
    [
        'name'  =>  __('Add Brand'),
        'route' =>  'brands.create',
    ],
],'button' => [
        'title' => __('Back To Brands'),
        'route' =>  'brands.index',
        'icon'  => 'arrow-left'
]])
<div class="card">
    <div class="card-header">
        <h5 class="card-title"> @lang("Add Brand") </h5>
    </div>
    <div class="card-body table-responsive">
        <form class="form-horizontal" action="{{route('app.brands.store')}}" method="post" enctype="multipart/form-data">
            <fieldset>
                @csrf
                <div class="form-body">
                    <div class="form-group row">
                        {!! Inputs('text', 'name', 'Name', 'form-control', old('name')) !!}
                    </div>
                    <div class="form-group row">
                        {!! Inputs('file', 'image', 'Image', 'file-input image form-control') !!}
                    </div>
                </div>
                <div class="text-right">
                    {!! BackButton('Back', route('app.brands.index')) !!}
                    {!! SubmitButton('Save') !!}
                </div>
            </fieldset>
        </form>
    </div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Dashboard\Brands\StoreRequest') !!}
    <script>
        $(".image").fileinput({
            allowedFileExtensions: ['jpg', 'png', 'gif'],
            initialCaption: "@lang('No File Selected')",
        });
    </script>
@endpush
