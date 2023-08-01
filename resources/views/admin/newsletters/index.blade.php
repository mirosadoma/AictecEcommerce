@extends('admin.layouts.master')
@section('head_title'){{__('Newsletters')}}@endsection
@section('content')
@include('admin.layouts.inc.breadcrumb', ['array' => [
    [
        'name'  =>  __('Newsletters'),
        'route' =>  'newsletters.index',
    ],
],'button' => []])

<div class="content-body">
    <!-- Advanced Search -->
    <section id="advanced-search-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h4 class="card-title">@lang('Basic information')</h4>
                        <a href="{{route('app.newsletters.export')}}" class="btn btn-instagram btn-round waves-effect waves-float waves-light">@lang("Export Exel File")</a>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table datatable-basic">
                            <thead>
                                <tr>
                                    <th {!! \table_width_head(1) !!}>#</th>
                                    <th>@lang('Email')</th>
                                    <th {!! \table_width_head(7) !!}>@lang('Created At')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($lists->count())
                                @foreach ($lists as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->email}}</td>
                                        <td> {{$item->created_at}} </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="no-records-found" style="text-align: center;">
                                    <td colspan="3">@lang('No Data Founded')</td>
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
