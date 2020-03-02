@extends('panel._layouts.panel')

@section('_titulo_pagina_', 'List of '.$label)

@section('content')

    @include('panel.ticket_status.nav')

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

                        <div class="m-b-lg">
                            <form method="get" id="frm_search" action="{{ route('ticket_status.index') }}">
                                @include('panel._assets.basic-search')
                            </form>
                        </div>

                        <div class="table-responsive">

                            @if($data->count())

                                <table class="table table-striped table-bordered table-hover">

                                    <thead>
                                    <tr>

                                        <th>Name</th>
                                        <th>Order</th>
                                        <th class="hidden-xs hidden-sm" style="width: 150px;">Created at</th>
                                        <th style="width: 100px; text-align: center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @if($data->count())
                                        @foreach($data as $item)
                                            <tr id="tr-{{ $item->id }}">


                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->order }}</td>
                                                <td class="hidden-xs hidden-sm">{{ $item->created_at->format('m-d-Y g:i A') }}</td>

                                                <td style="text-align: center">

                                                    <a class="btn btn-sm btn-default" title="Edit"
                                                       href="{{ route('ticket_status.edit', [$item->id]) }}"><i
                                                            class="fa fa-pencil"></i>
                                                    </a>

                                                    <link-destroy-component
                                                        line-id="{{ 'tr-'.$item->id }}"
                                                        link="{{ route('ticket_status.destroy', [$item->id]) }}">
                                                    </link-destroy-component>

                                                </td>

                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>

                                @include('panel._assets.paginate')

                            @else
                                <div class="alert alert-danger">
We have nothing to display. If you have performed a search, you can perform
a new one with other terms or <a class="alert-link" href="{{ route('ticket_status.index') }}">
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
@endsection

@section('styles')

@endsection

@section('scripts')

@endsection
