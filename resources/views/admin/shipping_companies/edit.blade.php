@extends('admin.layouts.master')
@section('head_title'){{__('Edit Shipping Company')}}@endsection
@section('content')
@include('admin.layouts.inc.breadcrumb', ['array' => [
    [
        'name'  =>  __('Shipping Companies'),
        'route' =>  'shipping_companies.index',
    ],
    [
        'name'  =>  __('Edit Shipping Company'),
        'route' =>  'shipping_companies.edit',
    ],
],'button' => [
        'title' => __('Back To Shipping Companies'),
        'route' =>  'shipping_companies.index',
        'icon'  => 'arrow-left'
]])
<div class="card">
    <div class="card-header">
        <h5 class="card-title"> @lang("Edit Shipping Company") </h5>
    </div>
    <div class="card-body table-responsive">
        <form class="form-horizontal" action="{{route('app.shipping_companies.update', $shipping_company->id)}}" method="post" enctype="multipart/form-data">
            <fieldset>
                @csrf
                @method('PUT')
                <div class="form-body">
                    <div class="form-group row">
                        {!! Inputs('text', 'name', 'Name', 'form-control', old('name', $shipping_company->name??'')) !!}
                    </div>
                    <div class="form-group row">
                        {!! Inputs('text', 'price', 'Price', 'form-control', old('name', $shipping_company->price??'')) !!}
                    </div>
                </div>
                <div class="text-right">
                    {!! BackButton('Back', route('app.shipping_companies.index')) !!}
                    {!! SubmitButton('Update') !!}
                </div>
            </fieldset>
        </form>
    </div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Dashboard\ShippingCompanies\UpdateRequest') !!}
@endpush
