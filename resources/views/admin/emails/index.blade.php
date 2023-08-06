@extends('admin.layouts.master')
@section('head_title')@lang("All Emails")@endsection
@section('content')
@include('admin.layouts.inc.breadcrumb', ['array' => [
    [
        'name'  =>  __('All Emails'),
        'route' =>  'emails.index',
    ],
],'button' => [
        'title' => __('Send Email'),
        'route' =>  'emails.send',
        'icon'  => 'plus'
]])

@push('styles')
    <style>
    a.btn.btn-success.btn-round.waves-effect.waves-float.waves-light.mr-auto {
        margin-right: auto !important;
    }
    a.btn.btn-danger.btn-round.waves-effect.waves-float.waves-light {
        margin-right: 10px !important;
    }
    </style>
@endpush
<div class="content-body">
    <!-- Advanced Search -->
    <section id="advanced-search-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h4 class="card-title">@lang('Basic information')</h4>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table datatable-basic">
                            <thead>
                                <tr>
                                    <th {!! \table_width_head(1) !!}>#</th>
                                    <th>@lang('Name')</th>
                                    <th {!! \table_width_head(5) !!}>@lang('Phone')</th>
                                    <th {!! \table_width_head(7) !!}>@lang('Email')</th>
                                    <th {!! \table_width_head(7) !!}>@lang('Created At')</th>
                                    <th {!! \table_width_head(1) !!}>@lang('Actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($lists as $key => $one)
                                    <tr>
                                        <td> {{ $key+1 }}  </td>
                                        <td> {{ $one->user->name }} </td>
                                        <td> {{ $one->user->phone }} </td>
                                        <td> {{ $one->user->email }} </td>
                                        <td> {{ $one->created_at }} </td>
                                        <td>
                                            @if(permissionCheck('emails.delete'))
                                                {!! deleteForm('emails', $one) !!}
                                            @else
                                                -------
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="no-records-found" style="text-align: center;">
                                        <td colspan="6">@lang('No Data Founded')</td>
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
