@extends('admin.layouts.master')
@section('head_title'){{__('Show Claim')}}@endsection
@section('content')
@include('admin.layouts.inc.breadcrumb', ['array' => [
    [
        'name'  =>  __('Claims'),
        'route' =>  'claims.index',
    ],
    [
        'name'  =>  __('Show Claim'),
        'route' =>  'claims.show',
    ],
],'button' => [
        'title' => __('Back To Claims'),
        'route' =>  'claims.index',
        'icon'  => 'arrow-left'
]])
@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endpush
<div class="content-body">
    <!-- Advanced Search -->
    <section id="advanced-search-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title"> @lang("Show Claim") </h5>
                    </div>
                    <div class="card-body table-responsive">
                        <fieldset>
                            <table class="table datatable-basic">
                                <thead>
                                    <tr>
                                        <th {!! \table_width_head(10) !!}>@lang("ID")</th>
                                        <td>{{$claim->id}}</td>
                                    </tr>
                                    <tr>
                                        <th {!! \table_width_head(10) !!}>@lang("Contact Owner")</th>
                                        <td>{{$claim->claimer->name ?? '----------'}}</td>
                                    </tr>
                                    <tr>
                                        <th {!! \table_width_head(10) !!}>@lang("Sender Name")</th>
                                        <td>{{$claim->name ?? '----------'}}</td>
                                    </tr>
                                    <tr>
                                        <th {!! \table_width_head(10) !!}>@lang("Sender Email")</th>
                                        <td>{{$claim->email ?? '----------'}}</td>
                                    </tr>
                                    <tr>
                                        <th {!! \table_width_head(10) !!}>@lang("Sender Phone")</th>
                                        <td>{{$claim->phone ?? '----------'}}</td>
                                    </tr>
                                    <tr>
                                        <th {!! \table_width_head(10) !!}>@lang("Resons")</th>
                                        <td>
                                            @if ($claim->resons)
                                                <ul>
                                                    @foreach ($claim->resons as $reson)
                                                        <li>{{$reson->title}}</li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                ----------
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th {!! \table_width_head(10) !!}>@lang("Message Content")</th>
                                        <td>{{$claim->message ?? '----------'}}</td>
                                    </tr>
                                    <tr>
                                        <th {!! \table_width_head(10) !!}>@lang("Replay")</th>
                                        <td>
                                            @if(isset($claim->reply))
                                                <div class="form-control" style="background-color: #e9ecef;">{!! $claim->reply !!}</div>
                                            @else
                                                <form class="form-horizontal" method="POST" action="{{ route('app.claims.update',[$claim->id]) }}">
                                                    {!! isset($claim) ? method_field('PATCH') : '' !!}
                                                    @csrf
                                                    <textarea class="form-control" name="reply" id="reply" placeholder="{{__("Reply")}}">{!! $claim->reply !!}</textarea>
                                                    @error('reply')
                                                        <span class="invalid-feedback">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <div class="border-top">
                                                        <div class="card-body text-left">
                                                            <button type="submit" class="btn btn-primary">@lang('Send')</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                    @if(isset($claim->reply))
                                        <tr>
                                            <th {!! \table_width_head(10) !!}>@lang("Reply Owner")</th>
                                            <td>{{ isset($claim->reply_owner_id) ? $claim->reply_owner->name : '----------' }}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <th {!! \table_width_head(10) !!}>@lang("Message Timing")</th>
                                        <td>{{ isset($claim->created_at) ? $claim->created_at->diffForHumans() : __('Not Found') }}</td>
                                    </tr>
                                    <tr>
                                        <th {!! \table_width_head(10) !!}>@lang("Message Date")</th>
                                        <td>{{ isset($claim->created_at) ? $claim->created_at->format('Y-m-d') : __('Not Found') }}</td>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <br/>
                            <div class="text-right">
                                {!! BackButton('Back', route('app.claims.index')) !!}
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Dashboard\Claims\UpdateRequest') !!}
    <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
    <script>
        // CKEDITOR.replace('reply');
    </script>
@endpush
