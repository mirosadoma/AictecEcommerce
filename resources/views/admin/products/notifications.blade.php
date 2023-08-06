@extends('admin.layouts.master')
@section('head_title'){{__('Products')}}@endsection
@section('content')
@include('admin.layouts.inc.breadcrumb', ['array' => [
    [
        'name'  =>  __('Products'),
        'route' =>  'products.index',
    ],
    [
        'name'  =>  __('Notifications'),
        'route' =>  'products.notifications',
    ],
],'button' => [
        'title' => __('Back To Products'),
        'route' =>  'products.index',
        'icon'  => 'arrow-left'
]])

<div class="content-body">
    <!-- Advanced Search -->
    <section id="advanced-search-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body table-responsive">
                        <table class="table datatable-basic">
                            <thead>
                                <tr>
                                    <th {!! \table_width_head(1) !!}>#</th>
                                    <th>@lang('Product Image')</th>
                                    <th {!! \table_width_head(7) !!}>@lang('Product Title')</th>
                                    <th {!! \table_width_head(7) !!}>@lang('Product Model')</th>
                                    <th {!! \table_width_head(7) !!}>@lang('User Name')</th>
                                    <th {!! \table_width_head(5) !!}>@lang('Quantity') </th>
                                    <th {!! \table_width_head(7) !!}>@lang('Created At')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($lists->count())
                                @foreach ($lists as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td> <img src="{{$item->product->main_image_path}}" alt="{{$item->product->main_image_path}}" style="height: 100px !important;"> </td>
                                        <td> {{$item->product->title ?? '-------'}} </td>
                                        <td> {{$item->product->model ?? '-------'}} </td>
                                        <td> {{$item->user->name ?? '-------'}} </td>
                                        <td> {{$item->quantity ?? '-------'}} </td>
                                        <td> {{$item->created_at}} </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="no-records-found" style="text-align: center;">
                                    <td colspan="6">@lang('No Data Founded')</td>
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
