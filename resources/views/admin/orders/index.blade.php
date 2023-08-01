@extends('admin.layouts.master')
@section('head_title'){{__('Shipping Companies')}}@endsection
@section('content')
@include('admin.layouts.inc.breadcrumb', ['array' => [
    [
        'name'  =>  __('Shipping Companies'),
        'route' =>  'shipping_companies.index',
    ],
],'button' => [
        'title' => __('Add Shipping Company'),
        'route' =>  'shipping_companies.create',
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
                            @if (admin_can_item('orders', 'exel') == "true")
                                <a class="btn btn-info btn-round waves-effect waves-float waves-light form-reset" title="{{__("Export To Exel")}}" style="padding: 10px 25px;" href="{{route('app.orders_export')}}"><i data-feather="download"></i></a>
                            @endif
                        </div>
                    </div>
                    <!--Search Form -->
                    <div class="card-body mt-2">
                        <form class="dt_adv_search" method="GET">
                            <div class="row g-1 mb-md-1">
                                <div class="col-md-4">
                                    <label class="form-label">@lang('Client')</label>
                                    <input type="text" name="user" class="form-control dt-input dt-full-name" value="{{old('user', request('user'))}}" data-column="1" placeholder="{{__('Client')}}" data-column-index="0" />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="select2-basic">@lang('City')</label>
                                    <select class="select-search" id="select2-basic" name="city_id">
                                        <option value="">@lang("Choose")</option>
                                        @foreach ($cities as $city)
                                            <option value="{{$city->id}}" @if(!is_null(request('city_id')) && request('city_id') == $city->id) selected @endif>{{$city->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="select3-basic">@lang('District')</label>
                                    <select class="select-search" id="select3-basic" name="district_id">
                                        <option value="">@lang("Choose")</option>
                                        @foreach ($districts as $district)
                                            <option value="{{$district->id}}" @if(!is_null(request('district_id')) && request('district_id') == $district->id) selected @endif>{{$district->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="select1-basic">@lang('Status')</label>
                                    <select class="select-search" id="select1-basic" name="status">
                                        <option value="">@lang("Choose")</option>
                                        @foreach (\App\Models\Orders\Order::getOrderStatuses() as $key => $item)
                                            <option value="{{$key}}" @if(!is_null(request('status')) && request('status') == $key) selected @endif>@lang($item)</option>
                                        @endforeach
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
                                    <th>@lang("Client")</th>
                                    <th {!! \table_width_head(3) !!}>@lang("City")</th>
                                    <th {!! \table_width_head(3) !!}>@lang("District")</th>
                                    <th {!! \table_width_head(3) !!}>@lang("Number")</th>
                                    <th {!! \table_width_head(7) !!}>@lang("Payment Method")</th>
                                    <th {!! \table_width_head(3) !!}>@lang("Status")</th>
                                    <th {!! \table_width_head(5) !!}>@lang("Sub Total")</th>
                                    <th {!! \table_width_head(5) !!}>@lang("Tax")</th>
                                    <th {!! \table_width_head(7) !!}>@lang("Grand Total")</th>
                                    <th {!! \table_width_head(7) !!}>@lang("Final Total")</th>
                                    <th {!! \table_width_head(5) !!}>@lang('Created At')</th>
                                    <th {!! \table_width_head(2) !!}>@lang('Actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($lists->count())
                                @foreach ($lists as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td><a href="{{ route('app.clients.edit' , [$item->user_id]) }}">{{ $item->user->name ?? "-------" }}</a></td>
                                        <td>{{$item->city->name ?? "-------"}}</td>
                                        <td>{{$item->district->name ?? "-------"}}</td>
                                        <td>{{$item->payment_method ?? "-------"}}</td>
                                        <td>{{order::getOrderStatuses($item->status) ?? "-------"}}</span></td>
                                        <td>{{$item->sub_total}} @lang("R.S")</td>
                                        <td>{{$item->tax}} @lang("R.S")</td>
                                        <td>{{$item->grand_total}} @lang("R.S")</td>
                                        <td>{{$item->final_total}} @lang("R.S")</td>
                                        <td> {{$item->created_at->diffForHumans()}} </td>
                                        <td>
                                            {!! showForm('orders', $item) !!}
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="no-records-found" style="text-align: center;">
                                    <td colspan="13">@lang('No Data Founded')</td>
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
@push('scripts')
    <script>
        function print_details(order_id) {
            x = window.open('{!!url('/' . app()->getLocale() . '/app/order_print/')!!}' + '/' + order_id);
            x.print();
        }
    </script>
@endpush
