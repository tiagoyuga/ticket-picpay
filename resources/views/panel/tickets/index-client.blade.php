@extends('panel._layouts.panel')

@section('_titulo_pagina_', 'Ticket(s) List')

@section('content')

    @include('panel.tickets.nav')

    @php
        $isClientAdmin = \Auth::user()->isClientAdmin;
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
                                    <li><a class="nav-link" data-toggle="tab" href="#tab-2">Ready for review
                                            ({{$data->where('ticket_status_id', \App\Models\TicketStatus::CLIENT_REVIEW)->count()}}
                                            )</a></li>
                                    <li><a class="nav-link" data-toggle="tab" href="#tab-3">Completed  ({{$data->where('ticket_status_id', \App\Models\TicketStatus::COMPLETED)->count()}}
                                            )</a></li>

{{--                                    @if($isClientAdmin)--}}
{{--                                        <li><a class="nav-link" data-toggle="tab" href="#tab-4">Company users</a></li>--}}
{{--                                    @endif--}}
                                </ul>
                                <div class="tab-content">
                                    <div id="tab-1" class="tab-pane active">
                                        <div class="panel-body">
                                            @if($data->count())
                                                @include('panel.tickets.ticket-by-status', [$data])
                                                {{--@include('panel._assets.paginate')--}}
                                                @include('panel._assets.paginate-ticket')
                                            @else
                                                <div class="alert alert-danger">
                                                    We have nothing to display. If you have performed a search, you can
                                                    perform
                                                    a new one with other terms or <a class="alert-link"
                                                                                     href="{{ route('tickets.index') }}">
                                                        clear your search.
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div id="tab-2" class="tab-pane">
                                        <div class="panel-body">
                                            @if($data->count())

                                                @include('panel.tickets.ticket-by-status', ['data' => $data->where('ticket_status_id', \App\Models\TicketStatus::CLIENT_REVIEW)])
                                                @include('panel._assets.paginate')


                                            @else
                                                <div class="alert alert-danger">
                                                    We have nothing to display. If you have performed a search, you can
                                                    perform
                                                    a new one with other terms or <a class="alert-link"
                                                                                     href="{{ route('tickets.index') }}">
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
                                                    We have nothing to display. If you have performed a search, you can
                                                    perform
                                                    a new one with other terms or <a class="alert-link"
                                                                                     href="{{ route('tickets.index') }}">
                                                        clear your search.
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    @if($isClientAdmin)

{{--                                        <div id="tab-4" class="tab-pane">--}}
{{--                                            <div class="panel-body">--}}

{{--                                                @if (Auth::user()->clientUser->count() == 1)--}}

{{--                                                    <table class="table table-striped table-bordered table-hover">--}}

{{--                                                        <thead>--}}
{{--                                                        <tr>--}}
{{--                                                            <th>Users</th>--}}
{{--                                                        </tr>--}}
{{--                                                        <tbody>--}}
{{--                                                        <tr>--}}
{{--                                                            <td>{{ Auth::user()->clientUser->first()->users->name }}</td>--}}
{{--                                                        </tr>--}}
{{--                                                        </tbody>--}}
{{--                                                    </table>--}}

{{--                                                @else--}}

{{--                                                    @include('panel.tickets.tab-company-users')--}}

{{--                                                @endif--}}

{{--                                            </div>--}}
{{--                                        </div>--}}
                                    @endif
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

    <script>
        $().ready(function () {


            $("#select_company").change(function () {

                if ($(this).val().length == 0) {
                    $(".div_company_users").hide();
                    return;
                }

                $("#client_user_" + $(this).val()).show();
            });
        });
    </script>


@endsection
