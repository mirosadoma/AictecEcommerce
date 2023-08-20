@extends('admin.layouts.master')
@section('head_title'){{__('Delivery Adderss')}}@endsection
@section('content')
@include('admin.layouts.inc.breadcrumb', ['array' => [
    [
        'name'  =>  __('Delivery Adderss'),
        'route' =>  ['settings.index','delivery_adderss'],
    ],
]])
<div class="card">
    <div class="card-header">
        <h5 class="card-title"> @lang("Edit Delivery Adderss") </h5>
    </div>
    <div class="card-body table-responsive">
        <form class="form-horizontal" action="{{route('app.settings.update','delivery_adderss')}}" method="post" enctype="multipart/form-data" Files>
            @csrf
            <fieldset>
                {{--

                address_city
                --}}
                <div class="form-group row">
                    <label class="col-lg-2 control-label text-semibold">@lang('Title')</label>
                    <div class="col-lg-10">
                        <input type="text" name="address_title" value="{{$setting->address_title??''}}" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 control-label text-semibold">@lang('Name')</label>
                    <div class="col-lg-10">
                        <input type="text" name="address_name" value="{{$setting->address_name??''}}" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 control-label text-semibold">@lang('Email')</label>
                    <div class="col-lg-10">
                        <input type="email" name="address_email" value="{{$setting->address_email??''}}" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-2">@lang('City')</label>
                    <div class="input-icon right col-sm-10">
                        <select class="select-search form-control" name="address_city">
                            <option value="0" disabled>@lang("Choose")</option>
                                @forelse($cities as $city)
                                    <option value="{{$city->id}}" @if($city->id == $setting->address_city) selected @endif>{{$city->name}}</option>
                                @empty
                                @endforelse
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 control-label text-semibold">@lang('Address')</label>
                    <div class="col-lg-10">
                        <input type="text" name="address_address" value="{{$setting->address_address??''}}" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 control-label text-semibold">@lang('District')</label>
                    <div class="col-lg-10">
                        <input type="text" name="address_neighbourhood" value="{{$setting->address_neighbourhood??''}}" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 control-label text-semibold">@lang('Postal Code')</label>
                    <div class="col-lg-10">
                        <input type="text" name="address_postcode" value="{{$setting->address_postcode??''}}" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 control-label text-semibold">@lang('Phone')</label>
                    <div class="col-lg-10">
                        <input type="text" name="address_phone" value="{{$setting->address_phone??''}}" class="form-control">
                    </div>
                </div>
                <div class="form-body">
                    <div class="form-group row">
                        <label class="col-lg-2 control-label text-semibold">@lang('Description')</label>
                        <div class="col-lg-10">
                            <textarea name="address_description" class="form-control">{{$setting->address_description??''}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="form-actions right" style="clear:both">
                    {!! SubmitButton('Update') !!}
                </div>
            </fieldset>
        </form>
    </div>
</div>
@endsection
