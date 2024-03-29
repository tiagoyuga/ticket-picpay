<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>{{ $label }}</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">Index</a>
            </li>
            <li class="breadcrumb-item active">
                <strong><a href="{{ route('clients.index') }}">{{ $label }}</a></strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-4">
        <div class="btn-group pull-right" style="margin-top: 30px;">
            <a class="btn btn-default" href="{{ route('clients.index') }}">
                <i class="fa fa-list-ul"></i>
                List
            </a>
            @if(Auth::user()->can('create', \App\Models\Client::class))
                <a class="btn btn-primary" id="ln_adicionar" href="{{ route('clients.create') }}">
                    <i class="fa fa-plus-circle"></i> New
                </a>
            @endif
        </div>
    </div>
</div>
