@extends('admin.layouts.master')
@section('head_title'){{__('Add Admin')}}@endsection
@section('content')
@include('admin.layouts.inc.breadcrumb', ['array' => [
    [
        'name'  =>  __('Admins'),
        'route' =>  'admins.index',
    ],
    [
        'name'  =>  __('Add Admin'),
        'route' =>  'admins.create',
    ],
],'button' => [
        'title' => __('Back To Admins'),
        'route' =>  'admins.index',
        'icon'  => 'arrow-left'
]])
<div class="card">
    <div class="card-header">
        <h5 class="card-title"> @lang("Add Admin") </h5>
    </div>
    <div class="card-body table-responsive">
        <form class="form-horizontal" action="{{route('app.admins.store')}}" method="post" enctype="multipart/form-data">
            <fieldset>
                @csrf
                <div class="form-body">
                    <div class="form-group row">
                        {!! Inputs('text', 'name', 'Name', 'form-control', old('name')) !!}
                    </div>
                    <div class="form-group row">
                        {!! Inputs('email', 'email', 'Email', 'form-control', old('email')) !!}
                    </div>
                    <div class="form-group row">
                        {!! Inputs('text', 'phone', 'Phone', 'form-control', old('phone')) !!}
                    </div>
                    <div class="form-group row">
                        {!! Inputs('password', 'password', 'Password', 'form-control') !!}
                    </div>
                    <div class="form-group row">
                        {!! Inputs('password', 'password_confirmation', 'Password Confirmation', 'form-control') !!}
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2">@lang('Role')</label>
                        <div class="input-icon right col-sm-10">
                            <select class="select-search form-control" name="role_name">
                                <option value="null"selected>@lang("Choose")</option>
                                @foreach ($roles as $role)
                                    <option value="{{$role->name}}" @if($role->name == old('role_name')) selected @endif>{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Inputs('file', 'image', 'Admin Image', 'file-input form-control') !!}
                    </div>
                </div>
                <div class="text-right">
                    {!! BackButton('Back', route('app.admins.index')) !!}
                    {!! SubmitButton('Save') !!}
                </div>
            </fieldset>
        </form>
    </div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Dashboard\Admins\StoreRequest') !!}
    <script>
        $(".file-input").fileinput({
            allowedFileExtensions: ['jpg', 'png', 'gif'],
            initialCaption: "@lang('No File Selected')",
        });
    </script>
@endpush
