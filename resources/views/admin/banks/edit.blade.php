@extends('admin.layouts.master')
@section('head_title'){{__('Edit Bank')}}@endsection
@section('content')
@include('admin.layouts.inc.breadcrumb', ['array' => [
    [
        'name'  =>  __('Banks'),
        'route' =>  'banks.index',
    ],
    [
        'name'  =>  __('Edit Bank'),
        'route' =>  'banks.edit',
    ],
],'button' => [
        'title' => __('Back To Banks'),
        'route' =>  'banks.index',
        'icon'  => 'arrow-left'
]])
<div class="card">
    <div class="card-header">
        <h5 class="card-title"> @lang("Edit Bank") </h5>
        <ul class="nav nav-tabs" role="tablist">
            @foreach(app_languages() as $key=>$one)
                <li class="nav-item {{ $key == app()->getLocale() ? 'active' : '' }} tab-lang" data-id="tab-{{$key}}">
                    <a class="nav-link {{$errors->first($key.'.*') ? 'text-danger' : ''}}"  data-toggle="tab" href="#" role="tab">
                        <span class="hidden-sm-up"></span> <span class="hidden-xs-down">@lang($one['name'])</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="card-body table-responsive">
        <form class="form-horizontal" action="{{route('app.banks.update', $bank->id)}}" method="post" enctype="multipart/form-data">
            <fieldset>
                @csrf
                @method('PUT')
                @foreach(app_languages() as $key=>$one)
                    <div class="tab-pane {{ $key == app()->getLocale() ? 'active' : '' }}" id="tab-{{$key}}" role="tabpanel">
                        <div class="form-body">
                            <div class="form-group row">
                                {!! Inputs('text', $key.'[name]', 'Name', 'form-control', old($key.'.name', $bank->translate($key)->name??'')) !!}
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="form-body">
                    <div class="form-group row">
                        {!! Inputs('text', 'iban', 'Iban', 'form-control', old('iban', $bank->iban)) !!}
                    </div>
                    <div class="form-group row">
                        {!! Inputs('text', 'account_number', 'Account Number', 'form-control', old('account_number', $bank->account_number)) !!}
                    </div>
                    <div class="form-group row">
                        {!! Inputs('text', 'account_owner', 'Account Owner', 'form-control', old('account_owner', $bank->account_owner)) !!}
                    </div>
                </div>
                <div class="text-right">
                    {!! BackButton('Back', route('app.banks.index')) !!}
                    {!! SubmitButton('Update') !!}
                </div>
            </fieldset>
        </form>
    </div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Dashboard\Banks\UpdateRequest') !!}
@endpush
