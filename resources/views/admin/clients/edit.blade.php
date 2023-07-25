@extends('admin.layouts.master')
@section('head_title'){{__('Edit Client')}}@endsection
@section('content')
@include('admin.layouts.inc.breadcrumb', ['array' => [
    [
        'name'  =>  __('Clients'),
        'route' =>  'clients.index',
    ],
    [
        'name'  =>  __('Edit Client'),
        'route' =>  'clients.edit',
    ],
],'button' => [
        'title' => __('Back To Clients'),
        'route' =>  'clients.index',
        'icon'  => 'arrow-left'
]])
<div class="card">
    <div class="card-header">
        <h5 class="card-title"> @lang("Edit Client") </h5>
    </div>
    <div class="card-body table-responsive">
        <form class="form-horizontal" action="{{route('app.clients.update', $client->id)}}" method="post" enctype="multipart/form-data">
            <fieldset>
                @csrf
                @method('PUT')
                <div class="form-body">
                    <div class="form-group row">
                        {!! Inputs('text', 'name', 'Name', 'form-control', $client->name) !!}
                    </div>
                    <div class="form-group row">
                        {!! Inputs('email', 'email', 'Email', 'form-control', $client->email) !!}
                    </div>
                    <div class="form-group row">
                        {!! Inputs('text', 'phone', 'Phone', 'form-control', $client->phone) !!}
                    </div>
                    <div class="form-group row">
                        {!! Inputs('password', 'password', 'Password', 'form-control') !!}
                    </div>
                    <div class="form-group row">
                        {!! Inputs('password', 'password_confirmation', 'Password Confirmation', 'form-control') !!}
                    </div>
                    <div class="form-group row">
                        {!! Inputs('file', 'image', 'Image', 'file-input form-control', $client->image_path) !!}
                    </div>
                </div>
                <div class="text-right">
                    {!! BackButton('Back', route('app.clients.index')) !!}
                    {!! SubmitButton('Update') !!}
                </div>
            </fieldset>
        </form>
    </div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Dashboard\Clients\UpdateRequest') !!}
    <script>
        $(".file-input").fileinput({
            allowedFileExtensions: ['jpg', 'png', 'gif'],
            initialCaption: "@lang('No File Selected')",
            overwriteInitial: false,
            initialPreview: [
                "{{$client->image_path}}"
            ],
            initialPreviewAsData: true,
            initialPreviewFileType: 'image',
            initialPreviewConfig: [
                {caption: "{{$client->image}}", url: _url_+"app/clients/remove_image/{{$client->id}}"}
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
