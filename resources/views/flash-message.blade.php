@if ($message = Session::get('success'))
    <div role="alert" aria-live="polite" aria-atomic="true" class="alert mb-2 alert-dismissible alert-success alert-block flash" style="overflow: unset; max-height: 40px; opacity: 1;">
        <button type="button" aria-label="Close" class="close" onclick="$(this).parent().hide();" style="color: #000;{{app()->getLocale()=='ar'?'text-align: end;left: 0;padding-left: 10px;':''}}">×</button>
        <div class="alert-body flash">
            <span>{{ $message }}</span>
        </div>
    </div>


    {{-- <div class="alert alert-success alert-block  flash">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div> --}}
@endif

@if ($message = Session::get('error'))
    <div role="alert" aria-live="polite" aria-atomic="true" class="alert mb-2 alert-dismissible alert-danger alert-block flash" style="overflow: unset; max-height: 40px; opacity: 1;">
        <button type="button" aria-label="Close" class="close" onclick="$(this).parent().hide();" style="color: #000;{{app()->getLocale()=='ar'?'text-align: end;left: 0;padding-left: 10px;':''}}">×</button>
        <div class="alert-body flash">
            <span>{{ $message }}</span>
        </div>
    </div>

    {{-- <div class="alert alert-danger alert-block flash">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div> --}}
@endif


@if ($message = Session::get('warning'))
    <div role="alert" aria-live="polite" aria-atomic="true" class="alert mb-2 alert-dismissible alert-warning alert-block flash" style="overflow: unset; max-height: 40px; opacity: 1;">
        <button type="button" aria-label="Close" class="close" onclick="$(this).parent().hide();" style="color: #000;{{app()->getLocale()=='ar'?'text-align: end;left: 0;padding-left: 10px;':''}}">×</button>
        <div class="alert-body flash">
            <span>{{ $message }}</span>
        </div>
    </div>

    {{-- <div class="alert alert-warning alert-block flash">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div> --}}
@endif

@if ($message = Session::get('info'))
    <div role="alert" aria-live="polite" aria-atomic="true" class="alert mb-2 alert-dismissible alert-info alert-block flash" style="overflow: unset; max-height: 40px; opacity: 1;">
        <button type="button" aria-label="Close" class="close" onclick="$(this).parent().hide();" style="color: #000;{{app()->getLocale()=='ar'?'text-align: end;left: 0;padding-left: 10px;':''}}">×</button>
        <div class="alert-body flash">
            <span>{{ $message }}</span>
        </div>
    </div>

    {{-- <div class="alert alert-info alert-block flash">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div> --}}
@endif

@if ($errors->any())
    <div role="alert" aria-live="polite" aria-atomic="true" class="alert mb-0 alert-dismissible alert-danger mb-2 flash" style="overflow: unset; max-height: 40px; opacity: 1;">
        <button type="button" aria-label="Close" class="close" onclick="$(this).parent().hide();" style="color: #000;{{app()->getLocale()=='ar'?'text-align: end;left: 0;padding-left: 10px;':''}}">×</button>
        <div class="alert-body">
            <span>@lang('message.Please check the form below for errors')</span>
        </div>
    </div>

    {{-- <div class="alert alert-danger flash">
        <button type="button" class="close" data-dismiss="alert" style="{{app()->getLocale()=='ar'?'float: left;':''}}">×</button>
        @lang('message.Please check the form below for errors')
    </div> --}}
@endif
