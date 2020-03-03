@extends('panel._layouts.panel')

@section('_titulo_pagina_', 'Ticket(s) List')

@section('content')

{{--    @include('panel.tickets.nav')--}}

    @php

        //$_placeholder_ = "Localize por ''";
    @endphp

    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-lg-12">

                <div class="ibox">

                    <div class="ibox-title">

                        <h5>@yield('_titulo_pagina_')</h5>

                        <div class="ibox-tools">

                        </div>
                    </div>

                    <div class="ibox-content">

                        {{--<div class="m-b-lg">
                            <form method="get" id="frm_search" action="{{ route('tickets.index') }}">
                                @include('panel._assets.basic-search')
                            </form>
                        </div>--}}

                        @include('panel.tickets.filter')

                        <div class="table-responsive">

                            <div class="tabs-container">
                                <ul class="nav nav-tabs">
                                    <li><a class="nav-link active" data-toggle="tab" href="#tab-1">All</a></li>
                                    <li><a class="nav-link" data-toggle="tab" href="#tab-2">Ready for review ({{$data->where('ticket_status_id', \App\Models\TicketStatus::CTO_REVIEW)->count()}})</a></li>
                                    <li><a class="nav-link" data-toggle="tab" href="#tab-3">Completed</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="tab-1" class="tab-pane active">
                                        <div class="panel-body">
                                            @if($data->count())
                                                @include('panel.tickets.ticket-by-status', [$data])
                                                @include('panel._assets.paginate')

                                            @else
                                                <div class="alert alert-danger">
                                                    We have nothing to display. If you have performed a search, you can perform
                                                    a new one with other terms or <a class="alert-link" href="{{ route('tickets.index') }}">
                                                        clear your search.
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div id="tab-2" class="tab-pane">
                                        <div class="panel-body">
                                            @if($data->count())
                                                @include('panel.tickets.ticket-by-status', ['data' => $data->where('ticket_status_id', \App\Models\TicketStatus::CTO_REVIEW)])
                                            @else
                                                <div class="alert alert-danger">
                                                    We have nothing to display. If you have performed a search, you can perform
                                                    a new one with other terms or <a class="alert-link" href="{{ route('tickets.index') }}">
                                                        clear your search.
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div id="tab-3" class="tab-pane">
                                        <div class="panel-body">
                                            @if($data->count())
                                                @include('panel.tickets.ticket-by-status', ['data' => $data->where('ticket_status_id', \App\Models\TicketStatus::COMPLETED)])
                                            @else
                                                <div class="alert alert-danger">
                                                    We have nothing to display. If you have performed a search, you can perform
                                                    a new one with other terms or <a class="alert-link" href="{{ route('tickets.index') }}">
                                                        clear your search.
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')

@endsection

@section('scripts')

@endsection
