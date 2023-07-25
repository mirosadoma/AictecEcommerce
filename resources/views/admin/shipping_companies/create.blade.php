@extends('admin.layouts.master')
@section('head_title'){{__('Add Shipping Company')}}@endsection
@section('content')
@include('admin.layouts.inc.breadcrumb', ['array' => [
    [
        'name'  =>  __('Shipping Companies'),
        'route' =>  'shipping_companies.index',
    ],
    [
        'name'  =>  __('Add Shipping Company'),
        'route' =>  'shipping_companies.create',
    ],
],'button' => [
        'title' => __('Back To Shipping Companies'),
        'route' =>  'shipping_companies.index',
        'icon'  => 'arrow-left'
]])
<div class="card">
    <div class="card-header">
        <h5 class="card-title"> @lang("Add Shipping Company") </h5>
    </div>
    <div class="card-body table-responsive">
        <form class="form-horizontal" action="{{route('app.shipping_companies.store')}}" method="post" enctype="multipart/form-data">
            <fieldset>
                @csrf
                <div class="form-body">
                    <div class="form-group row">
                        {!! Inputs('text', 'name', 'Name', 'form-control', old('name')) !!}
                    </div>
                    <div class="form-group row">
                        {!! Inputs('text', 'price', 'Price', 'form-control', old('price')) !!}
                    </div>
                </div>
                <div class="text-right">
                    {!! BackButton('Back', route('app.shipping_companies.index')) !!}
                    {!! SubmitButton('Save') !!}
                </div>
            </fieldset>
        </form>
    </div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Dashboard\ShippingCompanies\StoreRequest') !!}
@endpush
