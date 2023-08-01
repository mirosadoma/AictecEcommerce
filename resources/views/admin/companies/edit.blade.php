@extends('admin.layouts.master')
@section('head_title'){{__('Edit Company')}}@endsection
@section('content')
@include('admin.layouts.inc.breadcrumb', ['array' => [
    [
        'name'  =>  __('Companies'),
        'route' =>  'companies.index',
    ],
    [
        'name'  =>  __('Edit Company'),
        'route' =>  'companies.edit',
    ],
],'button' => [
        'title' => __('Back To Companies'),
        'route' =>  'companies.index',
        'icon'  => 'arrow-left'
]])
<div class="card">
    <div class="card-header">
        <h5 class="card-title"> @lang("Edit Company") </h5>
    </div>
    <div class="card-body table-responsive">
        <form class="form-horizontal" action="{{route('app.companies.update', $company->id)}}" method="post" enctype="multipart/form-data">
            <fieldset>
                @csrf
                @method('PUT')
                <div class="form-body">
                    <div class="form-group row">
                        {!! Inputs('text', 'name', 'Name', 'form-control', $company->name) !!}
                    </div>
                    <div class="form-group row">
                        {!! Inputs('text', 'company_name', 'Company Name', 'form-control', $company->company_name) !!}
                    </div>
                    <div class="form-group row">
                        {!! Inputs('email', 'email', 'Email', 'form-control', $company->email) !!}
                    </div>
                    <div class="form-group row">
                        {!! Inputs('text', 'phone', 'Phone', 'form-control', $company->phone) !!}
                    </div>
                    <div class="form-group row">
                        {!! Inputs('password', 'password', 'Password', 'form-control') !!}
                    </div>
                    <div class="form-group row">
                        {!! Inputs('password', 'password_confirmation', 'Password Confirmation', 'form-control') !!}
                    </div>
                    <div class="form-group row">
                        {!! Inputs('file', 'image', 'Image', 'file-input form-control', $company->image_path) !!}
                    </div>
                </div>
                <div class="text-right">
                    {!! BackButton('Back', route('app.companies.index')) !!}
                    {!! SubmitButton('Update') !!}
                </div>
            </fieldset>
        </form>
    </div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Dashboard\Companies\UpdateRequest') !!}
    <script>
        $(".file-input").fileinput({
            allowedFileExtensions: ['jpg', 'jpeg', 'png', 'gif'],
            initialCaption: "@lang('No File Selected')",
            overwriteInitial: false,
            initialPreview: [
                "{{$company->image_path}}"
            ],
            initialPreviewAsData: true,
            initialPreviewFileType: 'image',
            initialPreviewConfig: [
                {caption: "{{$company->image}}", url: _url_+"app/companies/remove_image/{{$company->id}}"}
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
