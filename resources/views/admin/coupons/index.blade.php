@extends('admin.layouts.master')
@section('head_title'){{__('Coupons')}}@endsection
@section('content')
@include('admin.layouts.inc.breadcrumb', ['array' => [
    [
        'name'  =>  __('Coupons'),
        'route' =>  'coupons.index',
    ],
],'button' => [
        'title' => __('Add Coupon'),
        'route' =>  'coupons.create',
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
                                    <label class="form-label">@lang('Name')</label>
                                    <input type="text" name="name" class="form-control dt-input dt-full-name" value="{{old('name', request('name'))}}" data-column="1" placeholder="{{__('Name')}}" data-column-index="0" />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">@lang('Start Date')</label>
                                    <input type="date" name="start_date" class="form-control dt-input" data-column="6" value="{{old('start_date', request('start_date'))}}" placeholder="{{__('mm/dd/yy')}}" data-column-index="5" />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">@lang('End Date')</label>
                                    <input type="date" name="end_date" class="form-control dt-input" data-column="6" value="{{old('end_date', request('end_date'))}}" placeholder="{{__('mm/dd/yy')}}" data-column-index="5" />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="select2-basic">@lang('Status')</label>
                                    <select class="select-search" id="select2-basic" name="is_active">
                                        <option value="">@lang("Choose")</option>
                                        <option value="1" @if(!is_null(request('is_active')) && request('is_active') == 1) selected @endif>@lang("Active")</option>
                                        <option value="0" @if(!is_null(request('is_active')) && request('is_active') == 0) selected @endif>@lang("Un Active")</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">@lang('Created At')</label>
                                    <input type="date" name="created_at" class="form-control dt-input" data-column="6" value="{{old('created_at', request('created_at'))}}" placeholder="{{__('mm/dd/yy')}}" data-column-index="5" />
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
                                    <th>@lang('Name')</th>
                                    <th {!! \table_width_head(5) !!}>@lang('Start Date')</th>
                                    <th {!! \table_width_head(5) !!}>@lang('End Date')</th>
                                    <th {!! \table_width_head(5) !!}>@lang('Code')</th>
                                    <th {!! \table_width_head(5) !!}>@lang('Type')</th>
                                    <th {!! \table_width_head(5) !!}>@lang('Value')</th>
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
                                        <td> {{$item->name ?? '-------'}} </td>
                                        <td> {{$item->start_date ?? '-------'}} </td>
                                        <td> {{$item->end_date ?? '-------'}} </td>
                                        <td> {{$item->code ?? '-------'}} </td>
                                        <td> {{$item->type ?? '-------'}} </td>
                                        <td> {{$item->value ?? '-------'}} </td>
                                        <td>
                                            @if($item->is_active == 0)
                                                <a href="{{route('app.coupons.is_active', $item->id)}}" class="label label-sm label-danger" title="{{__('Active')}}"> <i data-feather="x" stroke-width="7" style="color: red;"></i> </a>
                                            @else
                                                <a href="{{route('app.coupons.is_active', $item->id)}}" class="label label-sm label-success" title="{{__('Un Active')}}"> <i data-feather="check" stroke-width="7" style="color: #00b800;"></i> </a>
                                            @endif
                                        </td>
                                        <td> {{$item->created_at}} </td>
                                        <td>
                                            {!! editForm('coupons', $item) !!}
                                            {!! deleteForm('coupons', $item) !!}
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="no-records-found" style="text-align: center;">
                                    <td colspan="7">@lang('No Data Founded')</td>
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
