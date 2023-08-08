@extends('admin.layouts.master')
@section('head_title'){{__('Offer Prices')}}@endsection
@section('content')
@include('admin.layouts.inc.breadcrumb', ['array' => [
    [
        'name'  =>  __('Offer Prices'),
        'route' =>  'offer_prices.index',
    ],
],'button' => []])

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
                                    <label class="form-label">@lang('Number')</label>
                                    <input type="text" name="number" class="form-control dt-input dt-full-name" value="{{old('number', request('number'))}}" data-column="1" placeholder="{{__('Number')}}" data-column-index="0" />
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
                                    <th>@lang('Full Name')</th>
                                    <th {!! \table_width_head(3) !!}>@lang('Number')</th>
                                    <th {!! \table_width_head(3) !!}>@lang('Phone')</th>
                                    <th {!! \table_width_head(7) !!}>@lang('Email')</th>
                                    <th {!! \table_width_head(7) !!}>@lang('Company Url')</th>
                                    <th {!! \table_width_head(3) !!}>@lang('Type')</th>
                                    <th {!! \table_width_head(7) !!}>@lang('Created At')</th>
                                    <th {!! \table_width_head(3) !!}>@lang('Actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($lists->count())
                                @foreach ($lists as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td> {{$item->full_name ?? '-------'}} </td>
                                        <td> {{$item->number ?? '-------'}} </td>
                                        <td> {{$item->phone ?? '-------'}} </td>
                                        <td> {{$item->email ?? '-------'}} </td>
                                        <td> {{$item->company_url ?? '-------'}} </td>
                                        <td> {{\Str::ucfirst($item->type) ?? '-------'}} </td>
                                        <td> {{$item->created_at}} </td>
                                        <td>
                                            {!! showForm('offer_prices', $item) !!}
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
