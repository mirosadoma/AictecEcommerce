@extends('admin.layouts.master')
@section('head_title'){{__('Maintenance Mode')}}@endsection
@section('content')
@include('admin.layouts.inc.breadcrumb', ['array' => [
    [
        'name'  =>  __('Maintenance Mode'),
        'route' =>  ['settings.index','maintenance'],
    ],
]])
<div class="card">
    <div class="card-header">
        <h5 class="card-title"> @lang("Edit Maintenance Mode") </h5>
    </div>
    <div class="card-body table-responsive">
        <form class="form-horizontal" action="{{route('app.settings.update','maintenance')}}" method="post" enctype="multipart/form-data" Files>
            @csrf
            <fieldset>
                <div class="form-body">
                    <div class="form-group row">
                        <label class="control-label col-sm-2">@lang('Status')</label>
                        <div class="input-icon right col-sm-10">
                            <select class="select-search form-control" name="close">
                                <option value="0" @if(old('close', $setting->close) == 0) selected @endif>@lang('Open')</option>
                                <option value="1" @if(old('close', $setting->close) == 1) selected @endif>@lang('Close')</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 control-label text-semibold">@lang('Close Messages')</label>
                        <div class="col-lg-10">
                            <textarea name="close_msg" id="editor" class="form-control">{{$setting->close_msg??''}}</textarea>
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
@push('scripts')
    <script src="https://cdn.ckeditor.com/4.11.4/standard-all/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('editor', {
            colorButton_colors: '000,800000,8B4513,2F4F4F,008080,000080,4B0082,696969,' +
                'B22222,A52A2A,DAA520,006400,40E0D0,0000CD,800080,808080,' +
                'F00,FF8C00,FFD700,008000,0FF,00F,EE82EE,A9A9A9,' +
                'FFA07A,FFA500,FFFF00,00FF00,AFEEEE,ADD8E6,DDA0DD,D3D3D3,' +
                'FFF0F5,FAEBD7,FFFFE0,F0FFF0,F0FFFF,F0F8FF,E6E6FA,FFF',
            extraPlugins: 'colorbutton,justify',
        });
    </script>
@endpush
