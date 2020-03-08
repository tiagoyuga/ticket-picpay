@extends('panel._layouts.panel')

@section('_titulo_pagina_', 'List of '.$label)

@section('content')

    @include('panel.users.nav')

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

                    <div class="ibox-content ">

                        <div class="col-lg-12">

                            <div class="m-b-lg">
                                <form method="get" id="frm_search" action="{{ route('users.index') }}">
                                    @include('panel._assets.basic-search')
                                </form>
                            </div>

                            @if(\Auth::user()->is_admin)

                                @include('panel.users.list-users-admin-table')

                            @elseif(count($data) >= 1)

                                <div class="tabs-container">
                                    <ul class="nav nav-tabs" role="tablist">
                                        @foreach($data as $company_id => $value)
                                        <li><a class="nav-link {{ $loop->first ? 'active' : '' }}" data-toggle="tab" href="#tab-{{$loop->index}}">{{$value['name']}}</a></li>
                                        @endforeach
                                    </ul>
                                    <div class="tab-content">

                                        @foreach($data as $company_id => $value)

                                            <div role="tabpanel" id="tab-{{$loop->index}}" class="tab-pane active">
                                                <div class="panel-body">
                                                     @include('panel.users.list-users-table', ['data' => $value['data'], 'client_id' => $company_id])
                                                </div>
                                            </div>

                                        @endforeach

                                    </div>

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
    <script>
        $().ready(function () {

            $("#select_company").change(function () {

                $(".div_company_users").hide();

                if ($(this).val().length == 0) {
                    return;
                }

                $("#client_user_" + $(this).val()).show();
            });
        });

        function changePrivilegies(id, client_id, user_company_id) {

            if (confirm('Are you sure ?')) {

                $.ajax({
                    type: 'POST',
                    url: "{{ route('users.changeUserPrivileges') }}",
                    data: {'user_id': id, 'client_id': client_id},
                    success: function (data) {
                        console.log(data);
                        showMessage('s', 'Privilege changed with success');

                        $("#btn_admin_" + user_company_id).removeClass('btn btn-primary btn-default');
                        $("#btn_regular_" + user_company_id).removeClass('btn btn-primary btn-default');

                        if (data.data == true) {
                            console.log('admin')
                            $("#btn_admin_" + user_company_id).addClass('btn btn-primary');
                            $("#btn_regular_" + user_company_id).addClass('btn btn-default');
                        } else {
                            $("#btn_regular_" + user_company_id).addClass('btn btn-primary');
                            $("#btn_admin_" + user_company_id).addClass('btn btn-default');
                        }

                    },
                    error: function () {
                        console.log(data);
                        showMessage('e', 'Error is not authorized', 2);
                    }
                });
            }
        }

    </script>

@endsection
