@extends('admin.layouts.master')
@section('head_title'){{__('Send Email')}}@endsection
@section('content')
@include('admin.layouts.inc.breadcrumb', ['array' => [
    [
        'name'  =>  __('Emails'),
        'route' =>  'emails.index',
    ],
    [
        'name'  =>  __('Send Email'),
        'route' =>  'emails.create',
    ],
],'button' => [
        'title' => __('Back To Emails'),
        'route' =>  'emails.index',
        'icon'  => 'arrow-left'
]])

<form class="form-horizontal" action="{{route('app.emails.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="card">
        <div class="card-header">
            <h5 class="card-title"> @lang("Send Email") </h5>
        </div>
        <div class="card-body table-responsive">
            <fieldset>
                <div class="form-body">
                    <div class="form-group row">
                        <label class="form-label col-sm-2" for="select2-basic">@lang('Clients')</label>
                        <div class="input-icon right col-sm-10">
                            <label for="all_clients" style="margin: 0 7px;">
                                @lang("All Clients")
                                <input class="choose_client" id="all_clients" type="radio" name="email_type" value="all_clients">
                            </label>
                            <label for="one_client" style="margin: 0 7px;">
                                @lang("Clients")
                                <input class="choose_client" id="one_client" type="radio" name="email_type" value="one_client">
                            </label>
                        </div>
                    </div>
                    <div class="form-group row show_clients" style="display: none">
                        <label class="form-label col-sm-2" for="select2-basic"></label>
                        <div class="input-icon right col-sm-10">
                            <select class="select-search form-control" id="select2-basic" name="clients[]" id="clients" multiple>
                                <option value="0" disabled>@lang("Choose")</option>
                                @forelse($all_clients as $client)
                                    <option value="{{$client->id}}">{{$client->name}}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        {!! TextArea('content', 'Content', 'form-control ', old('.content')) !!}
                    </div>
                </div>
                <div class="text-right">
                    {!! BackButton('Back', route('app.emails.index')) !!}
                    {!! SubmitButton('Save') !!}
                </div>
            </fieldset>
        </div>
    </div>
</form>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Dashboard\Emails\StoreRequest') !!}
    <script>
        $('.choose_client').on('click', function(){
            $('.show_clients').slideUp();
            console.log($(this).val());
            if ($(this).val() == 'one_client') {
                $('.show_clients').slideDown();
            }
        });
    </script>
@endpush
