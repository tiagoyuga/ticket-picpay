@extends('panel._layouts.panel')

@section('_titulo_pagina_', 'Dashboard')

@section('content')

    <div class="wrapper wrapper-content animated fadeIn">

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title"><h5>Dashboard</h5>
                        <div class="ibox-tools"></div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-12">
                                Welcome {{ \Auth::user()->name }}
                            </div>
                        </div>

                        @if(Auth::user()->checkCanSharePublicRegisterLink() && Auth::user()->clientUser->count())

                            @if (Auth::user()->clientUser->count() == 1)

                                <br>
                                <a class="btn btn-primary" id="ln_adicionar" title="add users to client"
                                   href="{{ route('public_users.new', base64_encode(Auth::user()->clientUser->first()->client_id))}} ">
                                    <i class="fa fa-plus-circle"></i> Add new user
                                </a>
                            @else
                                <br>
                                <div class="form-row">
                                    <div class="form-group col-md-6 ">
                                        <label for="group_id">Choose the Company to add new user</label>
                                        <select class="form-control form-control-lg" style="width: 100%"
                                                name=""
                                                id="select_company">
                                            <option value="">Select</option>

                                            @foreach(Auth::user()->clientUser as $clientUser)
                                                <option
                                                    value="{{ route('public_users.new', base64_encode($clientUser->client_id)) }}">
                                                    {{ $clientUser->client->company_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>

                                <div id="div_link" style="display: none;">

                                    <div class="form-row">
                                        <br>
                                        <a class="btn btn-primary" id="share_link" title="add users to client"
                                           href="">
                                            <i class="fa fa-plus-circle"></i> Add new user
                                        </a>
                                        <br>
                                    </div>

                                    <br>

                                    <div class="form-row">
                                        <p class="text-info">
                                            Or share the registration link:
                                            <a href="" target="_blank" id="link_to_share"></a>
                                        </p>
                                    </div>

                                </div>

                            @endif
                        @endif

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('css')
@endsection

@section('scripts')

    <script>

        $("#select_company").change(function () {

            if ($(this).val().length == 0) {
                $("#div_link").hide();
                return;
            }

            $("#div_link").show();
            $("#share_link").attr('href', $(this).val());
            $("#link_to_share").attr('href', $(this).val()).text($(this).val());

        });

    </script>
@endsection

