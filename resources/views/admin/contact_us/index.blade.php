@extends('admin.layouts.master')
@section('head_title'){{__('All ContactUs')}}@endsection
@section('content')
@include('admin.layouts.inc.breadcrumb', ['array' => [
    [
        'name'  =>  __('ContactUs'),
        'route' =>  'contactus.index',
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
                            <a href="{{route('app.contactus.export')}}" class="btn btn-instagram btn-round waves-effect waves-float waves-light">@lang("Export Exel File")</a>
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
                                    <label class="form-label">@lang('Email')</label>
                                    <input type="text" name="email" class="form-control dt-input dt-full-email" value="{{old('email', request('email'))}}" data-column="1" placeholder="{{__('Email')}}" data-column-index="0" />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">@lang('Phone')</label>
                                    <input type="text" name="phone" class="form-control dt-input dt-full-phone" value="{{old('phone', request('phone'))}}" data-column="1" placeholder="{{__('Phone')}}" data-column-index="0" />
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
                                    <th>@lang('Contact Owner')</th>
                                    <th {!! \table_width_head(6) !!}>@lang('Name')</th>
                                    <th {!! \table_width_head(6) !!}>@lang('Email')</th>
                                    <th {!! \table_width_head(3) !!}>@lang('Phone')</th>
                                    <th {!! \table_width_head(3) !!}>@lang('Replay')</th>
                                    <th {!! \table_width_head(6) !!}>@lang('Created At')</th>
                                    <th {!! \table_width_head(5) !!}>@lang('Actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($lists as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td> {{$item->user->name??'---------'}} </td>
                                        <td> {{$item->name??'---------'}} </td>
                                        <td> {{$item->email??'---------'}} </td>
                                        <td> {{$item->phone??'---------'}} </td>
                                        <td>
                                            @if (!empty($item->reply) && !is_null($item->reply))
                                                <span class="label label-success" title="{{__('Answered')}}"><i data-feather="check" stroke-width="7" style="color: #00b800;"></i><span>
                                            @else
                                                <span class="label label-danger" title="{{__('No Response')}}"><i data-feather="x" stroke-width="7" style="color: red;"></i><span>
                                            @endif
                                        </td>
                                        <td> {{$item->created_at->diffForHumans()}} </td>
                                        <td>
                                            {!! showForm('contactus', $item) !!}
                                            {!! deleteForm('contactus', $item) !!}
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="no-records-found" style="text-align: center;">
                                        <td colspan="8">@lang('No Data Founded')</td>
                                    </tr>
                                @endforelse
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
