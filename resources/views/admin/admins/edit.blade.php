@extends('admin.layouts.master')
@section('head_title'){{__('Edit Admin')}}@endsection
@section('content')
@include('admin.layouts.inc.breadcrumb', ['array' => [
    [
        'name'  =>  __('Admins'),
        'route' =>  'admins.index',
    ],
    [
        'name'  =>  __('Edit Admin'),
        'route' =>  'admins.edit',
    ],
],'button' => [
        'title' => __('Back To Admins'),
        'route' =>  'admins.index',
        'icon'  => 'arrow-left'
]])
<div class="card">
    <div class="card-header">
        <h5 class="card-title"> @lang("Edit Admin") </h5>
    </div>
    <div class="card-body table-responsive">
        <form class="form-horizontal" action="{{route('app.admins.update', $admin->id)}}" method="post" enctype="multipart/form-data">
            <fieldset>
                @csrf
                @method('PUT')
                <div class="form-body">
                    <div class="form-group row">
                        {!! Inputs('text', 'name', 'Name', 'form-control', $admin->name) !!}
                    </div>
                    <div class="form-group row">
                        {!! Inputs('email', 'email', 'Email', 'form-control', $admin->email) !!}
                    </div>
                    <div class="form-group row">
                        {!! Inputs('text', 'phone', 'Phone', 'form-control', $admin->phone) !!}
                    </div>
                    <div class="form-group row">
                        {!! Inputs('password', 'password', 'Password', 'form-control') !!}
                    </div>
                    <div class="form-group row">
                        {!! Inputs('password', 'password_confirmation', 'Password Confirmation', 'form-control') !!}
                    </div>
                    @if (\Auth::guard('admin')->user()->id != $admin->id)
                        <div class="form-group row">
                            <label class="control-label col-sm-2">@lang('Roles')</label>
                            <div class="input-icon right col-sm-10">
                                <select class="select-search form-control" name="role_name">
                                    <option value="0"selected>@lang("Choose")</option>
                                    @foreach ($roles as $role)
                                        <option value="{{$role->name}}" @if($admin->hasRole($role->name) == $role->name) selected @endif>{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif
                    <div class="form-group row">
                        {!! Inputs('file', 'image', 'Admin Image', 'file-input form-control', $admin->image_path) !!}
                    </div>
                </div>
                <div class="text-right">
                    {!! BackButton('Back', route('app.admins.index')) !!}
                    {!! SubmitButton('Update') !!}
                </div>
            </fieldset>
        </form>
    </div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Dashboard\Admins\UpdateRequest') !!}
    <script>
        $(".file-input").fileinput({
            allowedFileExtensions: ['jpg', 'jpeg', 'png', 'gif'],
            initialCaption: "@lang('No File Selected')",
            overwriteInitial: false,
            initialPreview: [
                "{{$admin->image_path}}"
            ],
            initialPreviewAsData: true,
            initialPreviewFileType: 'image',
            initialPreviewConfig: [
                {caption: "{{$admin->image}}", url: _url_+"app/admins/remove_image/{{$admin->id}}"}
            ],
        }).on("filepredelete", function(jqXHR) {
            var abort = true;
            if (confirm("{{__('Are you sure you want to delete this image?')}}")) {
                console.log(jqXHR);
                abort = false;
            }
            return abort;
        });
    </script>
@endpush
