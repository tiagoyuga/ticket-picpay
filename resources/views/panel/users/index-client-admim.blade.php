@extends('panel._layouts.panel')

@section('_titulo_pagina_', 'List of Users')

@section('content')

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


                        <div class="form-row">

                            <div class="form-group col-md-12 ">
                                <label for="group_id">Select the Company to show the users</label>

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
                                         style="display: none;" class="div_company_users">

                                        <table class="table table-striped table-bordered table-hover">

                                            <thead>
                                            <tr>
                                                <th>Users from {{ $clientUser->client->company_name }}</th>
                                                <th>Privileges setup</th>
                                            </tr>
                                            <tbody>

                                            @php
                                                $users = $userService->listUsersOfCompany($clientUser->client_id);
                                            @endphp

                                            @foreach($users as $user)
                                                <tr>
                                                    <td>{{ $user->name }}</td>
                                                    <td style="width: 20%">

                                                        <button type="button"
                                                                class="btn btn-{{ $user->isClientAdmim() ? 'primary' : 'default'}}"
                                                                @if(!$user->isClientAdmim()) onclick="changePrivilegies('{{ $user->id }}');" @endif
                                                        >Admin
                                                        </button>

                                                        <button type="button"
                                                                class="btn btn-{{ $user->isClientAdmim() ? 'default' : 'primary'}}"
                                                                @if($user->isClientAdmim()) onclick="changePrivilegies('{{ $user->id }}');" @endif
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

    <form method="post" class="form-horizontal" id="frm_save" autocomplete="off"
          action="{{ route('users.changeUserPrivileges') }}">
    {{ method_field('POST') }}
    {{ csrf_field() }}

        <input type="hidden" name="user_id" value="" id="user_id">

    </form>

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

            if(confirm('Do you confirm to change user privileges ?')) {

                $("#user_id").val(id);

                $("#frm_save").submit();
            }
        }

    </script>

@endsection
