<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>{{ $label }}</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">Index</a>
            </li>
            <li class="breadcrumb-item active">
                <strong><a href="{{ route('tickets.index') }}">{{ $label }}</a></strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-4">
        <div class="btn-group pull-right" style="margin-top: 30px;">


            <a class="btn btn-default" href="{{ route('tickets.index') }}">
                <i class="fa fa-list-ul"></i>
                List
            </a>

            @can('create', \App\Models\Ticket::class)
                <a class="btn btn-primary" id="ln_adicionar" href="{{ route('tickets.create') }}">
                    <i class="fa fa-plus-circle"></i> New
                </a>
            @endcan
        </div>
    </div>
</div>
