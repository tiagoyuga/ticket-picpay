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
                                Bem vindo {{ \Auth::user()->name }}
                            </div>
                        </div>

                        @if(Auth::user()->can('create', \App\Models\User::class))

                            <br>

                            @if(Auth::user()->isAdmin())

                                <a class="btn btn-primary" id="ln_adicionar" href="{{ route('public_users') }}">
                                    <i class="fa fa-plus-circle"></i> Add new user
                                </a>
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
@endsection

