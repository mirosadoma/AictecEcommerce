@extends('admin.layouts.master')
@section('head_title'){{__('Edit Coupon')}}@endsection
@section('content')
@include('admin.layouts.inc.breadcrumb', ['array' => [
    [
        'name'  =>  __('Coupons'),
        'route' =>  'coupons.index',
    ],
    [
        'name'  =>  __('Edit Coupon'),
        'route' =>  'coupons.edit',
    ],
],'button' => [
        'title' => __('Back To Coupons'),
        'route' =>  'coupons.index',
        'icon'  => 'arrow-left'
]])
<div class="card">
    <div class="card-header">
        <h5 class="card-title"> @lang("Edit Coupon") </h5>
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
        <form class="form-horizontal" action="{{route('app.coupons.update', $coupon->id)}}" method="post" enctype="multipart/form-data">
            <fieldset>
                @csrf
                @method('PUT')
                @foreach(app_languages() as $key=>$one)
                    <div class="tab-pane {{ $key == app()->getLocale() ? 'active' : '' }}" id="tab-{{$key}}" role="tabpanel">
                        <div class="form-body">
                            <div class="form-group row">
                                {!! Inputs('text', $key.'[name]', 'Name', 'form-control', old($key.'.name', $coupon->translate($key)->name??'')) !!}
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="form-body">
                    <div class="form-group row">
                        {!! Inputs('date', 'start_date', 'Start Date', 'form-control', old('start_date', $coupon->start_date)) !!}
                    </div>
                    <div class="form-group row">
                        {!! Inputs('date', 'end_date', 'End Date', 'form-control', old('end_date', $coupon->end_date)) !!}
                    </div>
                    <div class="form-group row">
                        {!! Inputs('text', 'code', 'Code', 'form-control', old('code', $coupon->code)) !!}
                    </div>
                    <div class="form-group row">
                        <label class="form-label col-sm-2" for="select1-basic">@lang('Type')</label>
                        <div class="input-icon right col-sm-10">
                            <select class="select-search form-control" id="select1-basic" name="type">
                                <option value="null" selected disabled>@lang("Choose")</option>
                                <option value="amount" @if(old('type', $coupon->type) == 'amount') selected @endif>@lang("Amount")</option>
                                <option value="percentage" @if(old('type', $coupon->type) == 'percentage') selected @endif>@lang("Percentage")</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Inputs('text', 'value', 'Value', 'form-control', old('value', $coupon->value)) !!}
                    </div>
                </div>
                <div class="text-right">
                    {!! BackButton('Back', route('app.coupons.index')) !!}
                    {!! SubmitButton('Update') !!}
                </div>
            </fieldset>
        </form>
    </div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Dashboard\Coupons\UpdateRequest') !!}
@endpush
