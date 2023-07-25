@extends('admin.layouts.master')
@section('head_title'){{__('Products')}}@endsection
@section('content')
@include('admin.layouts.inc.breadcrumb', ['array' => [
    [
        'name'  =>  __('Products'),
        'route' =>  'products.index',
    ],
],'button' => [
        'title' => __('Add Product'),
        'route' =>  'products.create',
        'icon'  => 'plus'
]])

<div class="content-body">
    <!-- Advanced Search -->
    <section id="advanced-search-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h4 class="card-title">@lang('Advanced Search')</h4>
                        <div class="card-title">
                            <button class="btn btn-primary btn-round waves-effect waves-float waves-light" title="{{__("Search")}}" style="padding: 10px 25px;" type="button" onclick="$('.dt_adv_search').submit()"><i data-feather="database"></i></button>
                            <button class="btn btn-warning btn-round waves-effect waves-float waves-light form-reset" title="{{__("Reset Search Data")}}" style="padding: 10px 25px;" type="button" onclick="resetForm();"><i data-feather="minus-circle"></i></button>
                        </div>
                    </div>
                    <!--Search Form -->
                    <div class="card-body mt-2">
                        <form class="dt_adv_search" method="GET">
                            <div class="row g-1 mb-md-1">
                                <div class="col-md-4">
                                    <label class="form-label">@lang('Title')</label>
                                    <input type="text" name="title" class="form-control dt-input dt-full-name" value="{{old('title', request('title'))}}" data-column="1" placeholder="{{__('Title')}}" data-column-index="0" />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">@lang('Model')</label>
                                    <input type="text" name="model" class="form-control dt-input dt-full-name" value="{{old('model', request('model'))}}" data-column="1" placeholder="{{__('Model')}}" data-column-index="0" />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">@lang('Created At')</label>
                                    <input type="date" name="created_at" class="form-control dt-input" data-column="6" value="{{old('created_at', request('created_at'))}}" placeholder="{{__('mm/dd/yy')}}" data-column-index="5" />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="select1-basic">@lang('Category')</label>
                                    <select class="select-search" id="select1-basic" name="category_id">
                                        <option value="">@lang("Choose")</option>
                                        @foreach ($categories as $category)
                                            <option value="{{$category->id}}" @if(!is_null(request('category_id')) && request('category_id') == $category->id) selected @endif>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="select2-basic">@lang('Brand')</label>
                                    <select class="select-search" id="select2-basic" name="brand_id">
                                        <option value="">@lang("Choose")</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{$brand->id}}" @if(!is_null(request('brand_id')) && request('brand_id') == $brand->id) selected @endif>{{$brand->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="select3-basic">@lang('Status')</label>
                                    <select class="select-search" id="select3-basic" name="is_active">
                                        <option value="">@lang("Choose")</option>
                                        <option value="1" @if(!is_null(request('is_active')) && request('is_active') == 1) selected @endif>@lang("Active")</option>
                                        <option value="0" @if(!is_null(request('is_active')) && request('is_active') == 0) selected @endif>@lang("Un Active")</option>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="filter" value="1"/>
                        </form>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body table-responsive">
                        <table class="table datatable-basic">
                            <thead>
                                <tr>
                                    <th {!! \table_width_head(1) !!}>#</th>
                                    <th>@lang('Main Image')</th>
                                    <th {!! \table_width_head(7) !!}>@lang('Title')</th>
                                    <th {!! \table_width_head(5) !!}>@lang('Category') </th>
                                    <th {!! \table_width_head(5) !!}>@lang('Brand') </th>
                                    <th {!! \table_width_head(5) !!}>@lang('Model') </th>
                                    <th {!! \table_width_head(4) !!}>@lang('Price')</th>
                                    <th {!! \table_width_head(5) !!}>@lang('Old Price') </th>
                                    <th {!! \table_width_head(1) !!}>@lang('Quantity') </th>
                                    <th {!! \table_width_head(1) !!}>@lang('Images') </th>
                                    <th {!! \table_width_head(1) !!}>@lang('Status') </th>
                                    <th {!! \table_width_head(7) !!}>@lang('Created At')</th>
                                    <th {!! \table_width_head(5) !!}>@lang('Actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($lists->count())
                                @foreach ($lists as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td> <img src="{{$item->main_image_path}}" alt="{{$item->main_image_path}}" style="height: 100px !important;"> </td>
                                        <td> {{$item->title ?? '-------'}} </td>
                                        <td> {{$item->category->name ?? '-------'}} </td>
                                        <td> {{$item->brand->name ?? '-------'}} </td>
                                        <td> {{$item->model ?? '-------'}} </td>
                                        <td> {{$item->price ?? '-------'}}  <span style="color: red">@lang("R.S")</span></td>
                                        <td style="text-decoration: line-through;"> {{$item->old_price ?? '-------'}}  <span style="color: red">@lang("R.S")</span></td>
                                        <td> {{$item->quantity ?? '-------'}} </td>
                                        <td> {{$item->product_images->count() ?? '-------'}} </td>
                                        <td>
                                            @if($item->is_active == 0)
                                                <a href="{{route('app.products.is_active', $item->id)}}" class="label label-sm label-danger" title="{{__('Active')}}"> <i data-feather="x" stroke-width="7" style="color: red;"></i> </a>
                                            @else
                                                <a href="{{route('app.products.is_active', $item->id)}}" class="label label-sm label-success" title="{{__('Un Active')}}"> <i data-feather="check" stroke-width="7" style="color: #00b800;"></i> </a>
                                            @endif
                                        </td>
                                        <td> {{$item->created_at}} </td>
                                        <td>
                                            {!! editForm('products', $item) !!}
                                            {!! deleteForm('products', $item) !!}
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="no-records-found" style="text-align: center;">
                                    <td colspan="12">@lang('No Data Founded')</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                        <!-- start pagination -->
                        <div class="pagination-section">
                            <div class="container">
                                {!! $lists->links() !!}
                            </div>
                        </div>
                        <!-- start pagination -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ Advanced Search -->
</div>
@endsection
