@extends('admin.layouts.master')
@section('head_title'){{__('Edit')}}@endsection
@section('content')
@include('admin.layouts.inc.breadcrumb', ['array' => [
    [
        'name'  =>  __('Help Center'),
        'route' =>  'help_center.index',
    ],
    [
        'name'  =>  __('Edit'),
        'route' =>  'help_center.edit',
    ],
],'button' => [
        'title' => __('Back To Help Center'),
        'route' =>  'help_center.index',
        'icon'  => 'arrow-left'
]])
<div class="card">
    <div class="card-header">
        <h5 class="card-title"> @lang("Edit") </h5>
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
        <form class="form-horizontal" action="{{route('app.help_center.update', $help_center->id)}}" method="post" enctype="multipart/form-data">
            <fieldset>
                @csrf
                @method('PUT')
                @foreach(app_languages() as $key=>$one)
                    <div class="tab-pane {{ $key == app()->getLocale() ? 'active' : '' }}" id="tab-{{$key}}" role="tabpanel">
                        <div class="form-body">
                            <div class="form-group row">
                                {!! Inputs('text', $key.'[title]', 'Title', 'form-control', old($key.'.title', $help_center->translate($key)->title??'')) !!}
                            </div>
                            <div class="form-group row">
                                {!! TextArea($key.'[content]', 'Content', 'form-control', old($key.'.content', $help_center->translate($key)->content??''), true, $key.'_content') !!}
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="text-right">
                    {!! BackButton('Back', route('app.help_center.index')) !!}
                    {!! SubmitButton('Update') !!}
                </div>
            </fieldset>
        </form>
    </div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Dashboard\HelpCenter\UpdateRequest') !!}
    <script src="https://cdn.ckeditor.com/4.11.4/standard-all/ckeditor.js"></script>
    <script>
        @foreach(app_languages() as $key=>$one)
            CKEDITOR.replace("{{$key}}"+'_content', {
                colorButton_colors: '000,800000,8B4513,2F4F4F,008080,000080,4B0082,696969,' +
                    'B22222,A52A2A,DAA520,006400,40E0D0,0000CD,800080,808080,' +
                    'F00,FF8C00,FFD700,008000,0FF,00F,EE82EE,A9A9A9,' +
                    'FFA07A,FFA500,FFFF00,00FF00,AFEEEE,ADD8E6,DDA0DD,D3D3D3,' +
                    'FFF0F5,FAEBD7,FFFFE0,F0FFF0,F0FFFF,F0F8FF,E6E6FA,FFF',
                extraPlugins: 'colorbutton'
            });
        @endforeach
    </script>
@endpush
