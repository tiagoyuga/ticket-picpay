<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>{{ $label }}</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">Index</a>
            </li>
            <li class="breadcrumb-item active">
                <strong><a href="{{ route('ticket_status.index') }}">{{ $label }}</a></strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-4">
        <div class="btn-group pull-right" style="margin-top: 30px;">
            <a class="btn btn-default" href="{{ route('ticket_status.index') }}">
                <i class="fa fa-list-ul"></i>
                List
            </a>
            @if(Auth::user()->can('create', \App\Models\TicketStatus::class))
                <a class="btn btn-primary" id="ln_adicionar" href="{{ route('ticket_status.create') }}">
                    <i class="fa fa-plus-circle"></i> New
                </a>
            @endif
        </div>
    </div>
</div>
