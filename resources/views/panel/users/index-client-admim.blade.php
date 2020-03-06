@extends('panel._layouts.panel')

@section('_titulo_pagina_', 'Users List')

@section('content')

    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-lg-12">

                <div class="ibox">

                    <div class="ibox-title">

                        <h5>@yield('_titulo_pagina_')</h5>

                        <div class="ibox-tools">
                            @if (Auth::user()->clientUser->count() == 1)

                                <a class="btn btn-primary" id="ln_adicionar" title="add users to client"
                                   href="{{ route('public_users.new', base64_encode(Auth::user()->clientUser->first()->client_id))}} ">
                                    <i class="fa fa-plus-circle"></i> Add new user
                                </a>

                            @endif
                        </div>
                    </div>

                    <div class="ibox-content">


                        <div class="form-row">

                            <div class="form-group col-md-12 ">
                                <label for="group_id">Choose the Company to display the users list</label>

                                <select class="form-control form-control-lg"
                                        style="width: 100%"
                                        id="select_company">

                                    <option value="">Choose a company</option>

                                    @foreach(Auth::user()->clientUser as $clientUser)
                                        <option
                                            value="{{ $clientUser->client_id }}">
                                            {{ $clientUser->client->company_name }}
                                        </option>
                                    @endforeach
                                </select>

                                <br>

                                @php
                                    $userService = new \App\Services\UserService();
                                @endphp

                                @foreach(Auth::user()->clientUser as $clientUser)

                                    <div id="client_user_{{ $clientUser->client_id }}"
                                         style="display: {{ Auth::user()->clientUser->count() == 1 ? 'block' : 'none' }};" class="div_company_users">

                                        <table class="table table-striped table-bordered table-hover">

                                            <thead>
                                            <tr>
                                                <th>Users from {{ $clientUser->client->company_name }}</th>
                                                <th>Email</th>
                                                <th>Job</th>
                                                <th>Privileges setup</th>
                                            </tr>
                                            <tbody>

                                            @php
                                                $users = $userService->listUsersOfCompany($clientUser->client_id);
                                            @endphp

                                            @foreach($users as $user)

                                                <tr>

                                                    <td>{{ $user->name }} </td>
                                                    <td>{{ $user->email }} </td>
                                                    <td>{{ $user->job_title }} </td>
                                                    <td style="width: 20%">

                                                        <button id="btn_admin_{{ $user->id }}"
                                                                type="button"
                                                                class="btn btn-{{ $user->isClientAdmim() ? 'primary' : 'default'}}"
                                                                onclick="changePrivilegies('{{ $user->id }}');"
                                                        >Admin
                                                        </button>

                                                        <button id="btn_regular_{{ $user->id }}"
                                                                type="button"
                                                                class="btn btn-{{ $user->isClientAdmim() ? 'default' : 'primary'}}"
                                                                onclick="changePrivilegies('{{ $user->id }}');"
                                                        >Regular user
                                                        </button>

                                                    </td>

                                                </tr>

                                            @endforeach

                                            </tbody>
                                        </table>

                                    </div>
                                    <br>

                                @endforeach

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
    @include('panel._assets.scripts-form')

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
