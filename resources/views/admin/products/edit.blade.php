@extends('admin.layouts.master')
@section('head_title'){{__('Edit Product')}}@endsection
@section('content')
@include('admin.layouts.inc.breadcrumb', ['array' => [
    [
        'name'  =>  __('Products'),
        'route' =>  'products.index',
    ],
    [
        'name'  =>  __('Edit Product'),
        'route' =>  'products.edit',
    ],
],'button' => [
        'title' => __('Back To Products'),
        'route' =>  'products.index',
        'icon'  => 'arrow-left'
]])
<div class="card">
    <div class="card-header">
        <h5 class="card-title"> @lang("Edit Product") </h5>
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
        <form class="form-horizontal" action="{{route('app.products.update', $product->id)}}" method="post" enctype="multipart/form-data">
            <fieldset>
                @csrf
                @method('PUT')
                @foreach(app_languages() as $key=>$one)
                    <div class="tab-pane {{ $key == app()->getLocale() ? 'active' : '' }}" id="tab-{{$key}}" role="tabpanel">
                        <div class="form-body">
                            <div class="form-group row">
                                {!! Inputs('text', $key.'[title]', 'Title', 'form-control', old($key.'.title', $product->translate($key)->title??'')) !!}
                            </div>
                            <div class="form-group row">
                                {!! TextArea($key.'[small_description]', 'Small Description', 'form-control', old($key.'.small_description', $product->translate($key)->small_description??'')) !!}
                            </div>
                            <div class="form-group row">
                                {!! TextArea($key.'[description]', 'Description', 'form-control', old($key.'.description', $product->translate($key)->description??''), true, $key.'_description') !!}
                            </div>
                        </div>
                    </div>
                @endforeach
                <hr>
                <div class="form-body">
                    <div class="form-group row">
                        <label class="form-label col-sm-2" for="select1-basic">@lang('Category')</label>
                        <div class="input-icon right col-sm-10">
                            <select class="select-search form-control" id="select1-basic" name="category_id">
                                <option value="0">@lang("Choose")</option>
                                @forelse($categories as $category)
                                    <option value="{{$category->id}}" @if($category->id == $product->category->id) selected @endif>{{$category->name}}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="form-label col-sm-2" for="select2-basic">@lang('Brand')</label>
                        <div class="input-icon right col-sm-10">
                            <select class="select-search form-control" id="select2-basic" name="brand_id">
                                <option value="0">@lang("Choose")</option>
                                @forelse($brands as $brand)
                                    <option value="{{$brand->id}}" @if($brand->id == $product->brand->id) selected @endif>{{$brand->name}}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Inputs('text', 'model', 'Model', 'form-control', old('model', $product->model)) !!}
                    </div>
                    <div class="form-group row">
                        {!! Inputs('text', 'price', 'Price', 'form-control', old('price', $product->price)) !!}
                    </div>
                    <div class="form-group row">
                        {!! Inputs('text', 'old_price', 'Old Price', 'form-control', old('old_price', $product->old_price)) !!}
                    </div>
                    <div class="form-group row">
                        {!! Inputs('text', 'quantity', 'Quantity', 'form-control', old('quantity', $product->quantity)) !!}
                    </div>
                    <hr>
                    <div class="form-group row">
                        {!! Inputs('file', 'main_image', 'Main Image', 'file-input main_image form-control', $product->main_image_path) !!}
                    </div>
                    <div class="form-group row">
                        {!! Inputs('file', 'images[]', 'Images', 'file-input images form-control', '', false, true) !!}
                    </div>
                </div>
                {{-- features --}}
                <hr>
                <div class="form-body">
                    <div class="card-header">
                        <h5 class="card-title" style="text-decoration: underline"> @lang("Basic Features") </h5>
                    </div>
                    @if($features->count())
                        @foreach($features as $feature)
                            <div class="form-group row feature_{{ $feature->id }}">
                                <div class="col-sm-5">
                                    <input value="{{$feature->translate('ar')->title}}" class="form-control" name="features[ar_title][]" type="text" placeholder="{{__('Arabic Title')}}">
                                </div>
                                <div class="col-sm-5">
                                    <input value="{{$feature->translate('en')->title}}" class="form-control" name="features[en_title][]" type="text" placeholder="{{__('English Title')}}">
                                </div>
                                <div class="col-sm-1">
                                    <a class="btn btn-danger remove-contact" data-id="{{ $feature->id }}">
                                        <center><b>X</b></center>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    <div class="form-group row">
                        <div class="add-other-feature">
                            <?php $n = rand(1,50); ?>
                            <div class="row feature_{{ $n }}">
                                <div class="col-sm-5">
                                    <input class="form-control" name="features[ar_title][]" type="text" placeholder="{{__('Arabic Title')}}">
                                </div>
                                <div class="col-sm-5">
                                    <input class="form-control" name="features[en_title][]" type="text" placeholder="{{__('English Title')}}">
                                </div>
                                <div class="col-sm-1">
                                    <a class="btn btn-danger remove-feature" data-id="{{$n}}">
                                        <center><b>X</b></center>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="other-features"></div>
                        <a class="btn btn-success add-new-feature col-sm-3" style="margin: 10px 40px;"> + @lang("Add New Feature")</a>
                    </div>
                </div>
                {{-- options --}}
                <hr>
                <div class="form-body">
                    <div class="card-header">
                        <h5 class="card-title" style="text-decoration: underline"> @lang("Another Options") </h5>
                    </div>
                    @if($options->count())
                        @foreach($options as $cn)
                            <div class="form-group row option_{{ $cn->id }}">
                                <div class="col-sm-4">
                                    <input value="{{$cn->ar_name}}" class="form-control" name="options[ar_name][]" type="text" placeholder="{{__('Arabic Name')}}">
                                </div>
                                <div class="col-sm-4">
                                    <input value="{{$cn->en_name}}" class="form-control" name="options[en_name][]" type="text" placeholder="{{__('English Name')}}">
                                </div>
                                <div class="col-sm-3">
                                    <input value="{{$cn->value}}" class="form-control" name="options[value][]" type="text" placeholder="{{__('Value')}}">
                                </div>
                                <div class="col-sm-1">
                                    <a class="btn btn-danger remove-contact" data-id="{{ $cn->id }}">
                                        <center><b>X</b></center>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    <div class="form-group row">
                        <div class="add-other-option">
                            <?php $n = rand(1,50); ?>
                            <div class="row option_{{ $n }}">
                                <div class="col-sm-4">
                                    <input class="form-control" name="options[ar_name][]" type="text" placeholder="{{__('Arabic Name')}}">
                                </div>
                                <div class="col-sm-4">
                                    <input class="form-control" name="options[en_name][]" type="text" placeholder="{{__('English Name')}}">
                                </div>
                                <div class="col-sm-3">
                                    <input class="form-control" name="options[value][]" type="text" placeholder="{{__('Value')}}">
                                </div>
                                <div class="col-sm-1">
                                    <a class="btn btn-danger remove-option" data-id="{{$n}}">
                                        <center><b>X</b></center>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="other-options"></div>
                        <a class="btn btn-success add-new-option col-sm-3" style="margin: 10px 40px;"> + @lang("Add New Option")</a>
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    {!! Inputs('file', 'files[]', 'Files', 'file-input files form-control', '', false, true) !!}
                </div>
                <div class="text-right">
                    {!! BackButton('Back', route('app.products.index')) !!}
                    {!! SubmitButton('Update') !!}
                </div>
            </fieldset>
        </form>
    </div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Dashboard\Products\UpdateRequest') !!}
    <script src="https://cdn.ckeditor.com/4.11.4/standard-all/ckeditor.js"></script>
    <script>
        @foreach(app_languages() as $key=>$one)
            CKEDITOR.replace("{{$key}}"+'_description', {
                colorButton_colors: '000,800000,8B4513,2F4F4F,008080,000080,4B0082,696969,' +
                    'B22222,A52A2A,DAA520,006400,40E0D0,0000CD,800080,808080,' +
                    'F00,FF8C00,FFD700,008000,0FF,00F,EE82EE,A9A9A9,' +
                    'FFA07A,FFA500,FFFF00,00FF00,AFEEEE,ADD8E6,DDA0DD,D3D3D3,' +
                    'FFF0F5,FAEBD7,FFFFE0,F0FFF0,F0FFFF,F0F8FF,E6E6FA,FFF',
                extraPlugins: 'colorbutton'
            });
        @endforeach
    </script>
    {{-- main image --}}
    <script>
        $(".main_image").fileinput({
            allowedFileExtensions: ['jpg', 'jpeg', 'png', 'gif'],
            initialCaption: "@lang('No File Selected')",
            overwriteInitial: false,
            initialPreview: [
                "{{$product->main_image_path}}"
            ],
            initialPreviewAsData: true,
            initialPreviewFileType: 'image',
            initialPreviewConfig: [
                {caption: "{{$product->main_image}}", url: _url_+"app/products/remove_main_image/{{$product->id}}"}
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
    {{-- images --}}
    <script>
        var initialPreview = [];
        var initialPreviewConfig = [];
        @foreach($product->product_images as $product_image)
            initialPreview.push("{{$product_image->image_path}}");
            initialPreviewConfig.push({caption: "{{$product_image->image}}", url: _url_+"app/products/remove_images/{{$product_image->id}}"});
        @endforeach
        $(".images").fileinput({
            allowedFileExtensions: ['jpg', 'jpeg', 'png', 'gif'],
            initialCaption: "@lang('No File Selected')",
            overwriteInitial: false,
            initialPreview: initialPreview,
            initialPreviewAsData: true,
            initialPreviewFileType: 'image',
            initialPreviewConfig: initialPreviewConfig,
        }).on("filepredelete", function(jqXHR) {
            var abort = true;
            if (confirm("{{__('Are you sure you want to delete this image?')}}")) {
                abort = false;
            }
            return abort;
        });
    </script>
    {{-- files --}}
    <script>
        var initialPreview = [];
        var initialPreviewConfig = [];
        @foreach($product->product_files as $product_file)
            initialPreview.push("{{$product_file->file_path}}");
            initialPreviewConfig.push({caption: "{{$product_file->file}}", url: _url_+"app/products/remove_files/{{$product_file->id}}"});
        @endforeach
        $(".files").fileinput({
            allowedFileExtensions: ['pdf'],
            initialCaption: "@lang('No File Selected')",
            overwriteInitial: false,
            initialPreview: initialPreview,
            initialPreviewAsData: true,
            initialPreviewFileType: 'image',
            initialPreviewConfig: initialPreviewConfig,
        }).on("filepredelete", function(jqXHR) {
            var abort = true;
            if (confirm("{{__('Are you sure you want to delete this image?')}}")) {
                abort = false;
            }
            return abort;
        });
    </script>
    {{-- features --}}
    <script>
        $(document).on('click', '.add-new-feature',function () {
            var parent = $(this).data('parent');
            var random = Math.floor(Math.random() * 100) + 1;
            var ct = '<div class="form-group row feature_'+random+'">';
            ct += '<div class="col-sm-5">';
            ct += '<input class="form-control" name="features[ar_title][]" type="text" placeholder="'+"{{__('Arabic Title')}}"+'">';
            ct += '</div>';
            ct += '<div class="col-sm-5">';
            ct += '<input class="form-control" name="features[en_title][]" type="text" placeholder="'+"{{__('English Title')}}"+'">';
            ct += '</div>';
            ct += '<div class="col-sm-1">';
            ct += '<a class="btn btn-danger remove-feature" data-id="'+random+'">';
            ct += '<center><b>X</b></center>';
            ct += '</a>';
            ct += '</div>';
            $('.other-features').append(ct);
        });

        $(document).on('click', '.remove-feature',function () {
            var id = $(this).attr('data-id');
            $('.feature_'+id+' select').val('');
            $('.feature_'+id+' input[name="features[ar_title][]"]').val('');
            $('.feature_'+id+' input[name="features[en_title][]"]').val('');
            $('.feature_'+id).hide();
        });
    </script>
    {{-- options --}}
    <script>
        $(document).on('click', '.add-new-option',function () {
            var parent = $(this).data('parent');
            var random = Math.floor(Math.random() * 100) + 1;
            var ct = '<div class="form-group row option_'+random+'">';
            ct += '<div class="col-sm-4">';
            ct += '<input class="form-control" name="options[ar_name][]" type="text" placeholder="'+"{{__('Arabic Name')}}"+'">';
            ct += '</div>';
            ct += '<div class="col-sm-4">';
            ct += '<input class="form-control" name="options[en_name][]" type="text" placeholder="'+"{{__('English Name')}}"+'">';
            ct += '</div>';
            ct += '<div class="col-sm-3">';
            ct += '<input class="form-control" name="options[value][]" type="text" placeholder="'+"{{__('Value')}}"+'">';
            ct += '</div>';
            ct += '<div class="col-sm-1">';
            ct += '<a class="btn btn-danger remove-option" data-id="'+random+'">';
            ct += '<center><b>X</b></center>';
            ct += '</a>';
            ct += '</div>';
            $('.other-options').append(ct);
        });

        $(document).on('click', '.remove-option',function () {
            var id = $(this).attr('data-id');
            $('.option_'+id+' select').val('');
            $('.option_'+id+' input[name="options[ar_name][]"]').val('');
            $('.option_'+id+' input[name="options[en_name][]"]').val('');
            $('.option_'+id+' input[name="options[value][]"]').val('');
            $('.option_'+id).hide();
        });
    </script>
@endpush
