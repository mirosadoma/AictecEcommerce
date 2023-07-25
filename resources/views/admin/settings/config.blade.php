@extends('admin.layouts.master')
@section('head_title'){{__('General Settings')}}@endsection
@section('content')
@include('admin.layouts.inc.breadcrumb', ['array' => [
    [
        'name'  =>  __('General Settings'),
        'route' =>  ['settings.index','config'],
    ],
]])

<form role="form" action="{{route('app.settings.update','config')}}" method="post" enctype="multipart/form-data" Files>
    @csrf
    <div class="card">
        <div class="card-header">
            <h5 class="card-title"> @lang("Edit General Settings") </h5>
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
            <fieldset>
                @foreach(app_languages() as $key=>$one)
                    <div class="tab-pane {{ $key == app()->getLocale() ? 'active' : '' }}" id="tab-{{$key}}" role="tabpanel">
                        <div class="form-body">
                            <div class="form-group row">
                                <label class="col-lg-2 control-label text-semibold">@lang('Title')</label>
                                <div class="col-lg-10">
                                    <input type="text" name="{{$key.'[title]'}}" value="{{old($key.'.title', $setting->translate($key)->title??'')}}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-body">
                            <div class="form-group row">
                                <label class="col-lg-2 control-label text-semibold">@lang('Address')</label>
                                <div class="col-lg-10">
                                    <input type="text" name="{{$key.'[address]'}}" value="{{old($key.'.address', $setting->translate($key)->address??'')}}" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <hr/>
                <div class="form-body">
                    <div class="form-group row">
                        <label class="col-lg-2 control-label text-semibold">@lang('Email')</label>
                        <div class="col-lg-10">
                            <input type="email" name="email" value="{{$setting->email??''}}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 control-label text-semibold">@lang('Phone')</label>
                        <div class="col-lg-10">
                            <input type="number" name="phone" value="{{$setting->phone??''}}" class="form-control">
                        </div>
                    </div>
                    {{-- <div class="form-group row">
                        <label class="col-lg-2 control-label text-semibold">@lang('App Store')</label>
                        <div class="col-lg-10">
                            <input type="text" name="appstore" value="{{$setting->appstore??''}}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 control-label text-semibold">@lang('Google Play')</label>
                        <div class="col-lg-10">
                            <input type="text" name="googleplay" value="{{$setting->googleplay??''}}" class="form-control">
                        </div>
                    </div> --}}
                    <div class="form-group row">
                        <label class="col-lg-2 control-label text-semibold">@lang('Icon')</label>
                        <div class="col-lg-10">
                            <input type="file" name="icon" value="{{$setting->icon_path??''}}" class="file-input icon">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 control-label text-semibold">@lang('Logo')</label>
                        <div class="col-lg-10">
                            <input type="file" name="logo" value="{{$setting->logo_path??''}}" class="file-input logo">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 control-label text-semibold">@lang('Footer Logo')</label>
                        <div class="col-lg-10">
                            <input type="file" name="footer_logo" value="{{$setting->footer_logo_path??''}}" class="file-input footer_logo">
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    {!! SubmitButton('Update') !!}
                </div>
            </fieldset>
        </div>
    </div>
</form>
@endsection
@push('scripts')
    <script src="https://cdn.ckeditor.com/4.11.4/standard-all/ckeditor.js"></script>
    <script>
        @foreach(app_languages() as $key=>$one)
            var data = $('#tag-input-'+"{{$key}}").val();
            if (data.length != 0) {
                data = $('#tag-input-'+"{{$key}}").val().split(",");
            }
            var tagInput = new TagsInput({
                selector: 'tag-input-'+"{{$key}}",
                duplicate : false,
                max : 10
            }).addData(data);
        @endforeach
    </script>
    {{-- Logo --}}
    <script>
        $(".logo").fileinput({
            allowedFileExtensions: ['jpg', 'png', 'gif', 'svg'],
            initialCaption: "@lang('No File Selected')",
            overwriteInitial: false,
            initialPreview: [
                "{{$setting->logo_path}}"
            ],
            initialPreviewAsData: true,
            initialPreviewFileType: 'image',
            initialPreviewConfig: [
                {caption: "{{$setting->logo}}", url: _url_+"app/settings/remove_logo/{{$setting->id}}"}
            ],
        }).on("filepredelete", function(jqXHR) {
            var abort = true;
            if (confirm("{{__('Are you sure you want to delete this image?')}}")) {
                abort = false;
            }
            return abort;
        });
    </script>
    {{-- Footer Logo --}}
    <script>
        $(".footer_logo").fileinput({
            allowedFileExtensions: ['jpg', 'png', 'gif', 'svg'],
            initialCaption: "@lang('No File Selected')",
            overwriteInitial: false,
            initialPreview: [
                "{{$setting->footer_logo_path}}"
            ],
            initialPreviewAsData: true,
            initialPreviewFileType: 'image',
            initialPreviewConfig: [
                {caption: "{{$setting->footer_logo}}", url: _url_+"app/settings/remove_footer_logo/{{$setting->id}}"}
            ],
        }).on("filepredelete", function(jqXHR) {
            var abort = true;
            if (confirm("{{__('Are you sure you want to delete this image?')}}")) {
                abort = false;
            }
            return abort;
        });
    </script>
    {{-- Icon --}}
    <script>
        $(".icon").fileinput({
            allowedFileExtensions: ['jpg', 'png', 'gif', 'svg'],
            initialCaption: "@lang('No File Selected')",
            overwriteInitial: false,
            initialPreview: [
                "{{$setting->icon_path}}"
            ],
            initialPreviewAsData: true,
            initialPreviewFileType: 'image',
            initialPreviewConfig: [
                {caption: "{{$setting->icon}}", url: _url_+"app/settings/remove_icon/{{$setting->id}}"}
            ],
        }).on("filepredelete", function(jqXHR) {
            var abort = true;
            if (confirm("{{__('Are you sure you want to delete this image?')}}")) {
                abort = false;
            }
            return abort;
        });
    </script>
@endpush
