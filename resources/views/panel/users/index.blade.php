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

                    <div class="ibox-content">

                        <div class="m-b-lg">
                            <form method="get" id="frm_search" action="{{ route('users.index') }}">
                                @include('panel._assets.basic-search')
                            </form>
                        </div>

                        <div class="table-responsive">

                            @if($data->count())

                                <table class="table table-striped table-bordered table-hover">

                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>E-mail</th>
                                        <th>Group</th>
                                        <th>Privileges setup</th>
                                        <th class="hidden-xs hidden-sm" style="width: 150px;">Created at</th>
                                        <th style="width: 290px; text-align: center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @if($data->count())
                                        @foreach($data as $item)
                                            <tr id="tr-{{ $item->id }}">

                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ isset($item->group_id) ? $item->group->name : ''}}</td>
                                                <td style="width: 20%">

                                                    @if($item->group_id == \App\Models\Group::CLIENT)
                                                        <button id="btn_admin_{{ $item->id }}"
                                                                type="button"
                                                                class="btn btn-{{ $item->isClientAdmim() ? 'primary' : 'default'}}"
                                                                onclick="changePrivilegies('{{ $item->id }}');"
                                                        >Admin
                                                        </button>

                                                        <button id="btn_regular_{{ $item->id }}"
                                                                type="button"
                                                                class="btn btn-{{ $item->isClientAdmim() ? 'default' : 'primary'}}"
                                                                onclick="changePrivilegies('{{ $item->id }}');"
                                                        >Regular user
                                                        </button>
                                                    @else
                                                        -/-
                                                    @endif
                                                </td>

                                                <td class="hidden-xs hidden-sm">{{ $item->created_at->format('m-d-Y g:i A') }}</td>

                                                <td style="text-align: center">

{{--                                                    <div class="btn-group" role="group">--}}
{{--                                                        <button id="btnGroupDrop1" type="button"--}}
{{--                                                                class="btn btn-default dropdown-toggle"--}}
{{--                                                                data-toggle="dropdown" aria-haspopup="true"--}}
{{--                                                                aria-expanded="false">--}}
{{--                                                            Actions--}}
{{--                                                        </button>--}}
{{--                                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">--}}
{{--                                                            <a class="dropdown-item" title="Daily Activity"--}}
{{--                                                               href="#">Daily Activity</a>--}}
{{--                                                            <a class="dropdown-item"--}}
{{--                                                               href="#" title="Loan History">Loan History</a>--}}

{{--                                                            @if(isset($item->group_id) && $item->group->name == 'Developer')--}}
{{--                                                                <a class="dropdown-item"--}}
{{--                                                                   href="{{ route('users.skills', [$item->id]) }}" title="Skills">Skills</a>--}}
{{--                                                            @endif--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}

                                                    <a class="btn btn-sm btn-default" title="Edit"
                                                       href="{{ route('users.edit', [$item->id]) }}"><i
                                                            class="fa fa-pencil"></i>
                                                    </a>

                                                    <link-destroy-component
                                                        line-id="{{ 'tr-'.$item->id }}"
                                                        link="{{ route('users.destroy', [$item->id]) }}">
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
a new one with other terms or <a class="alert-link" href="{{ route('users.index') }}">
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

        function changePrivilegies(id) {

            if(confirm('Are you sure ?')) {

                $.ajax({
                    type: 'POST',
                    url: "{{ route('users.changeUserPrivileges') }}",
                    data: {'user_id' : id},
                    success: function (data) {
                        console.log(data);
                        showMessage('s', 'Privilege changed with success');

                        $("#btn_admin_"+id).removeClass('btn btn-primary btn-default');
                        $("#btn_regular_"+id).removeClass('btn btn-primary btn-default');

                        if (data.data.type_id == 1) {
                            $("#btn_admin_"+id).addClass('btn btn-primary');
                            $("#btn_regular_"+id).addClass('btn btn-default');
                        } else {
                            $("#btn_regular_"+id).addClass('btn btn-primary');
                            $("#btn_admin_"+id).addClass('btn btn-default');
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
