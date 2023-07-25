@extends('admin.layouts.master')
@section('head_title'){{__('Add Coupon')}}@endsection
@section('content')
@include('admin.layouts.inc.breadcrumb', ['array' => [
    [
        'name'  =>  __('Coupons'),
        'route' =>  'coupons.index',
    ],
    [
        'name'  =>  __('Add Coupon'),
        'route' =>  'coupons.create',
    ],
],'button' => [
        'title' => __('Back To Coupons'),
        'route' =>  'coupons.index',
        'icon'  => 'arrow-left'
]])
<div class="card">
    <div class="card-header">
        <h5 class="card-title"> @lang("Add Coupon") </h5>
        <ul class="nav nav-tabs" role="tablist">
            @foreach(app_languages() as $key=>$one)
                <li class="nav-item {{ $key == app()->getLocale() ? 'active' : '' }} tab-lang" data-id="tab-{{$key}}">
                    <a class="nav-link {{$errors->first($key.'.*') ? 'text-danger' : ''}}"  data-toggle="tab" href="#" role="tab">
                        <span class="hidden-sm-up"></span> <span class="hidden-xs-down">@lang($one['name'])</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="card-body table-responsive">
        <form class="form-horizontal" action="{{route('app.coupons.store')}}" method="post" enctype="multipart/form-data">
            <fieldset>
                @csrf
                @foreach(app_languages() as $key=>$one)
                    <div class="tab-pane {{ $key == app()->getLocale() ? 'active' : '' }}" id="tab-{{$key}}" role="tabpanel">
                        <div class="form-body">
                            <div class="form-group row">
                                {!! Inputs('text', $key.'[name]', 'Name', 'form-control', old($key.'.name')) !!}
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="form-body">
                    <div class="form-group row">
                        {!! Inputs('date', 'start_date', 'Start Date', 'form-control') !!}
                    </div>
                    <div class="form-group row">
                        {!! Inputs('date', 'end_date', 'End Date', 'form-control') !!}
                    </div>
                    <div class="form-group row">
                        {!! Inputs('text', 'code', 'Code', 'form-control') !!}
                    </div>
                    <div class="form-group row">
                        <label class="form-label col-sm-2" for="select1-basic">@lang('Type')</label>
                        <div class="input-icon right col-sm-10">
                            <select class="select-search form-control" id="select1-basic" name="type">
                                <option value="null" selected disabled>@lang("Choose")</option>
                                <option value="amount">@lang("Amount")</option>
                                <option value="percentage">@lang("Percentage")</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Inputs('text', 'value', 'Value', 'form-control') !!}
                    </div>
                </div>
                <div class="text-right">
                    {!! BackButton('Back', route('app.coupons.index')) !!}
                    {!! SubmitButton('Save') !!}
                </div>
            </fieldset>
        </form>
    </div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Dashboard\Coupons\StoreRequest') !!}
@endpush
