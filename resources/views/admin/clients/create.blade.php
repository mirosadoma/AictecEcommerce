@extends('admin.layouts.master')
@section('head_title'){{__('Add Client')}}@endsection
@section('content')
@include('admin.layouts.inc.breadcrumb', ['array' => [
    [
        'name'  =>  __('Clients'),
        'route' =>  'clients.index',
    ],
    [
        'name'  =>  __('Add Client'),
        'route' =>  'clients.create',
    ],
],'button' => [
        'title' => __('Back To Clients'),
        'route' =>  'clients.index',
        'icon'  => 'arrow-left'
]])
<div class="card">
    <div class="card-header">
        <h5 class="card-title"> @lang("Add Client") </h5>
    </div>
    <div class="card-body table-responsive">
        <form class="form-horizontal" action="{{route('app.clients.store')}}" method="post" enctype="multipart/form-data">
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
                        {!! Inputs('file', 'image', 'Image', 'file-input form-control') !!}
                    </div>
                </div>
                <div class="text-right">
                    {!! BackButton('Back', route('app.clients.index')) !!}
                    {!! SubmitButton('Save') !!}
                </div>
            </fieldset>
        </form>
    </div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Dashboard\Clients\StoreRequest') !!}
    <script>
        $(".file-input").fileinput({
            allowedFileExtensions: ['jpg', 'jpeg', 'png', 'gif'],
            initialCaption: "@lang('No File Selected')",
        });
    </script>
@endpush
