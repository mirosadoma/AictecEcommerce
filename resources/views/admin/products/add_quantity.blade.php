@extends('admin.layouts.master')
@section('head_title'){{__('Add Quantity')}}@endsection
@section('content')
@include('admin.layouts.inc.breadcrumb', ['array' => [
    [
        'name'  =>  __('Products'),
        'route' =>  'products.index',
    ],
    [
        'name'  =>  __('Add Quantity'),
        'route' =>  'products.add_quantity',
    ],
],'button' => [
        'title' => __('Back To Products'),
        'route' =>  'products.index',
        'icon'  => 'arrow-left'
]])
<div class="card">
    <div class="card-header">
        <h5 class="card-title"> @lang("Add Quantity") </h5>
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
        <form class="form-horizontal" action="{{route('app.products.save_quantity')}}" method="post" enctype="multipart/form-data">
            <fieldset>
                @csrf
                <div class="form-body">
                    <div class="form-group row">
                        <label class="form-label col-sm-2" for="select1-basic">@lang('Products')</label>
                        <div class="input-icon right col-sm-10">
                            <select class="select-search form-control" id="select1-basic" name="products[]" multiple>
                                <option value="0">@lang("Choose")</option>
                                @forelse($products as $product)
                                    <option value="{{$product->id}}">{{$product->title}}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <hr>
                    <div class="form-group row">
                        {!! Inputs('text', 'quantity', 'Quantity', 'form-control') !!}
                    </div>
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
    {!! JsValidator::formRequest('App\Http\Requests\Dashboard\Products\SaveQuantityRequest') !!}
@endpush
